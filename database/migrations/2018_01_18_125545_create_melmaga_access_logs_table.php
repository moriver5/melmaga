<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMelmagaAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     * メルマガの閲覧ログ
	 * 
     * @return void
     */
    public function up()
    {
        Schema::create('melmaga_access_logs', function (Blueprint $table) {
            $table->integer('melmaga_id');		//メルマガID
            $table->string('login_id');			//ユーザーID
			$table->integer('access_date');		//メルマガ内容のリンクをクリックしたときの日時をフォーマットしたものyyyymmddhhmm
            $table->timestamps();
			
			$table->unique(['melmaga_id', 'login_id']);
			$table->index('melmaga_id', 'idx_melmaga_id');
			$table->index('login_id', 'idx_login_id');
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
        Schema::dropIfExists('melmaga_access_logs');
    }
}
