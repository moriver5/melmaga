<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubLandingPagesPreviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_landing_pages_previews', function (Blueprint $table) {
			$table->integer('lp_id');
			$table->string('page_name',20);
			$table->string('name',20);
			$table->text('content')->nullable();
			$table->timestamps();

			$table->unique(['lp_id', 'page_name', 'name']);
			$table->index('lp_id', 'idx_lp_id');
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
        Schema::dropIfExists('sub_landing_pages_previews');
    }
}
