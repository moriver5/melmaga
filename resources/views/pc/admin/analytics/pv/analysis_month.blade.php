@extends('layouts.app')

@section('content')
<br />
<div class="container">
    <div class="col">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
					<b>{{ $display }}-PVログ</b>
				</div>
                <div class="panel-heading" style="font:normal 12px/120% 'メイリオ',sans-serif;text-align:center;">
					<b><a href="/admin/member/analytics/pv/access/{{$prev_year}}/{{ $prev_month }}/{{ $pv_name }}">PREV</a>&nbsp;&nbsp;|&nbsp;&nbsp;<b><a href="/admin/member/analytics/pv/access/{{$year}}">{{ $year }}年</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/admin/member/analytics/pv/access/{{$next_year}}/{{ $next_month }}/{{ $pv_name }}">NEXT</a></b>
				</div>
				<div class="panel-heading">
					@if( !empty($db_data) )
						<center>
						<table border="1" align="center" style="width:100%;">
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;">
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:60px;">
									<b>{{ $month }}月</b>
								</td>
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;">
									
								</td>
							</tr>
							@foreach($db_data as $day => $lines)
								<tr style="font:12px/120% 'メイリオ',sans-serif;">
									<td style="padding:3px;text-align:center;">
										{{ $day }}日
									</td>
									<td style="padding:3px;text-align:center;" class="total">
										{{ $lines['total'] }}
									</td>
								</tr>
							@endforeach
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;background-color:#ffff99;">
								<td style="padding:3px;text-align:center;font-weight:bold;">
									合計
								</td>
								<td style="padding:3px;text-align:center;" id="total">

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
	//合計算出のための変数
	var total			 = 0;
	$.when(
		//全体の合計
		$('.total').each(function(){
			total += parseInt($(this).text());
		})
	).done(function(){
		//全体の合計
		$('#total').text(total);
	});
});
</script>

@endsection
