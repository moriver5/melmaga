@extends('layouts.member_base')
@section('member_content')
<section>
	<h1 class="ttl_01">メールボックス</h1>

	<div class="cont message">
	<p>お客様に送信されたメールは、こちらのページでご確認できます。</p>
	</div>

	<div class="cont">
		<section>
		<h2 class="ttl_03 size_M">受信メール一覧</h2>
		@if( !empty($db_data) )
			<table class="table_gry mail_02">
			<colgroup style="width:25%;"></colgroup>
			<colgroup style="width:75%;"></colgroup>
			<tbody>
			<tr class="date">
				<th>受信日時</th>
				<td>{{ preg_replace("/:\d{2}$/", "", $db_data->reply_date) }}</td>
			</tr>
			<tr class="subject">
				<th>件名</th>
				<td>{{ e($db_data->subject) }}</td>
			</tr>
			<tr class="message">
			<td colspan="2">
				{!! preg_replace("/\n/", '<br />', e($db_data->msg)) !!}
			</td>
			</tr>
			</tbody>
			</table>
		@endif
		</section>
	</div>
</section>
@endsection