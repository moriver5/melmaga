<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_settings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name',30);
			$table->text('tag')->nullable();
			$table->Integer('open_flg')->default(0);
            $table->timestamps();

			$table->index('open_flg', 'idx_open_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_settings');
    }
}
