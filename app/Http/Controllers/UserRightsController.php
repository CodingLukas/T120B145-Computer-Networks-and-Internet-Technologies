<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->whereIn('user_level', [0,2])->get();

        return view('users.index', compact('users'))->with('i',0);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_level' => 'required',
        ]);

        $data = [
            'user_level' => $request->get('userLevel'),
        ];

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Vartotojas sekmingai atnaujintas');
    }
}
