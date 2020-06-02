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
    <title>メルマガ配信 管理</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/admin/jquery.datetimepicker.css') }}" rel="stylesheet" />
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
<br />
<div class="container" style="width:85%;">
    <div class="col">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
					<b>顧客新規作成</b>
					<span class="convert_windows_close" style="font-size:14px;background:darkgray;float:right;padding:2px 4px 2px 4px;"><b>close</b></span>
				</div>
                <div class="panel-body">
                    <form id="formCreate" class="form-horizontal" method="POST" action="/admin/member/client/create/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label">登録状態</label>
                            <div class="col-md-2">
								<select id="status" class="form-control" name="status">
									@foreach(config('const.regist_status') as $lines)
										<option value='{{$lines[0]}}'>{{$lines[1]}}</option>										
									@endforeach
								</select>
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="sex" class="col-md-2 control-label">性別</label>

                            <div class="col-md-2">
								<select id="sex" class="form-control" name="sex">
									@foreach($list_sex as $index => $value)
										<option value='{{$index}}'>{{$value}}</option>										
									@endforeach
								</select>
                            </div>

							<label for="age" class="col-md-4 control-label">年代</label>
                            <div class="col-md-3">
								<select id="age" class="form-control" name="age">
									@foreach($list_age as $index => $value)
										<option value='{{$index}}'>{{$value}}</option>										
									@endforeach
								</select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                            <label for="group_id" class="col-md-2 control-label">グループ</label>

                            <div class="col-md-4">
								<select id="group_id" class="form-control" name="group_id">
									@foreach($db_grpup_data as $lines)
										<option value='{{$lines->id}}'>{{$lines->name}}</option>										
									@endforeach
								</select>
                            </div>

                            <label for="ad_cd" class="col-md-2 control-label">広告コード</label>

                            <div class="col-md-3">
                                <input id="ad_cd" type="text" class="form-control" name="ad_cd" value="">

                                @if ($errors->has('ad_cd'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ad_cd') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">メールアドレス</label>

                            <div class="col-md-9">
                                <input id="email" type="text" class="form-control" name="email" value="" maxlength={{ config('const.email_length') }} required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_access_datetime" class="col-md-2 control-label">MEMO</label>

                            <div class="col-md-9">
								<textarea rows="7" name="description" class="form-control"></textarea>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <button id="push_btn" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新規作成&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<script type="text/javascript">
$(document).ready(function(){
	//閉じるをクリック
	$('.convert_windows_close').on('click', function(){
		window.close();
		return false;
	});
	
	//アカウント編集ボタンを押下
	$('#push_btn').click(function(){
		//アカウント編集ボタン押下後のダイアログ確認メッセージ
		//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
		submitAlert('formCreate', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.add_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);
		
	});
});
</script>

</body>
</html>

