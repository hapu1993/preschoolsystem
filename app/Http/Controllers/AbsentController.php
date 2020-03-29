<?php

namespace App\Http\Controllers;

use App\Absent;
use App\Http\Requests\absentCreateValidationRequest;
use App\Student;
use Auth;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    //
    public function index()
    {
        $students = Student::where('parent_id',Auth::user()->id)->get();

        return view('absent',compact('students'));
    }

    public function store(absentCreateValidationRequest $request)
    {
        $request = $request->request->all();
        $request['reg_no'] = Student::find($request['student_id']);
        $new_absent = Absent::create($request);

        return redirect()->back()->with('success', 'IT WORKS!');
    }
}
