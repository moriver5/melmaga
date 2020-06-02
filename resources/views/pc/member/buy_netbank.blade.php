@extends('layouts.member_base')
@section('member_content')
<div class="cont">
	<section>
		<h2 class="ttl_03 size_M">ネットバンク</h2>

		<p align="left">1.　決済金額</p>
		<table width="519" border="0" cellspacing="0" cellpadding="0" class="table_gry mail_02">
			@if( isset($db_data) )
				<tr>
					<td rowspan="{{ $total }}"><p>ご購入キャンペーン</p></td>
				@foreach($db_data as $index => $lines)
					<td width="375">
						<p>
							<!-- 商品 -->
							@if( !empty($lines->title) )
								{{ $lines->title }}&nbsp;&nbsp;@php print number_format($lines->money); @endphp円
							<!-- pt -->
							@else
								{{ $lines->point }}pt&nbsp;&nbsp;@php print number_format($lines->money); @endphp円							
							@endif
						</p>
					</td>
				</tr>
				@endforeach
				<tr>
					<td><p>ご購入金額合計</p></td>
					<td width="375"><p class="f_bold">@php print number_format($total_amount); @endphp円</p></td>
				</tr>
			@endif
		</table>
		<br />
		<p align="left">2. 上記でよろしければ、SSL決済ボタンを押して認証を行ってください。<br />
		（SSL決済ページへ移動します）</p>
		<span id="errmsg" style="color:red;font-weight:bold;"></span>
		<form id="formSettlement" class="form-horizontal" method="POST" action="/member/settlement/buy/send">
			{{ csrf_field() }}
			<input type="hidden" name="clientip" value="{{ config('const.netbank_client_ip') }}">
			<input type="hidden" name="money" value="{{ $total_amount }}">
			<input type="hidden" name="email" value="{{ $email }}">
			<input type="hidden" name="sendid" value="">
			<input type="hidden" name="sendpoint" value="{{ $order_id }}">
			<input type="hidden" name="act" value="order">
			<input type="hidden" name="siteurl" value="{{ config('const.axes_success_link_url') }}">
			<input type="hidden" name="sitestr" value="{{ mb_convert_encoding(config('const.axes_success_link_text'), 'SJIS-win', 'UTF-8') }}">
			<p class="btn_red_02 size_S"><button id="push_settlement" type="submit" alt="SSL決済ページへ">SSL決済ページへ</button></p>
		</form>
		<p>※ お客様の個人情報を守る為、ＳＳＬ（暗号化）通信を導入しております。</p>
		<div>
			<ul>
				<li><img src="/images/logo_japannet.gif"></li>
				<li><img src="/images/logo_sbisumishin.gif"></li>
			</ul>
			<br />
			<p>ジャパンネット銀行口座、住信SBIネット銀行口座からお振り込みのお客様は、 休日でも24時間お申し込み手続きと同時にお振り込みが完了します。その他の銀行の場合、午後3時以降にお手続き頂いた場合のご入金確認は翌銀行営業日となります事をご了承下さい</p>
		</div>
		<br />
		<palign="left">■ 決済に関するご注意<br />
			銀行振り込みでのお支払いは、<a href="http://www.axes-payment.co.jp/info/bank/pc/index.html" target="_blank">（株）AXES Paymentの決済システム</a>を利用しています。<br />
			個人情報の入力に不安のある方は<a href="http://www.axes-payment.co.jp/credituser.html" target="_blank">（株）AXES Payment - 安心・安全への取り組み</a>をお読み下さい。
		</p>
		<br />
		<div>
			<a href="/member/settlement">商品購入ページに戻る</a>
		</div>
	</section>
</div>

<script src="/js/ajax.js"></script>
<script>
$(document).ready(function () {
	ajax('formSettlement', 'push_settlement', 'post', '{{ csrf_token() }}', '{{ config('const.axes_netbank_settlement_url') }}', '{{__('message.ajax_connect_error_msg')}}');
});
</script>
@endsection
