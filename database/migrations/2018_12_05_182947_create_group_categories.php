<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_categories', function (Blueprint $table) {
			$table->increments('id');
			$table->Integer('group_id');
			$table->string('category',100);
			$table->string('memo')->nullable();
            $table->timestamps();

			$table->unique(['group_id', 'category']);
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
		Schema::dropIfExists('group_categories');
    }
}
