<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagnificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magnification_settings', function (Blueprint $table) {
            $table->String('type',20);
            $table->integer('default_id');
            $table->integer('category_id');
            $table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
            $table->timestamps();
			
			$table->unique('type');
			$table->index('type', 'idx_type');
			$table->index('default_id', 'idx_default_id');
			$table->index('category_id', 'idx_category_id');
			$table->index('start_date', 'idx_start_date');
			$table->index('end_date', 'idx_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magnification_settings');
    }
}
