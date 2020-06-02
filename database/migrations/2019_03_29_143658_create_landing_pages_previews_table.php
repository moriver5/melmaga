<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesPreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages_previews', function (Blueprint $table) {
			$table->integer('lp_id');
			$table->string('name',20);
			$table->text('content')->nullable();
			$table->timestamps();

			$table->unique(['lp_id', 'name']);
			$table->index('lp_id', 'idx_lp_id');
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
        Schema::dropIfExists('landing_pages_previews');
    }
}
