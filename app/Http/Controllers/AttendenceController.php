<?php

namespace App\Http\Controllers;

use App\Absent;
use App\Attendence;
use App\Http\Requests\absentCreateValidationRequest;
use App\Student;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Record Attendence';
        $students = Student::where('class_id',Auth::user()->teacherClass->class_id)->get();
        return view('record-attendence',compact($students,'students',$page_title,'page_title'));
    }

    public function store(absentCreateValidationRequest $request)
    {
        $request = $request->request->all();

        foreach ($request['attend'] as $key=>$attend){

            $attend_status = $attend == 'yes' ? 1 : 0;
            $attend = Attendence::updateOrCreate(['student_id' => $key,'date' => $request['date']],
                ['attend' => $attend_status]);
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
}
