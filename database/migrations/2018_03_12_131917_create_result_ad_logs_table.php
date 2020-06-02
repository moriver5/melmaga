<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultAdLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_ad_logs', function (Blueprint $table) {
            $table->String('domain', 100);	//ドメイン
            $table->String('ad_cd');		//広告コード
            $table->Integer('access_date');	//結果日
            $table->Integer('pv');			//アクセス数
            $table->Integer('temp_reg');	//仮登録者数
            $table->Integer('reg');			//登録者数
            $table->Integer('quit');		//退会者数
            $table->Integer('active');		//アクティブ数
            $table->Integer('order_num');	//注文数
            $table->Integer('pay');			//購入数
            $table->Integer('amount');		//売上金額
            $table->timestamps();
	
			$table->unique(['domain', 'ad_cd', 'access_date']);
			$table->index('domain', 'idx_domain');
			$table->index('ad_cd', 'idx_ad_cd');
			$table->index('pv', 'idx_pv');
			$table->index('temp_reg', 'idx_temp_reg');
			$table->index('reg', 'idx_reg');
			$table->index('quit', 'idx_quit');
			$table->index('active', 'idx_active');
			$table->index('order_num', 'idx_order_num');
			$table->index('pay', 'idx_pay');
			$table->index('amount', 'idx_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_ad_logs');
    }
}
