<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveAplication extends Model
{
    use HasFactory;
    use SoftDeletes;
    
        protected $fillable = [
            'leave_type_id',
            'user_id',
            'day_of_aplication',
            'day_of_approval',
            'leave_status',
            'leave_type_id',
            'comment',
            'start_date',
            'end_date',
            'noOfWorkingDay',
            'noOfPublicHoliday',
            'noOfDayDeduct',    
        ];
}
