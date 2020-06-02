<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearPvLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_pv_logs', function (Blueprint $table) {
            $table->String('id', 32);						//ID
            $table->Integer('access_date');
            $table->String('url');
            $table->Integer('total');
            $table->timestamps();
			
			$table->unique(['access_date','url']);
			$table->index('access_date', 'idx_access_date');
			$table->index('url', 'idx_url');
			$table->index('total', 'idx_total');
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
        Schema::dropIfExists('year_pv_logs');
    }
}
