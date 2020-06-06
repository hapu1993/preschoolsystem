<?php

namespace App\Http\Controllers;

use App\Absent;
use App\Attendence;
use App\ClassMain;
use App\Event;
use App\Http\Requests\absentCreateValidationRequest;
use App\LevelMain;
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
        $today = Carbon::today();

        $event = Event::where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->whereDate('date','=',$today)->first();
        if($event){
            $event = $event->name;
        }else{
            $event =null;
        }
        $students = Student::where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->get();
        return view('record-attendence',compact('students','page_title','event'));
    }

    public function store(Request $request)
    {
        $request = $request->request->all();

        if($request['event'] !== null){

            $event = Event::whereDate('date',$request['date'])->where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->first();
            if($event){
                $event->name = $request['event'];
                $event->date = $request['date'];
                $event->save();
            }else{
                $event = new Event();
                $event->name = $request['event'];
                $event->date = $request['date'];
                $event->created_by = Auth::user()->id;
                $event->class_id = Auth::user()->teacherClass->class_id;
                $event->level_id = Auth::user()->teacherClass->level_id;
                $event->save();
            }
        }else{
            $event = Event::whereDate('date',$request['date'])->where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->delete();
        }


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

        $data['attendences'] = Student::with('attendence')->where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->get();
        if($data['attendences']){
            foreach ($data['attendences'] as $el){
                $test = $el->attendenceByDate($date)->first();
                $el['attend_arranged'] = $test ? $test->attend : 0;
            }
        }


        $event = Event::where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->whereDate('date',$date)->first();
        if($event){
            $data['event'] = $event->name;
        }else{
            $data['event'] =null;
        }

        return $data;
    }

    public function loadAttendencebyReg()
    {

        if(request()->ajax())
        {
            $reg_no = request()->reg_no;
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');



//            ->whereDate('date', '>=', $start)->whereDate('date',   '<=', $end)


            if(Auth::user()->role == 1){
                $data = [];
                $student = Student::where(function ($q) use ($reg_no) {
                    $q->where('name','LIKE','%'.$reg_no.'%')->orWhere('reg_no','LIKE','%'.$reg_no.'%');
                })->get();
                if(count($student) == 0){
                    $data['status'] = false;
                    return Response::json($data);
                }

                $data = Attendence::with('student')->whereHas('student', function($q) use ($reg_no){
                    $q->where(function ($q) use ($reg_no) {
                        $q->where('name','LIKE','%'.$reg_no.'%')->orWhere('reg_no','LIKE','%'.$reg_no.'%');
                    });
                })->with(['student' => function($query) {
                    $query->select('id','name');
                }])->get();
            }elseif(Auth::user()->role == 2){
                $data = [];
                $student = Student::where(function ($q) use ($reg_no) {
                    $q->where('name','LIKE','%'.$reg_no.'%')->orWhere('reg_no','LIKE','%'.$reg_no.'%');
                })->where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id)->get();
                if(count($student) == 0){
                    $data['status'] = false;
                    return Response::json($data);
                }

                $data = Attendence::whereHas('student', function($q) use ($reg_no){
                    $q->where(function ($q) use ($reg_no) {
                        $q->where('name','LIKE','%'.$reg_no.'%')->orWhere('reg_no','LIKE','%'.$reg_no.'%');
                    });
                    $q->where('class_id',Auth::user()->teacherClass->class_id);
                    $q->where('level_id',Auth::user()->teacherClass->level_id);
                })->with(['student' => function($query) {
                    $query->select('id','name');
                }])->get();

            }elseif(Auth::user()->role == 3){

                $data = [];
                $students = Auth::user()->students->pluck('id')->toArray();
                $data = Attendence::with('student')->whereHas('student', function($q) use ($students){
                        $q->whereIn('id',$students);
                    })->with(['student' => function($query) {
                        $query->select('id','name');
                    }])->get();

            }
            return Response::json($data);
        }
//        return view('fullcalender');
    }


    public function loadAttendenceTableView(Request $request)
    {
        $page_title = 'Attendence Table View';
        $date = $request->date;
        $class = $request->class;
        $level = $request->level;
        $student = $request->student;
        $classes = ClassMain::get();
        $levels = LevelMain::get();

        if(Auth::user()->role == 2){
            $attendences = Student::with('attendence')->where('class_id',Auth::user()->teacherClass->class_id)->where('level_id',Auth::user()->teacherClass->level_id);
        }else{
            $attendences = Student::with('attendence');
            if($class){
                $attendences = $attendences->where('class_id',$class);
            }
            if($level){
                $attendences = $attendences->where('class_id',$class);
            }

        }
        if($student){
            $attendences = $attendences->where(function ($q) use ($student) {
                $q->where('name','LIKE','%'.$student.'%')->orWhere('reg_no','LIKE','%'.$student.'%');
            });
        }

        $attendences = $attendences->get();
        if($attendences){
            foreach ($attendences as $el){

                $test = $el->attendenceByDate($date)->first();
                $el['attend_arranged'] = $test ? $test->attend : 0;
            }
        }

        return view('attendence-table-view',compact('attendences','classes','levels','page_title'));
    }

    public function attendenceViewCalender()
    {
        $page_title = 'View Attendence';

            return view('attendence-calender-view',compact('page_title'));

    }
}
