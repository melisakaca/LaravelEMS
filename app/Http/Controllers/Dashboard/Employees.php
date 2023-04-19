<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests;
use Psy\CodeCleaner\UseStatementPass;

class Employees extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('trashed')) {
            $users = User::onlyTrashed()
                ->get();
        } else {

            $users = User::get();
        }
        return view('dashboard.employees', compact('users'));
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
        // session()->flash('message', 'Question successfully deleted.');

    }
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    public function restoreAll()
    {
        User::onlyTrashed()->restore();
        return redirect()->back();
    }

    public function edit(User $user)
    {
        return view('components.edit-user', ['users' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'gender' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'account_status' => ['required', 'boolean', 'max:1', 'min:0'],
            'position' => ['required', 'string', 'max:255'],
            'joinDate' => ['required'],

        ]);
        $user->update($request->all());
        return redirect('/employees');
    }
}
