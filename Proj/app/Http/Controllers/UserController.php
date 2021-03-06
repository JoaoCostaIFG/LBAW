<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function show($username)
    {
        $validation = Validator::make(['username' => $username], [
            'username' => 'required|exists:user,username',
        ]);

        if ($validation->fails())
            return abort(404);

        $user = User::where('username', $username)->get()[0];

        $achievements = Achievement::all();
        return view("pages.profile", ['user' => $user, 'achievements' => $achievements]);
    }

    public function showOwn()
    {
        if (!Auth::check()) {
            return back()->withErrors([
                'user' => 'You are not logged in'
            ]);
        }

        return redirect()->route('profile', [Auth::user()->username]);
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
                'user' => 'You are not logged in'
            ]);
        }

        DB::delete('DELETE FROM "user" where id = ?', [Auth::id()]);

        Auth::logout();
        return redirect()->intended('register');
    }

    public function ban_procedure($data)
    {
        $validation = Validator::make($data, [
            'admin_id' => 'required|integer|exists:administrator,id',
            'user_id' => 'required|integer|exists:user,id',
            'reason' => 'nullable|string|max:100',
        ]);
        if (!$validation->fails())
            User::banUser($data);

        return $validation;
    }

    public function ban(Request $request)
    {
        if (!Auth::check()) {
            return back()->withErrors([
                'user' => 'You are not logged in'
            ]);
        }

        $admin = Auth::user();
        $data = $request->all();
        $data['admin_id'] = $admin->id;
        $validation = $this->ban_procedure($data);

        if ($validation != null) {
            if ($validation->fails())
                return back()->withErrors($validation);
        }

        return redirect()->route('profile', ['DeletedUser' . $data['user_id']]);
    }

    public function edit()
    {
        if (!Auth::check()) {
            return back()->withErrors([
                'user' => 'You are not logged in'
            ]);
        }

        return view("pages.edit_account", ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validation = $this->validator($request, $user);
        if ($validation->fails())
            return back()->withErrors($validation)->withInput($request->except('password', 'password_confirmation'));

        // Update
        $data = $request->all();
        if (isset($data['email']))
            $user->email = $data['email'];
        if (isset($data['username']))
            $user->username = $data['username'];
        if (isset($data['password']))
            $user->password = bcrypt($data['password']);
        if (isset($data['name']))
            $user->name = $data['name'];
        if (isset($data['about']))
            $user->about = $data['about'];
        if (isset($data['avatar'])) {
            if ($user->picture != "default.jpg") { // Delete old picture
                Storage::delete('public/' . $user->picture);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->picture = $path;
        }

        $user->save();
        return redirect('/profile/' . $user->username)->with('status', 'Profile updated successfully!');
    }

    protected function validator(Request $request, User $user)
    {
        if ($request->input('first-name') != null)
            $fname = $request->input('first-name');
        else
            $fname = $user->firstName;

        if ($request->input('last-name') != null)
            $lname = $request->input('last-name');
        else
            $lname = $user->lastName;

        $request['name'] = $fname . " " . $lname;

        $validation = Validator::make($request->all(), [
            'email' => 'nullable|string|email|max:255|unique:user',
            'username' => [
                'nullable', 'string', 'max:32', 'unique:user',
                function ($attr, $name, $fail) {
                    if (str_starts_with($name, 'Deleted User'))
                        $fail('Name cannot start with \'Deleted User\'');
                }
            ],
            'password' => 'nullable|string|min:6|confirmed|required_with:password_confirmation
            |regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/',
            'password_confirmation' => 'nullable|required_with:password',
            'about' => 'nullable|string|max:256',
            'name' => 'nullable|string|max:60',
            'avatar' => 'nullable|image'
        ]);

        return $validation;
    }
}
