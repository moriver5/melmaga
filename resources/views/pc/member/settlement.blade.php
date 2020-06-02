@extends('layouts.member_base')
@section('member_content')
<h1 class="ttl_01">商品購入/ポイント追加</h1>

<div class="cont step">
<ol class="list_step">
<li><dl>
<dt>STEP 1</dt>
<dd>
<p>購入する商品を<br>
選択してください</p>
</dd>
</dl></li>
<li><dl>
<dt>STEP 2</dt>
<dd>
<p>支払い方法を<br>
選択してください</p>
</dd>
</dl></li>
<li><dl>
<dt>STEP 3</dt>
<dd>
<p>お申し込み完了</p>
</dd>
</dl></li>
</ol>

<p>弊社が会員様へご提供させて頂きます商品は競馬における情報（買い目）であり、いかなる場合でも決済が完了した時点で返品・返金には応じませんので、ご了承頂いた会員様のみ下記から購入される予約商品をご選択の上、「お申込」ボタンを押して下さい。</p>
</div>


<div class="cont">
	<section>
		<h2 class="ttl_03 size_M">キャンペーン情報購入</h2>
		@if( !empty($errors->all()) )
			<br />
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		@endif

		<form name=settlement action="/member/settlement/buy" method="post">
			{{csrf_field()}}
			@if( !empty($db_data) )
				<ul class="list_check">
					@foreach($db_data as $lines)
						<!-- ユーザーと同じグループの商品を表示 -->
						@if( empty($lines->groups) || in_array($group_id, explode(",", $lines->groups)) )
							<li>
								<input type="checkbox" id="id{{ $lines->id }}" name="product_id[]" value="{{ $lines->id }}" class="btn">
								<label for="id{{ $lines->id }}">
									<span class="text">{{ $lines->title }}</span>
									<span class="price">@php print number_format($lines->money); @endphp円</span>
								</label>
							</li>
						@endif
					@endforeach
				</ul>
			@endif

			<p class="f_b_blk">お支払い方法を下記よりお選びください。</p>
			<ul class="lyt_list_03">
				<li>
					<dl class="box_pay">
						<dt>クレジットカード</dt>
						<dd>カードにて商品の購入が24時間可能です。<br>VISA,JCB,MasterCard対応です。</dd>
						<dd class="btn">
							<p class="btn_red_02 size_S">
								<button type="submit" name="buy_method" value="2" alt="クレジットカードで購入する" />購入予約</button>
							</p>
						</dd>
					</dl>
				</li>

				<li>
					<dl class="box_pay">
						<dt>銀行振込・ネットバンク</dt>
						<dd>休日でも24時間お申し込み手続きと同時に<br>お振り込みが完了します。</dd>
						<dd class="btn">
							<p class="btn_red_02 size_S">
								<button type="submit" name="buy_method" value="3" alt="ネットバンク決済で購入する" />購入予約</button>
							</p>
						</dd>
					</dl>
				</li>
			</ul>
		</form>
	</section>
</div>

<div class="cont">
	<section>
		<h2 class="ttl_03 size_M">ポイント購入</h2>

		<form name=settlement action="/member/settlement/buy/point" method="post">
		{{csrf_field()}}
		@if( !empty($db_pt_data) )
			<ul class="list_radio">
			@foreach($db_pt_data as $lines)
				<li>
					<input type="radio" id="p{{ $lines->id }}" name="product_id" value="{{ $lines->id }}" class="btn">
					<label for="p{{ $lines->id }}">
					<span class="text">{{ $lines->point }}pt</span>
					<span class="price">{{ number_format($lines->money) }}円</span>
					</label>
				</li>
			@endforeach
			</ul>
		@endif

		<p class="f_b_blk">お支払い方法を下記よりお選びください。</p>
		<ul class="lyt_list_03">
			<li>
				<dl class="box_pay">
					<dt>クレジットカード</dt>
					<dd>カードにて商品の購入が24時間可能です。<br>VISA,JCB,MasterCard対応です。</dd>
					<dd class="btn">
						<p class="btn_red_02 size_S">
							<button type="submit" name="buy_method" value="2" />購入予約</button>
						</p>
					</dd>
				</dl>
			</li>

			<li>
				<dl class="box_pay">
				<dt>銀行振込・ネットバンク</dt>
				<dd>休日でも24時間お申し込み手続きと同時に<br>お振り込みが完了します。</dd>
				<dd class="btn">
					<p class="btn_red_02 size_S">
						<button type="submit" name="buy_method" value="3" />購入予約</button>
					</p>
				</dd>
				</dl>
			</li>
		</ul>
		</form>
	</section>
</div>
@endsection