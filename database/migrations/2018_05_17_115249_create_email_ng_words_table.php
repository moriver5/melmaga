<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailNgWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_ng_words', function (Blueprint $table) {
			$table->string('type',15);
			$table->text('word')->nullable();
            $table->timestamps();

			$table->unique('type');
			$table->index('type', 'idx_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_ng_words');
    }
}
