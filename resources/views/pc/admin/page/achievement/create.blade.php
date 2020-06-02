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
	<link href="{{ asset('css/admin/jquery.datetimepicker.css') }}" rel="stylesheet" />
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- jQuery Liblary -->
	<script src="{{ asset('js/admin/jquery.datetimepicker.full.min.js') }}"></script>

</head>
<body>
<br />
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset">
            <div class="panel panel-default" style="font-size:12px;">
                <div class="panel-heading">
					<b>的中実績 新規作成</b>
					<span class="convert_windows_close" style="font-size:14px;background:darkgray;float:right;padding:2px 4px 2px 4px;"><b>close</b></span>
				</div>
                <div class="panel-body">

                    <form id="formCreate" class="form-horizontal" method="POST" action="/admin/member/page/achievement/create/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="priority_id" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">優先順位表示ID</label>
                            <div class="col-md-2">
								<input id="priority_id" type="text" class="form-control" name="priority_id" value="" autofocus placeholder="必須入力">
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="open_flg" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">公開</label>
                            <div class="col-md-2">
								<select id="open_flg" class="form-control" name="open_flg">
									@foreach($list_open_flg as $lines)
										<option value='{{$lines[0]}}'>{{$lines[1]}}</option>										
									@endforeach
								</select>
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="race_date" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">開催日</label>

                            <div class="col-md-3">
								@if( !empty($session['race_date']) )
									<input id="race_date" type="text" class="form-control" name="race_date" value="{{$session['race_date']}}" placeholder="必須入力">
								@else
									<input id="race_date" type="text" class="form-control" name="race_date" placeholder="必須入力">
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="race_name" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">レース名</label>
                            <div class="col-md-6">
								<input id="race_name" type="text" class="form-control" name="race_name" value="" autofocus placeholder="必須入力">
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="msg1" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">結果</label>

                            <div class="col-md-6">
								@if( !empty($db_data->msg1) )
                                <input id="msg1" type="text" class="form-control" name="msg1" value="{{ $db_data->msg1 }}" size=22 placeholder="馬券名 例：３連単" autofocus>
								@else
                                <input id="msg1" type="text" class="form-control" name="msg1" value="" size=22 placeholder="馬券名 例：３連単" autofocus>
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="msg2" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;"></label>
                            <div class="col-md-6">
								@if( !empty($db_data->msg2) )
                                <input id="msg2" type="text" class="form-control" name="msg2" value="{{ $db_data->msg2 }}" size=22 placeholder="コメント 例：『的中重視』(3連単30点・1点500円推奨)" autofocus>
								@else
                                <input id="msg2" type="text" class="form-control" name="msg2" value="" size=22 placeholder="コメント 例：『的中重視』(3連単30点・1点500円推奨)" autofocus>
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="msg3" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;"></label>
                            <div class="col-md-6">
								@if( !empty($db_data->msg3) )
                                <input id="msg3" type="text" class="form-control" name="msg3" value="{{ $db_data->msg3 }}" size=22 placeholder="金額 例：10000" autofocus>
								@else
                                <input id="msg3" type="text" class="form-control" name="msg3" value="" size=22 placeholder="金額 例：10000" autofocus>
								@endif
                            </div>
                        </div>

                        <div class="form-group">
							<label for="type" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">コメント</label>

							<div class="col-md-5">
								<textarea cols="70" rows="4" name="comment" id="comment" class="contents form-control" ></textarea>
                            </div>
						</div>

                        <div>
                            <div style="text-align:center;">
                                <button id="push_btn" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新規作成&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 画面アラートJavascript読み込み -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>
<script src="{{ asset('js/admin/file_upload.js') }}?ver={{ $ver }}"></script>
<script src="{{ asset('js/admin/ajax.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
$(document).ready(function(){

	//フォーカスが外されたら元に戻す
	$('[name=race_date]').focusout(function(){
		$('[name=race_date]').attr("placeholder","必須入力");
	});

	$.datetimepicker.setLocale('ja');

	//開催日
	$('#race_date').datetimepicker({format:'Y-m-d'});

	//閉じるをクリック
	$('.convert_windows_close').on('click', function(){
		window.close();
		return false;
	});
	
	//新規作成ボタンを押下
	$('#push_btn').click(function(){
		//新規作成ボタン押下後のダイアログ確認メッセージ
		//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
		submitAlert('formCreate', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.add_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true, false);
		
	});
});
</script>

</body>
</html>

