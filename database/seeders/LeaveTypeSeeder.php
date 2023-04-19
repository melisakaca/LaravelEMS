<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('leave_types')->insert([
            'leave_type_name' => 'Vacation leave',
            'leave_type_description' => 'Vacation leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 1,
            'need_raport' => 0,
        ]);
        DB::table('leave_types')->insert([
            'leave_type_name' => 'Medical leave',
            'leave_type_description' => 'Medical leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 1,
            'need_raport' => 1,
        ]);
        DB::table('leave_types')->insert([
            'leave_type_name' => 'Birth leave',
            'leave_type_description' => 'Birth leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 5,
            'need_raport' => 0,
        ]);
        DB::table('leave_types')->insert([
            'leave_type_name' => 'Marriage leave',
            'leave_type_description' => 'Marriage leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 5,
            'need_raport' => 0,
        ]);
        DB::table('leave_types')->insert([
            'leave_type_name' => 'Misfortune leave',
            'leave_type_description' => 'Misfortune leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 3,
            'need_raport' => 0,
        ]);
        DB::table('leave_types')->insert([
            'leave_type_name' => 'Unpaid leave',
            'leave_type_description' => 'Unpaid leave',
            'cycleMonth' => 3,
            'number_days_allowed' => 1,
            'need_raport' => 0,
        ]);
    }
}