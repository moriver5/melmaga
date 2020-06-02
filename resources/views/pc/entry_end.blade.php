@extends('layouts.entry_base')
@section('entry')
<main>
<h1 class="ttl_01">本登録完了</h1>
<section>
<div class="cont">
	本登録が完了しました。<br />
	下記のログインから会員ページをご利用ください。
	<form name="login" id="login" action="{!! url($login_url) !!}" method="post">
		{{csrf_field()}}
		<p class="btn_red_02 size_S">
		<input type="submit" value="ログイン" />
		<input type="hidden" name="login_id" value="{{ $login_id }}" />
		<input type="hidden" name="password" value="{{ $password }}" />
		</p>
	</form>
</div>
</section>

</main>
@endsection