<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\LeaveAplication;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use SebastianBergmann\Diff\Diff;

class LeaveApplicationsController extends Controller
{
    //  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        session(['pageTitle' => 'Leave Application']);
        $user = Auth::user();
        $leaveTypes = LeaveType::all();
        $all_leave_applications = LeaveAplication::all();
        $all_leave_applications = DB::table('leave_aplications')
            ->where('user_id', '=', $user->id)
            ->where('leave_type_id', '=',)
            ->get();
        return view(
            'leave-application.create',
            [
                'leaveTypes' => $leaveTypes,
                'user' => $user,
                'all_leave_applications' => $all_leave_applications,
            ]
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'leave_type_id' => 'required|not_in:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $user = Auth::user();

        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $now = \Carbon\Carbon::now();
        $day_of_aplication = \Carbon\Carbon::now();
        $leaveTypes = LeaveType::all();
        $noOfDayApplied = $endDate->diffInDays($startDate) + 1;
        $leave_status = 0;
        $joinDate = $user->joinDate;
        $diffYears = \Carbon\Carbon::now()->diffInYears($joinDate) + 1;
        $diffMonths = \Carbon\Carbon::now()->diffInMonths($joinDate) + 1;

        //Paid leave /number of Days calculated
        if ($diffMonths > 6) {
            $totalMonths = $diffMonths * 1.7;
            $totalPaidLeave = ($totalMonths / $diffYears);
            $noOfWorkingDay = ($now->diffInDays($joinDate) + 1) / $diffYears;
        } elseif ($diffMonths < 6) {
            $totalPaidLeave = $diffMonths * 1.7;
            $noOfWorkingDay = $now->diffInDays($joinDate) + 1;
        }

        //weekends
        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
        foreach ($period as $dt) {
            $curr = $dt->format('D');
            // substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $noOfDayApplied--;
            }
        }
        //National holidays
        $count = 0;
        $noOfPublicHoliday = 0;
        $holiday = Holiday::all()->toArray();
        $count = 0;
        foreach ($holiday as $i) {
            $holiday_start_date  = \Carbon\Carbon::parse($i['startDate']);
            $holiday_end_date  = \Carbon\Carbon::parse($i['endDate']);
            if (($startDate <= $holiday_start_date) || ($endDate >= $holiday_end_date)) {
                $noOfPublicHoliday = $holiday_end_date->diffInDays($holiday_start_date);
                $count++;
            }
        }
        $noOfPublicHoliday = $count + 1;
        //total Holidays without weekends and National Holidays
        $totalDeduct = $noOfDayApplied - $noOfPublicHoliday;
        //if leave is more than paid leave 
        foreach ($leaveTypes as $leaveType) {
            if (($totalDeduct > $totalPaidLeave) || ($totalDeduct > $leaveType->number_days_allowed)) {
                $noOfWorkingDay = $noOfWorkingDay - $leaveType->number_days_allowed;
            }
        }

        // $noOfWorkingDay = DB::table('leave_aplications')
        //     ->where('user_id', '=', $user->id)
        //     ->('noOfWorkingDay');


        $balance= new LeaveAplicationSummary(){
            'noOfDayDeduct' = $leaveAplication->totalDeduct,
            'noOfWorkingDay' = $leaveAplication->noOfWorkingDay,
        }
        $day_of_approval = \Carbon\Carbon::today();
        LeaveAplication::create([
            'leave_type_id' => $request->leave_type_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'leave_status' => $leave_status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'noOfDayApplied' => $noOfDayApplied,
            'noOfPublicHoliday' => $noOfPublicHoliday,
            'noOfDayDeduct' => $totalDeduct,
            'noOfWorkingDay' => $noOfWorkingDay,
            'day_of_aplication' => $day_of_aplication,
            'day_of_approval' => $day_of_approval,

        ]);

        // return $id;
        return redirect()->back();
    }

    // Mail::send(
    //     'layouts/email',
    //     [
    //         'day_of_aplication' => $request->get('day_of_aplication'),
    //         'comment' => $request->get('comment'),
    //         'start_date' => $request->get('start_date'),
    //         'end_date' => $request->get('end_date'),
    //         'user' => $user->name,
    //     ],
    //     function ($message) {
    //         $users = User::all();
    //         $message->from('MyLeje@nmc.al');
    //         foreach ($users as $user) {
    //             if ($user->role == 'admin') {
    //                 $message->to($user->email, $user->name);
    //             }
    //         }
    //     }
    // );

}