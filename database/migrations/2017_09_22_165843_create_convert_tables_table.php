<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvertTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convert_tables', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('group_id');
            $table->string('key',100);
            $table->string('value')->nullable();
            $table->string('memo')->nullable();			
            $table->timestamps();

			$table->index('key', 'idx_key');
			$table->index('group_id', 'idx_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('convert_tables');
    }
}
