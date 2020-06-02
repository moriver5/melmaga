<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateOrderIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('create_order_ids', function (Blueprint $table) {
            $table->increments('order_id');
            $table->string('key',20)->default('product');

			$table->index('order_id', 'idx_order_id');
			$table->unique('key');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('create_order_ids');
    }
}
