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
        <div class="col-md-12 col-md-offset">
            <div class="panel panel-default" style="font-size:12px;">
                <div class="panel-heading">
					<b>コンテンツ新規作成</b>
					<span class="convert_windows_close" style="font-size:14px;background:darkgray;float:right;padding:2px 4px 2px 4px;"><b>close</b></span>
				</div>
                <div class="panel-body">

                    <form id="formImageUpload" class="form-horizontal" method="POST" action="/admin/member/page/banner/upload/send">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="end_date" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">画像設定</label>
							<table>
								<tr>
									<td>
										<div class="col-md-10"　id="file_upload_section" style="width:315px;">
											<div id="drop" style="text-align:center;width:240px; height:180px; vertical-align:middle; display:table-cell; border:3px solid burlywood;" ondragleave="onDragLeave(event, 'drop', 'white')" ondragover="onDragOver(event, 'drop', 'wheat')" ondrop="onDrop(event, 'formImageUpload', 'import_file', '{{csrf_token()}}', '{{ __('messages.dialog_img_upload_end_msg') }}', '{{ __('messages.dialog_upload_error_msg') }}',　['edit_id'], 'post', '10000', '{{ $redirect_url }}')">
												<div style="font:italic normal bold 16px/150% 'メイリオ',sans-serif;color:silver;">アップロードするファイルをここに<br />ドラッグアンドドロップしてください</div>
												<center><div id="result" style="font:italic normal bold 16px/150% 'メイリオ',sans-serif;margin:20px;width:240px;"></div></center>
											</div>
										</div>
									</td>
									<td style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">
										@if( !empty($db_data->img) )
											<b>設定済：{{ $db_data->img }}</b><br />
											<img src="{{ config('const.base_url') }}/{{ config('const.top_content_images_path') }}/{{ $db_data->img }}?ver={{$ver}}">
										@else
										<div style="width:400px;text-align:center;"><b>画像未設定</b></div>
										@endif
									</td>
								</tr>
							</table>
                        </div>
						<input type="hidden" name="edit_id" value="{{ $edit_id }}">
					</form>

                    <form id="formCreate" class="form-horizontal" method="POST" action="/admin/member/page/create/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">タイトル</label>
                            <div class="col-md-10">
								<input id="title" type="text" class="form-control" name="title" value="" autofocus>
                            </div>						
                        </div>
						
                        <div class="form-group">
                            <label for="type" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">TYPE</label>
                            <div class="col-md-4">
								<select id="type" class="form-control" name="type">
									@foreach($list_type as $lines)
										<option value='{{$lines[0]}}'>{{$lines[1]}}</option>										
									@endforeach
								</select>
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="open_flg" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">公開</label>
                            <div class="col-md-4">
								<select id="open_flg" class="form-control" name="open_flg">
									@foreach($list_open_flg as $lines)
										<option value='{{$lines[0]}}'>{{$lines[1]}}</option>										
									@endforeach
								</select>
                            </div>						
                        </div>


                        <div class="form-group">
                            <label for="order" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">表示順</label>
                            <div class="col-md-2">
								<select id="order" class="form-control" name="order">
									@foreach($page_order as $num)
										@if( !empty($db_data) && $num == $db_data->order_num )
											<option value='{{$num}}' selected>{{$num}}</option>									
										@else
											<option value='{{$num}}'>{{$num}}</option>										
										@endif	
									@endforeach
								</select>
                            </div>						
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">
								表示グループ<br />
								<a href ="{{ config('const.base_admin_url') }}/{{ config('const.group_url_path') }}" target="_blank">グループID参照</a>
							</label>

                            <div class="col-md-10">
								@if( !empty($db_data->groups) )
                                <input id="group" type="text" class="form-control" name="groups" value="{{ $db_data->groups }}" autofocus placeholder="グループID (複数ある場合は,(半角カンマ)区切り)">
								@else
                                <input id="group" type="text" class="form-control" name="groups" value="" autofocus placeholder="グループID (複数ある場合は,(半角カンマ)区切り)">
								@endif
                            </div>		 
                        </div>

                        <div class="form-group">
                            <label for="start_date" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">公開開始日時</label>

                            <div class="col-md-4">
								@if( !empty($session['start_date']) )
									<input id="start_date" type="text" class="form-control" name="start_date" value="{{$session['start_date']}}" placeholder="必須入力">
								@else
									<input id="start_date" type="text" class="form-control" name="start_date" placeholder="必須入力">
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">公開終了日時</label>

                            <div class="col-md-4">
								@if( !empty($session['start_date']) )
									<input id="end_date" type="text" class="form-control" name="end_date" value="{{$session['end_date']}}" placeholder="必須入力">
								@else
									<input id="end_date" type="text" class="form-control" name="end_date" placeholder="必須入力">
								@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">URL</label>
                            <div class="col-md-4">
								<input id="title" type="text" class="form-control" name="url" value="" autofocus>
                            </div>	

							<div class="col-md-1">
								<button type="submit" id="url_preview" class="btn btn-primary">プレビュー</button>
							</div>

							<label for="url" class="col-md-3 control-label" style="padding-top:12px;color:black;font:bold 12px/120% 'メイリオ',sans-serif;">このURLへリンクする</label>
                            <div class="col-md-1">
                                <input id="link_flg" type="checkbox" class="form-control" name="link_flg" value="1">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="html_body" class="col-md-2 control-label" style="color:black;font:bold 12px/120% 'メイリオ',sans-serif;">
								HTMLBODY<br />
								<br />
								<button type="submit" id="push_preview" class="btn btn-primary">&nbsp;&nbsp;プレビュー&nbsp;&nbsp;</button>
							</label>

                            <div class="col-md-5">
								<textarea cols="121" rows="16" name="html_body" id="html_body" class="contents" placeholder="※TYPEによる入力イメージは、以下のように記述して下さい。

【通常 の場合】
  < table >
    < td > この中のhtmlを設定 < /td > 
  < /table >
の この中のhtmlを設定 を記述。
<table><td>の部分はユーザーページのhtmlによって変動。
メインコンテンツ部分を設定して下さい。

【キャンペーン の場合】
 <html> ～ </html>
を記述。"></textarea>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button id="push_btn" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新規作成&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
								<button type="submit" id="convert_table" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;変換表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
<script src="{{ asset('js/admin/utility.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	//変換表ボタン押下
	$('#convert_table').on('click', function(){
		var id = $('[name="tab"]').val();
		sub_win = window.open('/admin/member/page/convert/', 'convert_table', 'width=1000, height=300');
		return false;
	});

	//URLプレビューボタン押下
	$('#url_preview').on('click', function(){
		//別ウィンドウを開く
		window.open($('[name="url"]').val(), 'url_preview', 'width=1000, height=600');
		return false;
	});

	var prev_win;
	//プレビューボタン押下
	$('#push_preview').on('click', function(){
		var type = $('[name="type"]').val();

		//別ウィンドウを開く
		if( type == 1 ){
			prev_win = window.open('/admin/member/page/create/preview/' + type, 'top_content_preview', 'width=1000, height=900');
		}else{
			prev_win = window.open('/admin/member/page/create/preview/' + type, 'top_content_preview', 'width=690, height=500');
		}

		//別ウィンドウ読み込み後に実行
		prev_win.onload = function(){
			var dom = prev_win.document.getElementById('create_preview');

			//html_bodyを別ウィンドウに反映
			$(dom).html(escapeJsTag($('[name="html_body"]').val()));
		};
		return false;
	});

	//プレビュー機能
	$('.contents').keyup(function(){
		//編集した内容を更新用パラメータに設定
		$('[name="html_body"]').val($('[name="html_body"]').val());

		//プレビュー処理
		if( prev_win ){
			var dom = prev_win.document.getElementById('create_preview');

			$(dom).html(escapeJsTag($('[name="html_body"]').val()));
		}
	});

	//フォーカスが外されたら元に戻す
	$('[name=start_date]').focusout(function(){
		$('[name=start_date]').attr("placeholder","必須入力");
	});

	$('[name=end_date]').focusout(function(){
		$('[name=end_date]').attr("placeholder","必須入力");
	});

	$('[name=html_body]').focusin(function(){
		$('textarea[name=html_body]').attr("placeholder","");
	});

	$('[name=html_body]').focusout(function(){
		$('textarea[name=html_body]').attr("placeholder","※TYPEによる入力イメージは、以下のように記述して下さい。\n\n【通常 の場合】\n  < table >\n    < td > この中のhtmlを設定 < /td > \n  < /table >\nの この中のhtmlを設定 を記述。\n<table><td>の部分はユーザーページのhtmlによって変動。\nメインコンテンツ部分を設定して下さい。\n\n【キャンペーン の場合】\n <html> ～ </html>\nを記述。");
	});

	$.datetimepicker.setLocale('ja');

	//公開開始日時
	$('#start_date').datetimepicker();

	//公開終了日時
	$('#end_date').datetimepicker();

	//閉じるをクリック
	$('.convert_windows_close').on('click', function(){
		window.close();
		return false;
	});
	
	//新規作成ボタンを押下
	$('#push_btn').click(function(){
		//新規作成ボタン押下後のダイアログ確認メッセージ
		//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
		submitAlert('formCreate', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.add_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true, false, true, '{{ $redirect_url }}');
		
	});
});
</script>

</body>
</html>

