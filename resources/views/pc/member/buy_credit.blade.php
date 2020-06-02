@extends('layouts.member_base')
@section('member_content')
<div class="cont">
	<section>
		<h2 class="ttl_03 size_M">クレジットカード</h2>

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
<!--		<form name="formSettlement" method="post" action="https://gw.axes-payment.com/cgi-bin/credit/order.cgi" ENCTYPE="x-www-form-encoded" TARGET="_top">-->
		<span id="errmsg" style="color:red;font-weight:bold;"></span>
		<form id="formSettlement" class="form-horizontal" method="POST" action="/member/settlement/buy/send">
			{{ csrf_field() }}
			<input type="hidden" name="clientip" value="{{ config('const.credit_client_ip') }}">
			<input type="hidden" name="money" value="{{ $total_amount }}">
			<input type="hidden" name="email" value="{{ $email }}">
			<input type="hidden" name="sendid" value="">
			<input type="hidden" name="sendpoint" value="{{ $order_id }}">
			<input type="hidden" name="success_url" value="{{ config('const.axes_success_link_url') }}">
			<input type="hidden" name="success_str" value="{{ mb_convert_encoding(config('const.axes_success_link_text'), 'SJIS-win', 'UTF-8') }}">
			<input type="hidden" name="failure_url" value="{{ config('const.axes_failure_link_url') }}">
			<input type="hidden" name="failure_str" value="{{ mb_convert_encoding(config('const.axes_failure_link_text'), 'SJIS-win', 'UTF-8') }}">
			<p class="btn_red_02 size_S"><button id="push_settlement" type="submit" alt="SSL決済ページへ">SSL決済ページへ</button></p>
		</form>
		<p>※ お客様の個人情報を守る為、ＳＳＬ（暗号化）通信を導入しております。</p>
		<div>
			<ul>
				<li><img src="/images/logo_visa.gif" width="35"><p>VISA</p></li>
				<li><img src="/images/logo_jcb.gif"><p>JCB</p></li>
				<li><img src="/images/logo_mastercard.gif"><p>Master Card</p></li>
			</ul>
			<br />
			<p>各社クレジットカードにて商品の購入が24時間可能です。<br /> VISA,JCB,MasterCardのマークが付いているカードがご利用になれます。</p>
		</div>
		<br />
		<p align="left">
			■ 請求書に記載される請求名について<br />
			カード会社より発行される明細書に、「AXES Payment」名義で請求されます。<br />
			<a href="http://www.axes-payment.co.jp/credituser.html" target="_blank">（株）AXES Payment - 安心・安全への取り組み</a></p>
			<br />
			■ クレジットカード決済に関するご説明<br>
			  決済システムは（株）AXES Paymentを利用しています<br>
			  <a href="https://gw.axes-payment.com/cgi-bin/pc_exp.cgi?clientip=1011004040"> 必ずお読みください</a><br><br>
			■ カード決済に関するお問い合わせ<br>
			  カスタマーサポート（24時間365日)<br>
			  TEL：0570-03-6000（03-3498-6200）<br>
			  <a href="mailto:creditinfo@axes-payment.co.jp">creditinfo@axes-payment.co.jp</a><br>
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
	ajax('formSettlement', 'push_settlement', 'post', '{{ csrf_token() }}', '{{ config('const.axes_credit_settlement_url') }}', '{{__('message.ajax_connect_error_msg')}}');
});
</script>
@endsection
