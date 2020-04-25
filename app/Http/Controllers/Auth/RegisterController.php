<?php

namespace App\Http\Controllers\Auth;

use App\ClassMain;
use App\Http\Controllers\Controller;
use App\LevelMain;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\Student;
use App\TeacherClassMap;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.register');
    }
    public function showRegistrationForm()
    {
        $roles = Role::get();
        $classes = ClassMain::get();
        $levels = LevelMain::get();
        $students = Student::get();
        return view('auth.register',compact('roles','classes','levels','students'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'class' => ['required_if:role,==,2','required_if:role,==,4'],
            'level' => ['required_if:role,==,2','required_if:role,==,4'],
            'student' => ['required_if:role,==,3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);

            if($data['role'] == 2){
                $teacherClassMap = new TeacherClassMap();
                $teacherClassMap->user_id = $user->id;
                $teacherClassMap->level_id = $data['level'];
                $teacherClassMap->class_id = $data['class'];
                $teacherClassMap->save();
            }

            if($data['role'] == 3){
                $student = Student::find($data['student']);
                $student->parent_id = $user->id;
                $student->save();
            }



        if($data['role'] == 4){
            $student = new Student();
            $student->name = $data['name'];
            $student->class_id = $data['class'];
            $student->level_id = $data['level'];
            $student->parent_id = 0;
            $student->reg_no = 0;
            $student->save();
            $reg_no = sprintf("%04d", $student->id);
            $reg_no = 'reg'.$reg_no;
            $student->update(['reg_no' => $reg_no]);
        }

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }
}
