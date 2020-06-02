<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('open_flg')->default(0);
			$table->string('domain');
			$table->string('memo')->nullable();
			$table->text('img')->nullable();
			$table->integer('piwik_id')->nullable();
			$table->date('sort_date');
			$table->timestamps();

			$table->index('id', 'idx_id');
			$table->index('sort_date', 'idx_sort_date');
			$table->index('domain', 'idx_domain');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_pages');
    }
}
