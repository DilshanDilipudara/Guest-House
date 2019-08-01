<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;



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
    
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'Uname' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Nicno'=> 'required|string|max:12|unique:users',
            'Empno'=> 'required|string|size:5|unique:users',
            
            'Pno'=> 'required|string|max:10|unique:users',
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
        return User::create([
            'Uname' => $data['Uname'], 
            'Email' => $data['Email'],
            'Empno' => $data['Empno'],
            'gender' => $data['gender'],
            'faculty' => $data['faculty'],
            'Position' => $data['Position'],
            'Pno' => $data['Pno'],
            'Nicno' => $data['Nicno'],
            'password' => bcrypt($data['password']),

    ]);

    


    }
    protected function registered(Request $request,$user)
    {
        $this->guard()->logout();
        return redirect('/');
    }
}