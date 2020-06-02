<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
			$table->Integer('client_id');
			$table->Integer('group_id');
			$table->tinyInteger('status')->default(1);
			$table->Integer('category_id')->nullable();
			$table->string('sex', 1)->nullable();
			$table->string('age', 1)->nullable();
			$table->string('ad_cd', 255)->nullable()->default('');
            $table->rememberToken();
			$table->dateTime('quit_datetime')->nullable();
			$table->bigInteger('sort_quit_datetime')->nullable();
			$table->bigInteger('regist_date');
			$table->bigInteger('last_access');
			$table->unsignedTinyInteger('disable')->default(0);
            $table->timestamps();

			$table->unique(['client_id', 'group_id']);
			$table->index('client_id', 'idx_client_id');
			$table->index('group_id', 'idx_group_id');
			$table->index('ad_cd', 'idx_ad_cd');
			$table->index('status', 'idx_status');
			$table->index('sex', 'idx_sex');
			$table->index('age', 'idx_age');
			$table->index('quit_datetime', 'idx_quit_datetime');
			$table->index('sort_quit_datetime', 'idx_sort_quit_datetime');
			$table->index('regist_date', 'idx_regist_date');
			$table->index('disable', 'idx_disable');
			$table->index('category_id', 'idx_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
}
