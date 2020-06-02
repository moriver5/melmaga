<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMelmagaLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('melmaga_logs', function (Blueprint $table) {
            $table->increments('id');								//送信ID
            $table->integer('send_status');							//送信状況 0:配信待ち　1:送信中　2:配信済　3:キャンセル　4:履歴を残さない　5:履歴を残さない場合の送信済
            $table->integer('send_count');							//送信数
            $table->integer('send_method')->nullable();				//配信方法
            $table->string('from_name',50);							//送信者
            $table->string('from_mail');							//送信元メールアドレス
            $table->string('subject');								//メルマガ件名
            $table->text('text_body')->nullable();					//メルマガ内容
            $table->text('html_body')->nullable();					//メルマガHTML内容
            $table->text('query')->nullable();						//SQL
            $table->text('bindings')->nullable();					//SQL条件
            $table->text('items')->nullable();						//条件項目をJSON形式で保存する
			$table->text('exclusion_groups')->nullable();			//除外するグループIDを半角カンマでつなげた文字列
            $table->dateTime('send_date')->nullable();				//送信日時
            $table->dateTime('reserve_send_date')->nullable();		//送信予定日時
            $table->unsignedBigInteger('sort_reserve_send_date')->nullable();	//ソート用の送信予定日
			$table->timestamps();									//送信予約日時

			$table->index('id', 'idx_order_id');
			$table->index('send_status', 'idx_send_status');
			$table->index('send_count', 'idx_send_count');
			$table->index('send_date', 'idx_send_date');
			$table->index('reserve_send_date', 'idx_reserve_send_date');
			$table->index('sort_reserve_send_date', 'idx_sort_reserve_send_date');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('melmaga_logs');
    }
}
