<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_id');
            $table->tinyInteger('pay_type');
			$table->date('login_date');
            $table->timestamps();
			
			$table->unique(['login_id', 'login_date']);
			$table->index('login_id', 'idx_login_id');
			$table->index('pay_type', 'idx_pay_type');
			$table->index('login_date', 'idx_login_date');
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
        Schema::dropIfExists('access_logs');
    }
}
