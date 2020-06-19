<?php

namespace App\Http\Controllers;

use App\Absent;
use App\ClassMain;
use App\Http\Requests\absentCreateValidationRequest;
use App\LevelMain;
use App\Student;
use Auth;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    //
    public function index()
    {
        $page_title = 'Send Absent Letter';
        $students = Student::where('parent_id',Auth::user()->id)->get();

        return view('absent',compact('students'));
    }

    public function store(absentCreateValidationRequest $request)
    {
        $request = $request->request->all();
        $request['reg_no'] = Student::find($request['student_id'])->reg_no;
        $new_absent = Absent::create($request);

        return redirect()->back()->with('success', 'IT WORKS!');
    }

    public function list(Request $request)
    {
        $page_title = 'Absent Letters';
        $classes = ClassMain::get();
        $levels = LevelMain::get();
        if(Auth::user()->role == 1){
            $absent_letters = Absent::whereNotNull('id');
        }elseif (Auth::user()->role == 2){
            $absent_letters = Absent::whereHas('student', function($q){
                $q->where('class_id', '=', Auth::user()->teacherClass->class_id);
                $q->where('level_id', '=', Auth::user()->teacherClass->level_id);
            });
        }

        if($request->class){

            $class_id = $request->class;
            $absent_letters = $absent_letters->whereHas('student', function($q) use ($class_id){
                $q->where('class_id', '=', $class_id);
            });
        }
        if($request->level){

            $level_id = $request->level;
            $absent_letters = $absent_letters->whereHas('student', function($q) use($level_id){
                $q->where('level_id', '=', $level_id);
            });
        }

        if($request->student){

            $student = $request->student;
            $absent_letters = $absent_letters->whereHas('student', function($q) use($student){
                $q->where('name','LIKE','%'.$student.'%')->orWhere('reg_no','LIKE','%'.$student.'%');
            });
        }
        $absent_letters = $absent_letters->get();
        return view('absent-list',compact('absent_letters','classes','levels','page_title'));
    }
}
