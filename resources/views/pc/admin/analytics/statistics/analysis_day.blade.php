@extends('layouts.app')

@section('content')
<br />
<div class="container">
    <div class="col">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
					<b>利用統計</b>
				</div>
                <div class="panel-heading" style="font:normal 12px/120% 'メイリオ',sans-serif;text-align:center;">
					<b><a href="/admin/member/analytics/statistics/access/{{ $year }}/{{$prev_month}}/{{$prev_day}}">PREV</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/admin/member/analytics/statistics/access/{{ $year }}">{{ $year }}</a>年{{ $month }}月{{ $day }}日&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/admin/member/analytics/statistics/access/{{ $year }}/{{$next_month}}/{{$next_day}}">NEXT</a></b>
				</div>
				<div class="panel-heading">
					<center>{{ $db_data->links() }}</center>
					@if( !empty($db_data) )
						<center>
						<table border="1" align="center" style="width:100%;">
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;">
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									<b>{{ $year }}</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									<b>アクセス</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									<b>PV</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									<b>登録人数</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									<b>退会人数</b>
								</td>
							</tr>
							@foreach($db_data as $lines)
								<tr style="font:12px/120% 'メイリオ',sans-serif;">
									<td style="padding:3px;text-align:center;" class="order_no">
										<a href="#" onclick="openOrderWin('{{ $lines->client_id }}', '{{ $lines->order_id }}');">{{ $lines->payment_id }}</a>
									</td>
									<td style="padding:3px;text-align:center;" class="settlement_date">
										{{ $lines->regist_date }}
									</td>
									<td style="padding:3px;text-align:center;" class="regist_date">
										{{ $lines->user_regist_date }}
									</td>
									<td style="padding:3px;text-align:center;">
										<a href="/admin/member/client/edit/{{ $db_data->currentPage() }}/{{ $lines->client_id }}">{{ $lines->email }}</a>
									</td>
									<td style="padding:3px;text-align:center;">
										{{ $lines->last_access_datetime }}
									</td>
								</tr>
							@endforeach
							<tr style="background-color:gray;">
								<td style="padding:1px;" colspan="13"></td>
							</tr>
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;background-color:#ffff99;">
								<td style="padding:3px;text-align:center;font-weight:bold;" colspan="4">
									合計
								</td>
								<td style="padding:3px;text-align:center;" id="total_pay">

								</td>
								<td style="padding:3px;text-align:center;" id="total_amount">

								</td>
							</tr>
						</table>
						</center>
					@endif
				</div>
			</div>

        </div>
    </div>
</div>

<!-- 画面アラートJavascript読み込み -->
<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	//合計/平均算出のための変数
	var pay_total	 = 0;
	var amount_total = 0;

	$.when(
		//
		$('.regist_date').each(function(){
			$(this).text($(this).text().replace(/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/,"$1-$2-$3 $4:$5:$6"));
		}),
		//
		$('.pay_count').each(function(){
			pay_total += parseInt($(this).text());
		}),
		//
		$('.pay_money').each(function(){
			amount_total += parseInt($(this).text());
		})
	).done(function(){
		$('#total_pay').text(pay_total);
		$('#total_amount').text(amount_total);
	});
});

function openOrderWin(client_id, order_id){
	var order_detail_win = window.open('{{ config('const.base_url') }}/admin/member/client/edit/' + client_id + '/order/history/' + order_id, 'order_detail', 'width=600, height=620');
	return false;
}
</script>

@endsection
