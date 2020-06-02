<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayPvLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_pv_logs', function (Blueprint $table) {
            $table->String('ad_cd');
			$table->string('login_id')->nullable();
            $table->Integer('access_date');
            $table->timestamps();
	
			$table->index('ad_cd', 'idx_ad_cd');
			$table->index('login_id', 'idx_login_id');
			$table->index('access_date', 'idx_access_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_pv_logs');
    }
}
