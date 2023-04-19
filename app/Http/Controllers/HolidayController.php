<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HolidayController extends Controller
{
    public function create()
    {
        return view('components.holidays');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'startDate' => ['required'],
            'endDate' => ['required'],
        ]);

        $holidays = Holiday::create([
            'name' => $request->name,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]);


        Mail::send(
            'layouts/extra-leave',
            [
                'name' => $request->get('name'),
                'startDate' => $request->get('startDate'),
                'endDate' => $request->get('endDate'),
                'user' => $user->name,
                'user' => $user->email,
            ],
            function ($message) {
                $users = User::all();
                $message->from('MyLeje@nmc.al');
                foreach ($users as $user) {
                    $message->to($user->email, $user->name);
                }
            }
        );

        return redirect()->back()->with('message', 'Holiday added!');
    }

    public function index(Request $request)
    {
        if ($request->has('trashed')) {
            $holidays = Holiday::onlyTrashed()
                ->get();
        } else {

            $holidays = Holiday::get();
        }
        return view('dashboard.holidays-crud', compact('holidays'));
    }


    public function destroy($id)
    {
        Holiday::find($id)->delete();
        return redirect()->back();
        // session()->flash('message', 'Question successfully deleted.');

    }
    public function restore($id)
    {
        Holiday::withTrashed()->find($id)->restore();
        return redirect()->back();
    }
    public function restoreAll()
    {
        Holiday::onlyTrashed()->restore();
        return redirect()->back();
    }

    public function edit(Holiday $holiday)
    {
        return view('components.edit-holiday', ['holidays' => $holiday]);
    }


    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'startDate' => ['required'],
            'endDate' => ['required'],

        ]);
        $holiday->update($request->all());
        return redirect('/holidays-crud');
    }
}
