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

	<!-- jQuery Liblary -->
	<script src="{{ asset('js/admin/jquery.datetimepicker.full.min.js') }}"></script>

</head>
<body>
<br />
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default" style="font-size:12px;">
                <div class="panel-heading">
					<b>本登録後送信メール編集</b>
					<span class="convert_windows_close" style="font-size:14px;background:darkgray;float:right;padding:2px 4px 2px 4px;"><b>close</b></span>
				</div>
                <div class="panel-body">
					※送信元アドレス・送信者は%変換設定で設定した値、<br />&lt;USER_EMAIL&gt;は配信するユーザーのメールアドレスへ変換されます。<br /><br />
					送信元アドレス：-%from_mail-<br />
					送信者：-%from_name-<br />
					ユーザーのメールアドレス：&lt;USER_EMAIL&gt;
                    <form id="formCreate" class="form-horizontal" method="POST" action="/admin/member/melmaga/registered/mail/edit/send">
                        {{ csrf_field() }}

                        <div class="form-group">
							<center>
							<table border="1" width="97%">
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;">指定時間</td>
									<td style="width:100px;padding:5px;" colspan="3">
									@foreach($registered_specified_time as $time)
										@if( $db_data->specified_time == $time )
											&nbsp;&nbsp;<input type="radio" name="specified_time" value="{{ $time }}" checked>{{ $time }}
										@else
											&nbsp;<input type="radio" name="specified_time" value="{{ $time }}">{{ $time }}
										@endif
									@endforeach
									</td>
								</tr>
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;">有効/無効</td>
									<td style="width:100px;padding:5px;" colspan=3">
										@foreach($registered_enable_disable as $index => $line)
											@if( $index == 0 )
												@continue
											@endif
											@if( $db_data->enable_flg == config('const.registered_enable_disable')[$index][0] )
												&nbsp;&nbsp;<input type="radio" name="enable_flg" value="{{ $index }}" checked>{{ $line[1] }}												
											@else
												&nbsp;<input type="radio" name="enable_flg" value="{{ $index }}">{{ $line[1] }}
											@endif
										@endforeach
									</td>
								</tr>
								<tr class="add_cond">
									<td class="admin_search" style="width:60px;text-align:center;">抽出項目</td>
									<td style="width:55px;padding:5px;">
										<!-- 検索タイプ -->
										<select name="item_type" class="form-control">
										@foreach($melmaga_search_item as $index => $lines)
											@if( $db_data->item_type == $index )
												<option value="{{ $index }}" selected>{{ $lines[1] }}</option>
											@else
												<option value="{{ $index }}">{{ $lines[1] }}</option>													
											@endif
										@endforeach
										</select>
									</td>
									<td style="width:100px;padding:5px;">
										<!-- 検索項目の値 -->
										<input id="item_value" type="text" class="form-control" name="item_value" value="{{ $db_data->item_value }}" maxlength="{{ config('const.item_value_max_length') }}" autofocus>
									</td>
									<td style="width:55px;padding:5px;">
										<!-- 検索タイプ -->
										<select name="like_type" class="form-control">
										@foreach($melmaga_search_type as $lines)
											@if( $db_data->like_type == $lines[0] )
												<option value="{{ $lines[0] }}" selected>{{ $lines[1] }}</option>
											@else
												<option value="{{ $lines[0] }}">{{ $lines[1] }}</option>													
											@endif
										@endforeach
										</select>
									</td>
								</tr>
								<tr class="add_cond">
									<td  class="admin_search" style="width:60px;text-align:center;">グループ</td>
									<td colspan="3" style="padding:5px;">
										@foreach($db_group_data as $index => $lines)
											@if( $index != 0 && $index % 2 == 0 )
												<br />
											@endif
											@if( preg_match("/^(".preg_replace("/,/", "|", $db_data->groups).")$/",$lines->id) > 0 )
												&nbsp;<input type="checkbox" name="groups[]" value="{{ $lines->id }}" checked>{{ $lines->name }}
											@else
												&nbsp;<input type="checkbox" name="groups[]" value="{{ $lines->id }}">{{ $lines->name }}									
											@endif
										@endforeach
									</td>
								</tr>
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;">タイトル</td>
									<td style="width:50px;padding:5px;" colspan=3">
										<input id="title" type="text" class="form-control" name="title" value="{{ $db_data->title }}" maxlength="{{ config('const.subject_length') }}" autofocus placeholder="必須入力">
									</td>
								</tr>
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;">内容</td>
									<td style="width:50px;padding:5px;" colspan=3">
										<textarea cols="90" rows="4" name="body" id="body" class="contents form-control">{{ $db_data->body }}</textarea>
									</td>
								</tr>
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;" placeholder="必須入力">内容<br>(HTML)</td>
									<td style="width:50px;padding:5px;" colspan=3">
										<textarea cols="90" rows="4" name="html_body" id="body" class="contents form-control">{{ $db_data->html_body }}</textarea>
									</td>
								</tr>
								<tr>
									<td class="admin_search" style="width:60px;text-align:center;">備考</td>
									<td style="width:50px;padding:5px;" colspan=3">
										<textarea cols="90" rows="4" name="remarks" id="remarks" class="contents form-control">{{ $db_data->remarks }}</textarea>
									</td>
								</tr>
							</table>
							</center>
						</div>

                        <div>
                            <div style="text-align:center;">
                                <button id="add_cond_btn" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;条件追加&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                                <button id="push_btn" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;更新する&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
						<input type="hidden" name="edit_id" value="{{ $edit_id }}">
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
	//プレビューボタン押下
	$('#push_preview').on('click', function(){
		//別ウィンドウを開く
		window.open($('[name="url"]').val(), 'url_preview', 'width=1000, height=600');
		return false;
	});

	//フォーカスが外されたら元に戻す
	$('[name=disp_sdate]').focusout(function(){
		$('[name=disp_sdate]').attr("placeholder","開始表示日時");
	});

	$('[name=disp_edate]').focusout(function(){
		$('[name=disp_edate]').attr("placeholder","終了表示日時");
	});

	$('[name=open_sdate]').focusout(function(){
		$('[name=open_sdate]').attr("placeholder","開始公開日時");
	});

	$('[name=open_edate]').focusout(function(){
		$('[name=open_edate]').attr("placeholder","終了公開日時");
	});

	$.datetimepicker.setLocale('ja');

	//開催日
	$('#disp_sdate').datetimepicker();
	$('#disp_edate').datetimepicker();
	$('#open_sdate').datetimepicker();
	$('#open_edate').datetimepicker();

	//カーソルがフォーカスされたら日付を消す	
	$('#disp_sdate').focus(function(){
		$('#disp_sdate').val('');
	});

	$('#disp_edate').focus(function(){
		$('#disp_edate').val('');
	});

	$('#open_sdate').focus(function(){
		$('#open_sdate').val('');
	});

	$('#open_edate').focus(function(){
		$('#open_edate').val('');
	});

	//閉じるをクリック
	$('.convert_windows_close').on('click', function(){
		window.close();
		return false;
	});

	var hide_flg = true;
	$('.add_cond').hide();
	$('#add_cond_btn').click(function(){
		if( hide_flg == true ){
			hide_flg = false;
			$(this).text('追加条件を閉じる');
			$('.add_cond').show();
		}else{
			hide_flg = true;
			$(this).text('追加条件');
			$('.add_cond').hide();			
		}
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

