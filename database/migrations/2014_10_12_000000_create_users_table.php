<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail_address')->unique()->nullable();
			$table->string('identify_id', 10)->nullable();
			$table->string('session_id', 20)->nullable();
			$table->text('description')->nullable();
			$table->unsignedTinyInteger('send_flg')->default(1);
			$table->unsignedTinyInteger('disable')->default(0);
			$table->bigInteger('regist_date');
			$table->bigInteger('last_access');
            $table->timestamps();
			
			$table->index('mail_address', 'idx_mail_address');
			$table->index('send_flg', 'idx_send_flg');
			$table->index('disable', 'idx_disable');
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
        Schema::dropIfExists('users');
    }
}
