<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('registered_mails', function (Blueprint $table) {
            $table->increments('id');						//ID
            $table->integer('specified_time');				//指定時間
            $table->integer('enable_flg');					//有効・無効
            $table->integer('item_type')->nullable();		//抽出項目のタイプ
            $table->string('item_value')->nullable();		//抽出項目の値
            $table->integer('like_type')->nullable();		//抽出項目の値を含む含まない
            $table->text('groups')->nullable();				//グループ
            $table->integer('device')->nullable();			//送信端末
            $table->string('title');						//タイトル
            $table->text('body')->nullable();				//メルマガ件名
            $table->text('html_body')->nullable();			//メルマガ内容
            $table->text('remarks')->nullable();			//メルマガ内容
			$table->timestamps();							//送信予約日時

			$table->index('id', 'idx_id');
			$table->index('specified_time', 'idx_specified_time');
			$table->index('enable_flg', 'idx_enable_flg');
			$table->index('item_type', 'idx_item_type');
			$table->index('item_value', 'idx_item_value');
			$table->index('like_type', 'idx_like_type');
			$table->index('device', 'idx_device');
			$table->index('title', 'idx_title');
		});
		DB::statement('ALTER TABLE registered_mails ADD FULLTEXT(`remarks`)');
		DB::statement('ALTER TABLE registered_mails ADD FULLTEXT(`groups`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('registered_mails');
    }
}
