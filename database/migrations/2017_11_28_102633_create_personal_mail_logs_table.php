<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalMailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_mail_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
			$table->string('subject',100);
			$table->text('body');
            $table->timestamps();

			$table->index('id', 'idx_id');
			$table->index('client_id', 'idx_client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_mail_logs');
    }
}
