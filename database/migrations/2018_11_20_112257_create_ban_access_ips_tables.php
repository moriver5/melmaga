<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanAccessIpsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('ban_access_ips', function (Blueprint $table) {
            $table->string('access_ip',15);
            $table->Integer('group_id');
            $table->Integer('limit_access');
            $table->timestamps();

			$table->unique(['access_ip', 'group_id']);
			$table->index('access_ip', 'idx_access_ip');
			$table->index('group_id', 'idx_group_id');
			$table->index('limit_access', 'idx_limit_access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ban_access_ips');
    }
}
