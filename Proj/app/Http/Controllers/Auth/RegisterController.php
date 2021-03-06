<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'username' => ['required', 'string', 'max:255', 'unique:user', 
                function($attr, $name, $fail) {
                    if (str_starts_with($name, 'Deleted User'))
                        $fail('Name cannot start with \'Deleted User\'');
                }
            ],
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'picture' => 'default.jpg'
        ]);
    }

    public function register(Request $request) {

        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput($request->except('password'));
        }

        $user = $this->create($request->all());
        Auth::login($user);
        return redirect()->intended('/user');
    }
}
