<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;

class LeaveTypeController extends Controller
{
   public function index()
   {
      $leaveTypes = LeaveType::all();
      return view('leaveTypes.create');
   }
}
