<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta name="robots" content="noindex,nofollow">
    <meta charset="utf-8">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>メルマガ運営管理</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet" />
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
<br />

<div class="container">
    <div class="col">
        <div class="col-md-8 col-md-offset" style="width:99%;">
            <div class="panel panel-default">
                <div class="panel-heading">
					<b>タグ編集</b>
					<span class="convert_windows_close" style="font-size:14px;background:darkgray;float:right;padding:2px 4px 2px 4px;">close</span>
				</div>
                <div class="panel-body">
                    <form id="formTagEdit" class="form-horizontal" method="POST" action="/admin/member/master/tags/setting/edit/{{ $db_data->id }}/send">
						{{ csrf_field() }}
						<center>

							<div>
								<div class="form-group" style="align:center;">
									<table border="1" width="95%">
										<tr style="text-align:center;background:wheat;font-weight:bold;">
											<td>タグ名</td>
											<td><input type="text" name="tag_name" value="{{ $db_data->name }}" size="40" maxlength="{{ config('const.tag_name_length') }}" class="form-control"></td>
										</tr>
										<tr style="text-align:center;">
											<td colspan="2">
												<textarea cols="50" rows="20" name="tag" class="form-control">{{ $db_data->tag }}</textarea>
											</td>
										</tr>
									</table>
								</div>
								<button type="submit" class="btn btn-primary">更新する</button>
							</div>
							<br />
							<table border="1" align="center" width="70%" style="text-align:center;">
								<tr>
									<td colspan="6" style="padding:5px;background:wheat;">
										※記述上の注意
									</td>
								</tr>
								<tr>
									<td style="padding:5px;background:wheat;">
										置換文字
									</td>
									<td style="padding:5px;background:wheat;">
										説明
									</td>
								</tr>
								<tr>
									<td style="padding:5px;">
										&lt;SITE_PIWIK_ID&gt;
									</td>
									<td style="padding:5px;">
										LP登録時に設定したpiwikのIDに変換される
									</td>
								</tr>
							</table>
						</center>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 画面アラートJavascript読み込み -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	//閉じるをクリック
	$('.convert_windows_close').on('click', function(){
		window.close();
	});
	
	//アカウント編集ボタン押下後のダイアログ確認メッセージ
	//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
	submitAlert('formTagEdit', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.add_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);

});
</script>

</body>
</html>
