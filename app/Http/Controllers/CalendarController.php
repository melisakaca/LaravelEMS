<?php

namespace App\Http\Controllers;

use App\Models\LeaveAplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = LeaveAplication::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date', '<=', $request->end)
                ->get();
            $data = $data->map(function ($item) {

                $user = DB::table('users')
                    ->join('leave_aplications', 'leave_aplications.user_id', '=', 'users.id')
                    ->where('leave_aplications.id', $item->id)
                    ->get('users.name');
                $user = $user->map(function ($user) {
                    return $user->name;
                });
                return [
                    'title' => $user,
                    'start' => $item->start_date,
                    'end' => $item->end_date,
                ];
            });
            return response()->json($data);
        }

        return view('dashboard.calendar');
    }

    
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = LeaveAplication::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date', '<=', $request->end)
                ->get();

            $data = $data->map(function ($item) {
                $user_id = Auth::user()->id;

                if ($user_id == $item->user_id) {
                    $leave_type = DB::table('leave_types')
                        ->join('leave_aplications', 'leave_aplications.leave_type_id', '=', 'leave_types.id')
                        ->where('leave_aplications.id', $item->id)
                        ->get('leave_type_name');

                    $leave_type = $leave_type->map(function ($leave_type) {
                        return $leave_type->leave_type_name;
                    });

                    return [
                        'title' => $leave_type,
                        'start' => $item->start_date,
                        'end' => $item->end_date,
                    ];
                } else {
                    return [];
                }
            });
            return response()->json($data);
        }

        return view('dashboard.calendar');
    }
}
