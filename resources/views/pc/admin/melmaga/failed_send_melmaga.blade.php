@extends('layouts.app')

@section('content')
<br />
<br />
<div class="container">
    <div class="col">
        <div class="col-md-5 col-md-offset-4">
			<div class="panel panel-default" style="font-size:12px;">
				<div class="panel-heading">
					<b>メルマガ送信失敗リスト</b><br />
					<span style="color:red;font-size:11px;font-weight:bold;">※送信失敗リストに対して再配信が可能です。</span>
				</div>
				<form id="formDelFailedMail" class="form-horizontal link_btn" method="POST" action="/admin/member/melmaga/mail/failed/list/del">
					{{ csrf_field() }}
				<div class="panel-body">
					<center>{{ $db_data->links() }}</center>
					<table border="1" align="center" width="98%">
						<tr>
							<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:120px;">
								<b>配信日時</b>
							</td>
							<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:120px;">
								<b>件数</b>
							</td>
							<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:50px;">
								<b>再配信</b>
							</td>
							<td style="padding:5px;text-align:center;background:wheat;font-weight:bold;width:50px;">
								<b>削除 <input type="checkbox" id="del_all" name="del_all" value="1"></b>
							</td>
						</tr>
						@foreach($db_data as $lines)
							<tr>
								<td style="padding:5px;text-align:center;">
									{{ $lines->send_date }}
								</td>
								<td style="padding:5px;text-align:center;">
									<a href="{{ url('/admin/member/melmaga/mail/failed/list/emails') }}/{{ $db_data->currentPage() }}/{{ $lines->id }}">{{ $lines->count }}</a>
								</td>
								<td style="padding:5px;text-align:center;">
									<input type="submit" value="再配信実行" id="melmaga{{ $lines->id }}" class="send_btn" style="margin:3px 0px;" form="formSendMelmaga">
								</td>
								<td style="padding:5px;text-align:center;">
									<input type="checkbox" class="del del_group" id="del_group{{ $lines->id }}"　name="del[]" value="{{ $lines->id }}">
								</td>
							</tr>
						@endforeach
					</table>
					<br />
					<center>
					<input type="submit" value="　　一括削除　　" id="melmaga" class="del_btn" style="margin:3px 0px;">
					</center>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<form id="formSendMelmaga" class="form-horizontal link_btn" method="POST" action="/admin/member/melmaga/mail/failed/list/redelivery">
{{ csrf_field() }}
<input type="hidden" name="melmaga_id" value="">
</form>

<script src="{{ asset('js/admin/alert.js') }}?ver={{ $ver }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.send_btn').on('click', function() {
		var melmaga_id = this.id.replace(/melmaga/, '');
		$("[name=melmaga_id]").val(melmaga_id);
		submitAlert('formSendMelmaga', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_alert_msg') }}', '{{ __('messages.dialog_melmaga_wait_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);
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

	$('.del_btn').on('click', function() {
		submitAlert('formDelFailedMail', 'post', '{{ __('messages.dialog_alert_title') }}', '{{ __('messages.dialog_del_alert_msg') }}', '{{ __('messages.delete_msg') }}', '{{ __('messages.cancel_msg') }}', {{ config('const.admin_default_ajax_timeout') }}, true);
	});
});
</script>

@endsection
