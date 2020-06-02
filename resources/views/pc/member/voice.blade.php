@extends('layouts.member_base')
@section('member_content')
<h1 class="ttl_01">会員様の声</h1>

<div class="cont">
<ul class="list_pager">{{ $page_link }}</ul>

@if( !empty($db_data) )
	<ul class="lyt_list_02">
	@foreach($db_data as $lines)
		<li>
			<dl class="box_voice">
				<dt>メルマガ会員</dt>
				<dd>{!! nl2br(e(trans($lines['msg']))) !!}</dd>
			</dl>
		</li>
	@endforeach
	</ul>
@endif
<ul class="list_pager">{{ $page_link }}</ul>

</div>
@endsection