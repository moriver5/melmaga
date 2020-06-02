<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_logs', function (Blueprint $table) {
			$table->String('login_id');
            $table->Integer('melmaga_id')->nullable();
			$table->String('page')->nullable();
            $table->timestamps();
	
			$table->index('login_id', 'idx_ad_cd');
			$table->index('melmaga_id', 'idx_melmaga_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_logs');
    }
}
