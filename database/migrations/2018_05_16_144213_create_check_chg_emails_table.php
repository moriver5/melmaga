<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckChgEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_chg_emails', function (Blueprint $table) {
            $table->string('login_id');
			$table->String('token',32);
			$table->String('email');
            $table->timestamps();

			$table->unique('login_id');
			$table->index('login_id', 'idx_login_id');
			$table->index('token', 'idx_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_chg_emails');
    }
}
