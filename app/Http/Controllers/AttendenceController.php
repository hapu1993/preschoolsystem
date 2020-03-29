<?php

namespace App\Http\Controllers;

use App\Absent;
use App\Attendence;
use App\Http\Requests\absentCreateValidationRequest;
use App\Student;
use Auth;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Record Attendence';
        $students = Student::where('class_id',Auth::user()->teacherClass->class_id)->get();
        return view('record-attendence',compact('students','page_title'));
    }

    public function store(absentCreateValidationRequest $request)
    {
        $request = $request->request->all();

        foreach ($request['attend'] as $key=>$attend){

            $attend_status = $attend == 'yes' ? 1 : 0;
            $attend_color = $attend == 'yes' ? '#eaf01f' : '#eb1c2a';
            $attend = Attendence::updateOrCreate(['student_id' => $key,'date' => $request['date']],
                ['attend' => $attend_status,'color' => $attend_color]);
        }
        return response()->json(['status'=>'Succefully Submitted Attendence.']);
//        return redirect()->route('attendence')->with('info', 'Something went wrong.. Try again..');
    }

    public function loadAttendence(Request $request)
    {
        $date = $request->date;

        $attendences = Student::with('attendence')->get();
        if($attendences){
            foreach ($attendences as $el){
                $test = $el->attendenceByDate($date)->first();
                $el['attend_arranged'] = $test ? $test->attend : 0;
            }
        }


        return $attendences;
    }

    public function loadAttendencebyReg()
    {
        if(request()->ajax())
        {
            $reg_no = request()->reg_no;
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $data = [];
            if(Auth::user()->role == 1){
                $data = Attendence::with('student')->whereHas('student', function($q) use ($reg_no){
                    $q->where('reg_no', '=', $reg_no);
                })->whereDate('date', '>=', $start)->whereDate('date',   '<=', $end)->select('date as start', 'date as end','updated_at as title','color')->get();
            }elseif(Auth::user()->role == 2){
                $data = Attendence::query()->whereHas('student', function($q) use ($reg_no){
                    $q->where('reg_no', '=', $reg_no);
                    $q->where('class_id',Auth::user()->teacherClass->class_id);
                    $q->where('level_id',Auth::user()->teacherClass->level_id);
                })->whereDate('date','>=', $start)->whereDate('date','<=',$end)->with(['student' => function($query) {
                    $query->select('id','name');
                }])->get();

            }elseif(Auth::user()->role == 3){
                $data = Attendence::with('student')->whereHas('student', function($q) use ($reg_no){
                    $q->where('reg_no', '=', $reg_no);
                    $q->where('id',Auth::user()->student->id);
                })->whereDate('date', '>=', $start)->whereDate('date',   '<=', $end)->select('date as start', 'date as end','updated_at as title','color')->get();
            }



            return Response::json($data);
        }
//        return view('fullcalender');
    }
}
