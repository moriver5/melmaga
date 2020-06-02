<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->increments('payment_id');
			$table->tinyInteger('pay_type');
            $table->string('login_id');
            $table->integer('type');
            $table->integer('product_id');
            $table->integer('order_id')->nullable();
            $table->integer('money');
            $table->unsignedInteger('point')->default(0);
			$table->string('ad_cd', 255)->nullable();
			$table->string('status', 20)->nullable();
			$table->string('sendid', 40)->nullable();
			$table->dateTime('regist_date')->nullable();
			$table->integer('pay_count');
			$table->integer('sort_date')->nullable();
            $table->timestamps();

			$table->unique(['product_id', 'order_id', 'type']);
			$table->index('payment_id', 'idx_payment_id');
			$table->index('pay_type', 'idx_pay_type');
			$table->index('login_id', 'idx_login_id');
			$table->index('product_id', 'idx_product_id');
			$table->index('order_id', 'idx_order_id');
			$table->index('money', 'idx_money');
			$table->index('point', 'idx_point');
			$table->index('ad_cd', 'idx_ad_cd');
			$table->index('regist_date', 'idx_regist_date');
			$table->index('sort_date', 'idx_sort_date');
			$table->index('pay_count', 'idx_pay_count');
			$table->index('status', 'idx_status');
			$table->index('sendid', 'idx_sendid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_logs');
    }
}
