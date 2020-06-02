@extends('layouts.member_base')
@section('member_content')
<main>
<h1 class="ttl_01">お問い合わせ</h1>

<section>
<h2 class="ttl_02">各種お問い合わせについて</h2>
<div class="cont">
	<p>退会をご希望の方は「退会希望」と記入の上メールを送信して下さい。ご登録のメールアドレス宛てにご返信致します。<br />
ご不明な点がございましたら、下記よりサービスセンターまでお問い合わせくださいませ。</p><br />
	<form action="{{ config('const.member_info_confirm_path') }}" method="post" name="form1">
		{{csrf_field()}}
		<div>
			エラーや、不具合に関するお問い合わせは、ご利用環境の情報をなるべく詳細にご入力下さい。</p><br />
		</div>
		@if( !empty($inquiry_msg) )
			<div style="text-align:center;"><b>{{ $inquiry_msg }}</b></div><br />
		@endif
		@if($errors->has('subject'))
			<p>{{ $errors->first('subject') }}</p>
		@endif
		@if($errors->has('contents'))
			<p>{{ $errors->first('contents') }}</p>
		@endif
		<div align="center"> <span>▼各種お問合せについて▼</span><br />
			件名 <input type="text" name="subject" maxlength={{ config('const.subject_length') }}>
			<textarea  name="contents" rows="7" cols="10" maxlength={{ config('const.contents_length') }}></textarea>
		</div>
		<p>「送信」をクリックすると、メルマガ運営管理へ送信されます。</p>
		<div align="center">
			<p class="btn_red_02 size_S">
				<button type="submit" alt="送信" />送信</button>
			</p>
		</div>
	</form>
</div>
</section>
</main>
@endsection