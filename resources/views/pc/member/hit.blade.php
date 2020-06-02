@extends('layouts.member_base')
@section('member_content')
	<h1 class="ttl_01">的中実績</h1>
	<div class="cont">
		<ul class="list_pager">
			{{ $db_data->links('vendor.pagination.user_default') }}
		</ul>

		@if( !empty($list_hit_data) )
			<ul class="list_hit">
			@foreach($list_hit_data as $lines)
				<li>
				<dl class="box_hit">
				<dt><span class="date">{{ $lines['date'] }}</span><br>
				{{ $lines['name'] }} {{ $lines['msg1'] }}</dt>
				<dd class="item">{{ $lines['msg2'] }}</dd>
				@if( preg_match("/^\d+$/", $lines['msg3']) > 0 )
					<dd class="dvdnds">{{ number_format($lines['msg3']) }}円</dd>
				@else
					<dd class="dvdnds">{{ $lines['msg3'] }}</dd>
				@endif
				<dd class="badge">的中</dd>
				</dl>
				</li>
			@endforeach
			</ul>
		@endif

		<ul class="list_pager">
			{{ $db_data->links('vendor.pagination.user_default') }}
		</ul>
	</div>
@endsection