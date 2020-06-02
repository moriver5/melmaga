<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\SysLog;
use App\Model\Convert_table;
use App\Model\Mail_content;
use App\Model\Mail_content_type;
use App\Model\Group;
use Utility;

class AdminMasterMailContentController extends Controller
{
	//
	public function __construct()
	{
		//ログファイルのインスタンス生成
		//引数：ログの操作項目、ログファイルまでのフルパス
		$this->log_obj = new SysLog(config('const.operation_export_log_name'), config('const.system_log_dir_path').config('const.operation_history_file_name'));
	}
	
	/*
	 *  自動メール文設定画面表示
	 */
	public function index($group_id, $id = '')
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		$db_data = Mail_content::select('mail_contents.id', 'mail_contents.group_id', 'mail_contents.type', 'mail_contents.from', 'mail_contents.from_mail', 'mail_contents.subject', 'mail_contents.body', 'mail_content_types.name')->join('mail_content_types', 'mail_contents.type', '=', 'mail_content_types.id')->where('group_id', $group_id)->get();

		$group_data = Group::where('id', $group_id)->get();

		//メール文カテゴリリスト取得
		$mail_type_data = Mail_content_type::get();

		$disp_data = [
			'id'			=> $id,
			'group_id'		=> $group_id,
			'group_name'	=> $group_data[0]->name,
			'list_mail_type'=> $mail_type_data,
			'db_data'		=> $db_data,
			'ver'			=> time(),
		];

		//設定情報がないとき
		if( count($db_data) > 0 ){
			return view('admin.master.mail_contents', $disp_data);
		}else{
			return view('admin.master.mail_none_contents', $disp_data);
		}
	}

	/*
	 *  自動メール文設定画面追加表示
	 */
	public function addSetting($group_id, $id = '')
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		//メール文カテゴリリスト取得
		$mail_type_data = Mail_content_type::get();

		//グループリスト取得
		$group_data = Group::where('id', $group_id)->get();

		$disp_data = [
			'id'			=> $id,
			'group_id'		=> $group_id,
			'group_name'	=> $group_data[0]->name,
			'list_mail_type'=> $mail_type_data,
			'ver'			=> time(),
		];

		return view('admin.master.mail_none_contents', $disp_data);
	}

	/*
	 *  自動メール文設定-更新処理
	 */
	public function store(Request $request)
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['auto_mail_update'].",{$user['login_id']}");

		$tab_id = $request->input('tab');
		$group_id = $request->input('group_id');

		//削除
		if( $request->input('del_flg') == 1 ){
			$update = Mail_content::where('id', $tab_id)->where('group_id', $group_id)->delete();
			return null;
		}

		//新規追加
		if( empty($tab_id) ){
			//エラーチェック
			$this->validate($request, [
				'group_id'		=> 'required',
				'from'			=> 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.from_name_length'),
				'from_mail'		=> 'bail|required|max:'.config('const.email_length'),
				'subject'		=> 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.subject_length'),
				'body'			=> 'bail|required|surrogate_pair_check|emoji_check'
			]);

			//groupテーブルにグループ名を追加
			$db_obj = new Mail_content([
				'group_id'		=> $group_id,
				'type'			=> $request->input('setting_name'),
				'from'			=> $request->input('from'),
				'from_mail'		=> $request->input('from_mail'),
				'subject'		=> $request->input('subject'),
				'body'			=> $request->input('body')
			]);

			//DB保存
			$db_obj->save();

		//更新
		}else{
			//エラーチェック
			$this->validate($request, [
				'group_id'		=> 'required',
				'from'			=> 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.from_name_length'),
				'from_mail'		=> 'bail|required|max:'.config('const.email_length'),
				'subject'		=> 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.subject_length'),
				'body'			=> 'bail|required|surrogate_pair_check|emoji_check',
			]);

			//自動メール文更新処理
			$update = Mail_content::where('id', $tab_id)->where('group_id', $group_id)
				->update([
					'from'			=> $request->input('from'),
					'from_mail'		=> $request->input('from_mail'),
					'subject'		=> $request->input('subject'),
					'body'			=> $request->input('body'),
				]);
		}
		
		return null;
	}
	
	/*
	 *  自動メール文設定-%変換表画面表示
	 */
	public function convert($id)
	{		
		$db_data = Convert_table::get();

		$disp_data = [
			'db_data'	=> $db_data,
			'id'		=> $id,
			'ver'		=> time(),
		];
		
		return view('admin.master.convert_table', $disp_data);
	}
	
	
}
