<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMelmagaHistoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('melmaga_history_logs', function (Blueprint $table) {
            $table->integer('melmaga_id');							//メルマガID
            $table->integer('client_id');							//クライアントID
			$table->integer('read_flg')->default(0);				//既読フラグ　未読：0 既読：1
			$table->dateTime('first_view_datetime')->nullable();	//最初にメルマガを観た日時
			$table->unsignedBigInteger('sort_date');				//ソートフラグ
            $table->timestamps();
			
			$table->unique(['melmaga_id', 'client_id']);
			$table->index('melmaga_id', 'idx_melmaga_id');
			$table->index('client_id', 'idx_client_id');
			$table->index('read_flg', 'idx_read_flg');
			$table->index('sort_date', 'idx_sort_date');
			$table->index('created_at', 'idx_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('melmaga_history_logs');
    }
}
