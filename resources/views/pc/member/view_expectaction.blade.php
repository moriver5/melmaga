@extends('layouts.member_base')
@section('member_content')
	<h1 class="ttl_01">無料情報</h1>

	<div class="cont">
		<section>
		<h2 class="ttl_03">タイトル</h2>
		<p class="txt_info">{{ $db_data->title }}</p>
		</section>

		<section>
		<h2 class="ttl_03">コメント</h2>
		<p class="txt_info">{{ $db_data->comment }}</p>
		</section>

		<section>
		<h2 class="ttl_03">内容</h2>
		{!! $db_data->detail !!}
		</section>
	</div>
@endsection