<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_landing_pages', function (Blueprint $table) {
			$table->integer('lp_id');
			$table->integer('open_flg')->default(0);
			$table->string('page_name');
			$table->string('memo')->nullable();
			$table->text('img')->nullable();
			$table->date('sort_date');
			$table->timestamps();

			$table->unique(['lp_id', 'page_name']);
			$table->index('open_flg', 'idx_open_flg');
			$table->index('page_name', 'idx_page_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_landing_pages');
    }
}
