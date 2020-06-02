@extends('layouts.member_base')
@section('member_content')
<h1 class="ttl_01">会員情報変更<span class="subttl">(パスワード変更・メールアドレス変更)</span></h1>

<div class="cont">
	<section>
	<h2 class="ttl_04">パスワード変更</h2>
	<form name="form1" id="form1" action="{{ config('const.member_setting_password_path') }}" method="post">
	{{csrf_field()}}
	<dl class="list_form">
	@if($errors->has('new_password'))
		<p>{{ $errors->first('new_password') }}</p>
	@endif
	@if($errors->has('new_password_confirmation'))
		<p>{{ $errors->first('new_password_confirmation') }}</p>
	@endif
	@if( !$errors->has('new_password') && !$errors->has('new_password_confirmation') && !empty($send_msg) )
		<p>{{ $send_msg }}</p>
	@endif
	<dt><label for="currentPassword">現在のパスワード</label></dt>
	<dd>{{ $password_raw }}</dd>
	<dt><label for="newPassword">新しいパスワード(半角英数字{{ config('const.password_length') }}桁以上)</label></dt>
	<dd><input type="password" name="new_password" maxlength="{{ config('const.password_max_length') }}" id="newPassword" class="size_M"></dd>
	<dt><label for="newPasswordRetry">確認用パスワード</label></dt>
	<dd><input type="password" name="new_password_confirmation" maxlength="{{ config('const.password_max_length') }}" id="newPasswordRetry" class="size_M"></dd>
	</dl>

	<p class="btn_red_02 size_SS"><button type="submit" value="パスワード変更" class="mlr_0">パスワード変更</button></p>
	</form>
	</section>

	<section>
	<h2 class="ttl_04">メールアドレス変更</h2>
	<form name="form2" id="form2" action="{{ config('const.member_setting_email_path') }}" method="post">
	{{csrf_field()}}
	<dl class="list_form">
	@if($errors->has('pc_email'))
		<p>{{ $errors->first('pc_email') }}</p>
	@endif
	@if( !empty($mail_send_msg) )
		<p>{{ $mail_send_msg }}</p>
	@endif
	@if( !empty($pc_email_status_msg) )
		{{ $pc_email_status_msg }}
	@endif
	<dd><input type="email" name="pc_email" value="{{ $email }}" maxlength="{{ config('const.email_length') }}" id="pc_mail_address" class="size_L"></dd>
	</dl>

	<p class="btn_red_02 size_SS"><button type="submit" value="アドレス変更" id="user_setting_btn" class="mlr_0">アドレス変更</button></p>
	</form>
	</section>
</div>
<script>
<!-- アドレス変更用のjavascript -->
$(document).ready(function () {
	アドレス変更ボタンのクリック
	$("#user_setting_btn").on("click", function () {
		var fm = document.form2;
		fm.submit();

		return false;
	});
});
</script>
@endsection