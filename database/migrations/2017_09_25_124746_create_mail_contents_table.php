<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mail_contents', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('group_id');
			$table->integer('type');
            $table->string('from',50);
            $table->string('from_mail');
            $table->string('subject',100);
            $table->text('body')->nullable();
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
        //
		Schema::dropIfExists('mail_contents');
    }
}
