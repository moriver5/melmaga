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
			<td>{{ preg_replace("/(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/", "$1/$2/$3 $4:$5:$6", $db_data->send_date) }}</td>
		</tr>
		<tr class="subject">
			<th>件名</th>
			<td>{{ $db_data->subject }}</td>
		</tr>
		<tr class="message">
		<td colspan="2">
			@if( empty($db_data->html_body) )
				{!! preg_replace("/\n/", '<br />', $db_data->text_body) !!}
			@else
				{!! $db_data->html_body !!}				
			@endif
		</td>
		</tr>
		</tbody>
		</table>
	@endif
</section>
</div>
</section>
@endsection