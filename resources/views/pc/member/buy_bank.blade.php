@extends('layouts.member_base')
@section('member_content')
<div class="cont">
	<section>
		<h2 class="ttl_03 size_M">銀行振込</h2>

		<p>
			申込み頂いた内容を、登録のメールアドレスに送信致しました。<br />
			以下内容と併せてご覧になり、お手続きを進めてください。
		</p>
		<br />
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
		<p align="left">2. 振込人欄に、お名前ではなく下記の【お振込番号】をご入力の上、電信扱いにてお振り込みください。</p>
		<table width="515" border="0" cellspacing="0" cellpadding="0" class="table_gry mail_02">
			<tr>
				<td>
					<p>お振込み番号</p>
				</td>
				<td width="375">
					<p>{{ $login_id }}</p>
				</td>
			</tr>
		</table>
		<p align="left">※ 上記のお振り込み番号を振り込み人名義にお書きください。</p>
		<br />
		<p align="left">3.振込口座</p>
		<table width="515" border="0" cellspacing="0" cellpadding="0" class="table_gry mail_02">
			<tr>
				<td>
					<p>銀行名</p>
				</td>
				<td width="375">
					<p>みずほ銀行</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>支店名</p>
				</td>
				<td width="375">
					<p>世田谷支店</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>口座番号</p>
				</td>
				<td width="314">
					<p>普通 1325066</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>振込み先名義</p>
				</td>
				<td width="314">
					<p>ユ）ルーツ</p>
				</td>
			</tr>
		</table>
		<br />
		<div>
			お振込み手数料は、お客様のご負担となります。ご了承下さい。<br />
			午後3時以降にお手続き頂いたご入金の確認は翌銀行営業日となります事をご了承ください。<br />
			<br />
			<div>&lt;ご入金、お振込み後のお問合せ先&gt;</div>
			<div><a href="mailto:{{ config("const.mail_from") }}">{{ config("const.mail_from") }}</a></div>
		</div>
		<br />
		<div>
			<a href="/member/settlement">商品購入ページに戻る</a>
		</div>
	</section>
</div>
@endsection
