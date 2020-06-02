@extends('layouts.app')

@section('content')
<br />
<div class="container" style="width:1500px;">
    <div class="col">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
					<b>タグ設定</b>
				</div>
				<div class="panel-body">
                    <form id="formGroup" class="form-horizontal" method="POST" action="/admin/member/master/tags/setting/update/send">
						{{ csrf_field() }}
						<span style="font-size:12px;color:red;font-wight:bold;">
							※使用したいタグにチェックを入れるとLPの&lt;/body&gt;の前に挿入されます<br />
						</span>
						<center>
							<!-- タブの中身 -->
							<div>
								<div class="form-group" style="align:center;">
									{{ $db_data->links() }}
									<table border="1" width="95%">
										<tr style="text-align:center;background:wheat;font-weight:bold;">
											<td style="padding:1px 3px;width:20px;">ID</td>
											<td style="padding:1px 0px;width:130px;">タグ名</td>
											<td style="padding:1px 0px;width:20px;">使用</td>
											<td style="padding:1px 2px;width:20px;">削除 <input type="checkbox" id="del_all" name="del_all" value="1"></td>
										</tr>
										@foreach($db_data as $index => $lines)
										<tr class="slt_group del_group" id="slt_group{{ $lines->id }}" style="text-align:center;">
											<td><a href="/admin/member/master/tags/setting/edit/{{ $lines->id }}" target="_blank">{{ $lines->id }}</a><input type="hidden" name="id[]" value="{{ $lines->id }}"></td>
											<td><input type="text" class="form-control del_group" id="name{{ $lines->id }}" name="tag_name[]" value="{{ $lines->name }}" maxlength="{{ config('const.tag_name_length') }}"></td>
											<td>
												@if( !empty($lines->open_flg) )
													<input type="checkbox" class="del_group" id="open_flg{{ $lines->id }}" name="open_flg[]" value="{{ $lines->id }}" id="open_group{{ $lines->open_flg }}" checked>
												@else
													<input type="checkbox" class="del_group" id="open_flg{{ $lines->id }}" name="open_flg[]" value="{{ $lines->id }}" id="open_group{{ $lines->open_flg }}">
												@endif
											</td>
											<td><input type="checkbox" class="del del_group" id="del_group{{ $lines->id }}"　name="del[]" value="{{ $lines->id }}"></td>
										</tr>
										@endforeach
									</table>
								</div>
								<button type="submit" id="push_update" class="btn btn-primary">更新</button>
								<button type="submit" id="add_tag" class="btn btn-primary">タグ追加</button>
							</div>
						</center>
					</form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 画面アラートJavascript読み込み -->
<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
var sub_win;
$(document).ready(function(){
	//グループ管理で削除選択にチェックしたセルの色を変更
	$('.del_group').on('click', function(){
		//セルの色を変更
		if( $(this).is(':checked') ){
			$("#slt_group" + this.id.replace(/del_group/,"")).css("background-color","#F4FA58");
			$("#name" + this.id.replace(/del_group/,"")).css("background-color","#F4FA58");
			$("#open_flg" + this.id.replace(/del_group/,"")).css("background-color","#F4FA58");
		//セルの色を元に戻す
		}else{
			$("#slt_group" + this.id.replace(/del_group/,"")).css("background-color","white");
			$("#name" + this.id.replace(/del_group/,"")).css("background-color","white");
			$("#open_flg" + this.id.replace(/del_group/,"")).css("background-color","white");
		}
	});
	
	//アカウント編集ボタン押下後のダイアログ確認メッセージ
	//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
	submitAlert('formGroup', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.update_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);
	
	//グループ追加ボタンを押下
	$('#add_tag').on('click', function(){
		sub_win = window.open('/admin/member/master/tags/setting/add', 'confirm_email_add', 'width=700, height=790');
		return false;
	});

	//削除のすべて選択のチェックをOn/Off
	$('#del_all').on('change', function() {
		$('.del').prop('checked', this.checked);
		//セルの色を変更
		if( $(this).is(':checked') ){
			$(".del_group").css("background-color","#F4FA58");
		//セルの色を元に戻す
		}else{
			$(".del_group").css("background-color","white");
		}
	});

	//更新ボタン押下
	$('#push_update').on('click', function() {
		//グループ名に未入力があるか確認
		$('.group_data').each(function(){
			//未入力があればテキストBOXの背景色を変更
			if( $(this).val() == '' ){
				$(this).css("background-color","yellow");
			}
		});
	});
	
	//グループ名のテキストBOXにカーソルが当たったら
	$('.group_data').on('click', function() {
		//カーソルが当たった背景色を白に変更(イエローの背景色を白に変更するのが狙い)
		$(this).css("background-color","white");
		return false;
	});

});
</script>

@endsection
