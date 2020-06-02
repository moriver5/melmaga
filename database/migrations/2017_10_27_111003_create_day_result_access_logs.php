<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayResultAccessLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_result_access_logs', function (Blueprint $table) {
//            $table->increments('id');
            $table->Integer('access_date');
            $table->Integer('no_pay');
            $table->Integer('pay');
            $table->Integer('total');
            $table->Integer('no_pay24');
            $table->Integer('pay24');
            $table->Integer('total24');
            $table->timestamps();
			
			$table->unique('access_date');
			$table->index('access_date', 'idx_access_date');
			$table->index('created_at', 'idx_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('day_result_access_logs');
    }
}
