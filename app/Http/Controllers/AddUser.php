<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;


class AddUser extends Controller
{
    public function create()
    {
        return view('components.add-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'account_status' => ['required', 'boolean', 'max:1', 'min:0'],
            'position' => ['required', 'string', 'max:255'],
            'joinDate' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role' => $request->role,
            'account_status' => $request->account_status,
            'position' =>  $request->position,
            'joinDate' => $request->joinDate,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->back()->with('message', 'User added!');
    }
}
