<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
     {
         $user = Auth::user();
 
         return view('users.mypage', compact('user'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
 
         return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
 
         $user->name = $request->input('name') ? $request->input('name') : $user->name;
         $user->email = $request->input('email') ? $request->input('email') : $user->email;
         $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
         $user->address = $request->input('address') ? $request->input('address') : $user->address;
         $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
         $user->update();
 
         return to_route('mypage')->with('flash_message', '会員情報を更新しました。');
    }


    public function reservations()
    {
        $user = Auth::user();
        $reservations = $user->reservations()->where('reservationday', '>', date('Y-m-d H:i'))->get();
        return view('users.reservations', compact('reservations'));
    }

    public function destroy()
    {
        $restaurant->delete();
        $user = Auth::user();
        $user->delete();

        return to_route('restaurants.index');
    }

}
