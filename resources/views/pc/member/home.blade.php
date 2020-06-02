@extends('layouts.member_base')
@section('member_content')
	<ul class="list_race">
	@if( !empty($list_hit_data) )
		@foreach($list_hit_data as $index => $lines)
			<li><a href="/member/hit"><dl>
			<dt>{{ $lines['name'] }} {{ $lines['msg1'] }}</dt>
			<dd><img src="{{$img_url}}/_sample-images/_dummy_race-0{{ ($index+1) }}.jpg" alt=""></dd>
			</dl></a></li>
			@if( $loop->iteration == 3 )
				@break;
			@endif
		@endforeach
	@endif
	</ul>

	<ul class="list_hit_02">
	@if( !empty($list_hit_data) )
		@foreach($list_hit_data as $lines)
			<li>
			<p>的中!!</p>
			<p>{{ $lines['date'] }}{{ $lines['name'] }}{{ $lines['msg1'] }}{{ $lines['msg3'] }}円ヒット!!</p>
			</li>
			@if( $loop->iteration == 4 )
				@break;
			@endif
		@endforeach
	@endif
	</ul>

	<section>
	<h2 class="ttl_01">厳選情報一覧</h2>
	<ul class="lyt_list_01">
	@if( !empty($db_data) )
	@foreach($db_data as $lines)
		<!-- ユーザーと同じグループのバナーを表示 -->
		@if( empty($lines->groups) || in_array($group_id, explode(",", $lines->groups)) )
			<li>
			<!-- リンクフラグがON -->
			@if( $lines->link_flg == 1 )
				<!-- URLが空でないとき -->
				@if( !empty($lines->url) )
					<a href="{{ $lines->url }}">
						<dl class="box_spot">
							<dt><img src="{{$top_content_img_url}}/{{$lines->img}}"></dt>
<!--							<dd class="animated inviewfadeInUp">情報提供枠数：<span>30枠</span> / 残り枠数：<span>5</span></dd>-->
						</dl>
					</a> 
				<!-- URLが空のとき -->
				@elseif( !empty($lines->img) )
					<dl class="box_spot">
						<dt><img src="{{$top_content_img_url}}/{{$lines->img}}"></dt>
<!--						<dd class="animated inviewfadeInUp">情報提供枠数：<span>30枠</span> / 残り枠数：<span>5</span></dd>-->
					</dl>
				@endif
			<!-- リンクフラグがOFF -->
			@else
				<!-- キャンペーン -->
				@if( $lines->type == 1 )
					@if( !empty($lines->img) )
					<a href="{{$campaign_url}}{{$lines->id}}">
						<dl class="box_spot">
							<dt><img src="{{$top_content_img_url}}/{{$lines->img}}"></dt>
<!--							<dd class="animated inviewfadeInUp">情報提供枠数：<span>30枠</span> / 残り枠数：<span>5</span></dd>-->
						</dl>
					</a>
					@endif
				<!-- レギュラー -->
				@else
					@if( !empty($lines->img) )
					<a href="{{$regular_url}}{{$lines->id}}">
						<dl class="box_spot">
							<dt><img src="{{$top_content_img_url}}/{{$lines->img}}"></dt>
<!--							<dd class="animated inviewfadeInUp">情報提供枠数：<span>30枠</span> / 残り枠数：<span>5</span></dd>-->
						</dl>
					</a>
					@endif
				@endif
			@endif
			</li>
		@endif
	@endforeach
	@endif
	</ul>
	</section>
@endsection

