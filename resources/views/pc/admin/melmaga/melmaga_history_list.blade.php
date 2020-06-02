@extends('layouts.app')

@section('content')
<br />
<div class="container">
    <div class="col">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
					<b>メルマガ配信履歴-配信リスト</b>
				</div>
                <div class="panel-heading" style="font:normal 12px/120% 'メイリオ',sans-serif;text-align:center;">
					全件数：{{$total }} 件
					({{$currentPage}} / {{$lastPage}}㌻)
					<center>{{ $links }}</center>
				</div>
				<div class="panel-heading">
					@if( !empty($db_data) )
						<center>
						<table border="1" align="center" style="width:100%;">
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;">
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:80px;">
									<b>クライアントID</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:80px;">
									<b>送信</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:80px;">
									<b>メルマガ閲覧</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:80px;">
									<b>メルマガ履歴</b>
								</td>
							</tr>
							@foreach($db_data as $lines)
								<tr style="font:12px/120% 'メイリオ',sans-serif;">
									<td style="padding:3px;text-align:center;width:100px;" class="no_pay">
										<a href="/admin/member/client/list/{{$currentPage}}/{{ $lines->client_id }}" target="_blank">{{ $lines->client_id }}</a>
									</td>
									<td style="padding:3px;text-align:center;width:100px;" class="no_pay">
										@if( empty($lines->not_send_id) )
											〇
										@else
											<span style="color:red;">送信失敗</span>
										@endif
									</td>
									<td style="padding:3px;text-align:center;width:100px;" class="no_pay">
										@if( $lines->read_flg == 1 )
											閲覧済
										@else
											<span style="color:lightgray;">未閲覧</span>
										@endif
									</td>
									<td style="padding:3px;text-align:center;width:100px;">
										<a href="/admin/member/client/edit/{{ $lines->client_id }}/melmaga/history" target="_blank">メルマガ履歴</a>
									</td>
								</tr>
							@endforeach
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
	var no_pay			 = 0;
	var pay				 = 0;
	var total			 = 0;
	var no_pay_average	 = 0;
	var pay_average		 = 0;
	var total_average	 = 0;
	
	$.when(
		//入金なし合計
		$('.no_pay').each(function(){
			no_pay += parseInt($(this).text());
		}),
		
		//入金あり合計
		$('.pay').each(function(){
			pay += parseInt($(this).text());
		}),
		
		//全体の合計
		$('.total').each(function(){
			total += parseInt($(this).text());
		})
	).done(function(){
		//入金なし合計
		$('#total_no_pay').text(no_pay);
		
		//入金あり合計
		$('#total_pay').text(pay);
		
		//全体の合計
		$('#total_amount').text(total);
		
		//入金なし平均
		$('#no_pay_average').text(getFloor(no_pay/12, 1));
		
		//入金あり平均
		$('#pay_average').text(getFloor(pay/12, 1));
		
		//全体の平均
		$('#total_average').text(getFloor(total/12, 1));
	});
});
</script>

@endsection
