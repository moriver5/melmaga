<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_access_logs', function (Blueprint $table) {
			$table->String('domain', 100);				//ドメイン
			$table->String('ad_cd');					//広告コード
			$table->Integer('uu');						//アクセス数(メルマガ登録関係なくユニーク数)
			$table->Integer('au');						//アクティブ数(メルマガ登録者のアクセスユニーク数)
			$table->Integer('reg');						//登録数(メルマガ登録者のユニーク数)
			$table->Integer('access_date');				//アクセス日			
            $table->timestamps();

			$table->unique(['ad_cd', 'domain', 'access_date']);
			$table->index('uu', 'idx_uu');
			$table->index('au', 'idx_au');
			$table->index('reg', 'idx_reg');
			$table->index('access_date', 'idx_access_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_access_logs');
    }
}
