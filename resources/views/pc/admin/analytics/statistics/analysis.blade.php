@extends('layouts.app')

@section('content')
<br />
<div class="container">
    <div class="col">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
					<b>利用統計</b>
				</div>
                <div class="panel-heading" style="font:normal 12px/120% 'メイリオ',sans-serif;text-align:center;">
					<b><a href="/admin/member/analytics/statistics/access/{{$prev_year}}">PREV</a>&nbsp;&nbsp;|&nbsp;&nbsp;{{ $year }}年&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/admin/member/analytics/statistics/access/{{$next_year}}">NEXT</a></b>
				</div>
				<div class="panel-heading">
					@if( !empty($db_data) )
						<center>
						<table border="1" align="center" style="width:100%;">
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;">
								<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:60px;">
									{{ $year }}
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
							@foreach($db_data as $month => $lines)
								<tr style="font:12px/120% 'メイリオ',sans-serif;">
									<td style="padding:3px;text-align:center;" class="pay">
										<a href="/admin/member/analytics/statistics/access/{{ $year }}/{{ $month }}">{{ $month }}月</a>
									</td>
									<td style="padding:3px;text-align:center;" class="feb_count">
										@if( $lines['pv_total'] > 0 )
										{{ number_format($lines['pv_total']) }}
										@else
											0
										@endif
									</td>
									<td style="padding:3px;text-align:center;" class="mar_count">
										@if( $lines['regist_total'] > 0 )
										{{ number_format($lines['regist_total']) }}
										@else
											0
										@endif
									</td>
									<td style="padding:3px;text-align:center;" class="apr_count">
										@if( $lines['quite_total'] > 0 )
										{{ number_format($lines['quite_total']) }}
										@else
											0
										@endif
									</td>
								</tr>
							@endforeach
							<tr style="background-color:gray;">
								<td style="padding:1px;" colspan="13"></td>
							</tr>
							<tr style="font:normal 12px/120% 'メイリオ',sans-serif;background-color:#ffff99;">
								<td style="padding:3px;text-align:center;font-weight:bold;">
									合計
								</td>
								<td style="padding:3px;text-align:center;" id="total_feb">

								</td>
								<td style="padding:3px;text-align:center;" id="total_mar">

								</td>
								<td style="padding:3px;text-align:center;" id="total_apr">

								</td>
							</tr>
						</table>
						</center>
					@endif
				</div>
			</div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background:white;">
				<div id="regist_graph" style="height:400px;width:100%; "></div>
			</div>
		</div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background:white;">
				<div id="quite_graph" style="height:400px;width:100%; "></div>
			</div>
		</div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background:white;">
				<div id="pv_graph" style="height:400px;width:100%; "></div>
			</div>
		</div>

    </div>
</div>

<!-- 画面アラートJavascript読み込み -->
<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>

<script type="text/javascript">
$(document).ready(function(){
	//登録人数
	var currRegist = {name:'',data:[]};
	var prevRegist = {name:'',data:[]};

	//退会人数
	var currLeave = {name:'',data:[]};
	var prevLeave = {name:'',data:[]};

	//PV数
	var currPv = {name:'',data:[]};
	var prevPv = {name:'',data:[]};

	@foreach($db_data as $month => $lines)
		currRegist['name'] = '{{ $year }}';
		currRegist['data'][{{$loop->iteration - 1}}] = {{$lines['regist_total']}};
		currLeave['name'] = '{{ $year }}';
		currLeave['data'][{{$loop->iteration - 1}}] = {{$lines['quite_total']}};
		currPv['name'] = '{{ $year }}';
		currPv['data'][{{$loop->iteration - 1}}] = {{$lines['pv_total']}};
	@endforeach

	@foreach($db_prev_data as $month => $lines)
		prevRegist['name'] = '{{ $prev_year }}';
		prevRegist['data'][{{$loop->iteration - 1}}] = {{$lines['regist_total']}};
		prevLeave['name'] = '{{ $prev_year }}';
		prevLeave['data'][{{$loop->iteration - 1}}] = {{$lines['quite_total']}};
		prevPv['name'] = '{{ $prev_year }}';
		prevPv['data'][{{$loop->iteration - 1}}] = {{$lines['pv_total']}};
	@endforeach

	//グラフ表示(登録者数)
	Highcharts.chart('regist_graph', {
		chart: {
			type: 'line'
		},
		title: {
			text: '登録者数'
		},
		xAxis: {
			categories: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
		},
		yAxis: {
			title: {
				text: '登録者数'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},
		series: [currRegist, prevRegist]
	});

	Highcharts.chart('quite_graph', {
		chart: {
			type: 'line'
		},
		title: {
			text: '退会者数'
		},
		xAxis: {
			categories: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
		},
		yAxis: {
			title: {
				text: '退会者数'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},
		series: [currLeave, prevLeave]
	});

	Highcharts.chart('pv_graph', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'PV数'
		},
		xAxis: {
			categories: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
		},
		yAxis: {
			title: {
				text: 'PV数'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},
		series: [currPv, prevPv]
	});

	//合計/平均算出のための変数
	var feb_count	 = 0;
	var mar_count	 = 0;
	var apr_count	 = 0;
	
	$.when(
		//
		$('.feb_count').each(function(){
			var count = $(this).text().replace(/,/g,"");
			feb_count += parseInt(count);
		}),
		//
		$('.mar_count').each(function(){
			var count = $(this).text().replace(/,/g,"");
			mar_count += parseInt(count);
		}),
		//
		$('.apr_count').each(function(){
			var count = $(this).text().replace(/,/g,"");
			apr_count += parseInt(count);
		})
	).done(function(){
		//合計
		$('#total_feb').text(feb_count.toLocaleString());
		//合計
		$('#total_mar').text(mar_count.toLocaleString());
		//合計
		$('#total_apr').text(apr_count.toLocaleString());		
	});
});
</script>

@endsection
