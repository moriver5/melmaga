<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubLandingPagesContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_landing_pages_contents', function (Blueprint $table) {
			$table->integer('lp_id');
			$table->integer('url_open_flg')->default(0);
			$table->string('page_name',20);
			$table->string('name',20);
			$table->text('content')->nullable();
			$table->timestamps();

			$table->unique(['lp_id', 'page_name', 'name']);
			$table->index('url_open_flg', 'idx_url_open_flg');
			$table->index('page_name', 'idx_page_name');
			$table->index('name', 'idx_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_landing_pages_contents');
    }
}
