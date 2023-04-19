<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

class CreateLeaveAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_aplications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('day_of_aplication');
            $table->date('day_of_approval');
            $table->integer('leave_status');
            $table->text('comment');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('noOfWorkingDay');
            $table->integer('noOfPublicHoliday');
            $table->integer('noOfDayDeduct');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_aplications');
    }
}
