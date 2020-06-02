<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMelmagaTempImmediateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('melmaga_temp_immediate_mails', function (Blueprint $table) {
            $table->integer('melmaga_id');						//送信ID
            $table->integer('client_id');							//usersテーブルのid
            $table->integer('success_flg')->nullable();				//送信成功したのかのフラグ
			$table->timestamps();

			$table->unique(['melmaga_id', 'client_id']);
			$table->index('melmaga_id', 'idx_melmaga_id');
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
		Schema::dropIfExists('melmaga_temp_immediate_mails');
    }
}
