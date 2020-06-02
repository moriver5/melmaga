@extends('layouts.app')

@section('content')
<br />
<div class="container" style="width:1500px;">
    <div class="col">
        <div class="col-md-12 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
					<b>グループ内検索</b>
				</div>
				<div class="panel-body">
                    <form id="formGroupUser" class="form-horizontal" method="POST" action="/admin/member/group/search/{{ $group_id }}/category/bulk/move/send">
						{{ csrf_field() }}
						<span class="admin_default" style="margin-left:20px;">
							全件数：{{$total }} 件
							({{$currentPage}} / {{$lastPage}}㌻)
						</span>
						<center>{{ $links }}</center>
						<center>
							<!-- タブの中身 -->
							<div>
								<div class="form-group" style="align:center;">
									<table border="1" width="95%">
										<tr style="text-align:center;background:wheat;font-weight:bold;">
											<td >移行</td>											
											<td >グループ</td>
											<td>顧客ID</td>
											<td>広告コード</td>
											<td>E-Mail</td>
											<td>カテゴリ</td>
											<td>登録日時</td>
											<td>最終アクセス</td>
											<td>Action回数</td>
											<td>個別移行</td>
										</tr>
										@foreach($db_data as $index => $lines)
										<tr class="slt_group" id="slt_group{{ $lines->client_id }}" style="text-align:center;">
											<td style="width:30px;">
												<input type="checkbox" name="client_id[]" value="{{ $lines->client_id }}">
											</td>
											<td style="width:170px;">{{ $lines->name }}</td>
											<td style="width:60px;"><a href="/admin/member/client/edit/{{ $currentPage }}/{{ $lines->client_id }}/{{ $group_id }}" target="_blank">{{ $lines->client_id }}</a></td>
											<td style="width:50px;">{{ $lines->ad_cd }}</td>
											<td style="padding:0px 5px;width:40px;text-align:left;">{{ $lines->mail_address }}</td>
											<td style="width:100px;">
												<select name="category_id[]" id="category_id{{ $lines->client_id }}" class="form-control" style="height:32px;">
												@foreach($list_category as $category_id => $name)
													@if( $lines->category_id == $category_id )
													<option value="{{ $category_id }}_{{ $lines->client_id }}" selected>{{ $name }}</option>
													@else
													<option value="{{ $category_id }}_{{ $lines->client_id }}">{{ $name }}</option>
													@endif
												@endforeach
												</select>
											</td>
											<td style="width:100px;">{{ preg_replace("/:\d+$/", "", $lines->created_at) }}</td>
											<td style="width:100px;">{{ preg_replace("/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/", "$1/$2/$3 $4:$5", $lines->last_access) }}</td>
											<td style="width:60px;"></td>
											<td style="width:30px;">
												<input type="submit" value="移行" id="personal{{ $lines->client_id }}" class="move_btn" style="margin:3px 0px;" form="formGroupUserPersonal">
											</td>
										</tr>
										@endforeach
									</table>
								</div>
								<button type="submit" class="btn btn-primary" form="formGroupUser">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;カテゴリ移行&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
							</div>
						</center>
						<input type="hidden" name="group_id" value="{{ $lines->id }}">
					</form>
                </div>
            </div>

        </div>
    </div>
</div>

<form id="formGroupUserPersonal" class="form-horizontal link_btn" method="POST" action="/admin/member/group/search/{{ $group_id }}/category/move/send">
{{ csrf_field() }}
<input type="hidden" name="personal_client_id" value="">
<input type="hidden" name="personal_category_id" value="">
</form>

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
			$("#group" + this.id.replace(/del_group/,"")).css("background-color","#F4FA58");
			$("#memo" + this.id.replace(/del_group/,"")).css("background-color","#F4FA58");
		//セルの色を元に戻す
		}else{
			$("#slt_group" + this.id.replace(/del_group/,"")).css("background-color","white");
			$("#group" + this.id.replace(/del_group/,"")).css("background-color","white");
			$("#memo" + this.id.replace(/del_group/,"")).css("background-color","white");
		}
	});
	
	//アカウント編集ボタン押下後のダイアログ確認メッセージ
	//引数：フォームID、フォームのmethod、ダイアログのタイトル、ダイアログのメッセージ、通信完了後にダイアログに表示させるメッセージ、ダイアログのキャンセルメッセージ、タイムアウト
	submitAlert('formGroupUser', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.update_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);

	//個別移行ボタン押下
	$('.move_btn').on('click', function() {
		var client_id = this.id.replace(/personal/, '');
		var group_id = $("#category_id"+client_id).val().split(/_/);
		$("[name=personal_category_id]").val(group_id[0]);
		$("[name=personal_client_id]").val(client_id);
		submitAlert('formGroupUserPersonal', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.update_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);
	});
});

</script>

@endsection
