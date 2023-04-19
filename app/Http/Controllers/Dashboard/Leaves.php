<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\LeaveAplication;
use App\Models\LeaveType;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class Leaves extends Controller
{
    public function index()
    {
        $users = LeaveAplication::join('users', 'leave_aplications.user_id', '=', 'users.id')
            ->join('leave_types', 'leave_aplications.leave_type_id', '=', 'leave_types.id')
            ->get(['leave_aplications.*', 'users.name', 'leave_types.leave_type_name']);

        return view('dashboard.my-leaves', ['users' => $users]);
    }
    public function leavesToApprove()
    {
        $users = LeaveAplication::join('users', 'leave_aplications.user_id', '=', 'users.id')
            ->join('leave_types', 'leave_aplications.leave_type_id', '=', 'leave_types.id')
            ->where('leave_aplications.leave_status', '=', 0)
            ->get(['leave_aplications.*', 'users.name', 'leave_types.leave_type_name']);

        return view('dashboard.leaves-to-approve', ['users' => $users]);
    }
    public function approveLeave(Request $request, $id)
    {
        // dd($id);
        // $user = Auth::user();
        $userAllDetails = LeaveAplication::join('users', 'leave_aplications.user_id', '=', 'users.id')
            ->where('leave_aplications.id', '=', $id)
            ->get(['users.id', 'users.email', 'users.*', 'leave_aplications.id AS aplication_id']);

        // $applId = LeaveAplication::where('leave_aplications.id', '=', $id)->get('leave_aplications.id');

        // foreach ($userAllDetails as $aId) {
        //     dd($aId);
        // }

        $users = DB::table('leave_aplications')
            ->where('id', '=', $id)
            ->update(['leave_status' => 1]);

        foreach ($userAllDetails as $userDet) {
            // dd($userDet['email']);
            Mail::send(
                'layouts/leave_response',
                [
                    'day_of_aplication' => $request->get('day_of_aplication'),
                    'comment' => $request->get('comment'),
                    'start_date' => $request->get('start_date'),
                    'end_date' => $request->get('end_date'),
                    'leave_status' => $request->get('leave_status'),
                    'user_id' => $userDet['id'],
                    'email' => $userDet['email'],
                    'id' => $id,
                ],

                function ($message) {
                    $userAllDetails = LeaveAplication::join('users', 'leave_aplications.user_id', '=', 'users.id')
                        ->where('leave_aplications.id','=',1) //applications id
                        ->get(['users.id', 'users.email', 'users.*', 'leave_aplications.id AS aplication_id']);

                    $message->from('MyLeje@nmc.al');
                    foreach ($userAllDetails as $userDet) {
                        $message->to($userDet['email'], $userDet['name']);
                    }
                }
            );
        }
        return redirect()->back();
    }
    public function declineLeave(Request $request, $id)
    {
        $user = Auth::user();

        $users = DB::table('leave_aplications')
            ->where('id', '=', $id)
            ->update(['leave_status' => -1]);


        Mail::send(
            'layouts/leave_response1',
            [
                'day_of_aplication' => $request->get('day_of_aplication'),
                'comment' => $request->get('comment'),
                'start_date' => $request->get('start_date'),
                'end_date' => $request->get('end_date'),
                'leave_status' => $request->get('leave_status'),
                'user' => $user->name,
            ],
            function ($message) {
                $user = Auth::user()->email;
                $message->from('MyLeje@nmc.al');
                $message->to($user);
            }
        );

        return redirect()->back();
    }
}
