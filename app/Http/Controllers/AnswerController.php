<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{

    /**
     * Get a validator for an incoming comment add request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'body' => 'required|string|min:1',
        ]);
    }

    public function create(Request $request)
    {

        $this->authorize('create', Answer::class);

        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return back()->withErrors($validation);
        }


        // create_answer(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT)
        // $answer = DB::transaction(function () use ($request) {
            DB::select("CALL create_answer(?, ?, ?, ?)", [Auth::id(), $request->body, date("Y-m-d"), $request->id]);
            // return Answer::latest('id')->limit(1);
        // });

        echo Answer::latest('id')->first();

        return redirect()->back();
    }
}