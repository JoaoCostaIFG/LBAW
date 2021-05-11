<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $achievements = Achievement::all();
        
        return view("pages.profile", ['user' => $user, 'achievements' => $achievements ]);
    }

    public function showOwn()
    {
        if (!Auth::check()) {
          return back()->withErrors([
              'user' => 'You are not logged in']);
        }

        return redirect()->route('profile', [Auth::id()]);
    }

    // TODO pass this to policy
    public function showApi()
    {
        if (!Auth::check()) {
          return response()->json([
              'message' => 'Unauthorized (not signed-in).'
          ], 401);
        }

        return response()->json([
            'post' => Auth::user()
        ], 200);

    }

    public function delete()
    {
        if (!Auth::check()) {
          return back()->withErrors([
              'user' => 'You are not logged in']);
        }

        DB::delete('DELETE FROM "user" where id = ?', [Auth::id()]);

        Auth::logout();
        return redirect()->intended('register');
    }

    public function edit(){
        if (!Auth::check()) {
            return back()->withErrors([
                'user' => 'You are not logged in']);
        }
  
        return view("pages.edit_account", ['user' => Auth::user()]);
    }

    public function update(Request $request){
        $user = User::find(Auth::id());

        $validation = $this->validator($request, $user);
        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->except('password', 'password_confirmation'));

        // Update
        $data = $request->all();
        if(isset($data['email']))
            $user->email = $data['email'];
        if(isset($data['username']))
            $user->username = $data['username'];
        if(isset($data['password']))
            $user->password = bcrypt($data['password']);
        if(isset($data['name']))
            $user->name = $data['name'];
        if(isset($data['about']))
            $user->about = $data['about'];
        
        $user->save();
        return redirect()->intended('/user');
    }

    protected function validator(Request $request, User $user){
        if($request->input('first-name') != null)
            $fname = $request->input('first-name');
        else
            $fname = $user->firstName;

        if($request->input('last-name') != null)
            $lname = $request->input('last-name');
        else
            $lname = $user->lastName;

        $request['name'] = $fname . ' ' . $lname;

        $validation = Validator::make($request->all(), [
            'email' => 'nullable|string|email|max:255|unique:user',
            'username' => 'nullable|string|max:255|unique:user',
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|required_with:password',
            'about' => 'nullable|string|max:500',
            'name' => ['nullable' , 'string', 'max:255',
                function($attr, $name, $fail) {
                    if (str_starts_with($name, 'Deleted User'))
                        $fail('Name cannot start with \'Deleted User\'');
                }
            ]
        ]);

        return $validation;
    }
}

