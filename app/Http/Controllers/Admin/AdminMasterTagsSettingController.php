<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\SysLog;
use App\Model\Tags_setting;
use Utility;
use DB;

class AdminMasterTagsSettingController extends Controller
{
	private $log_obj;

    //
	public function __construct()
	{
		//ログファイルのインスタンス生成
		//引数：ログの操作項目、ログファイルまでのフルパス
		$this->log_obj = new SysLog(config('const.operation_export_log_name'), config('const.system_log_dir_path').config('const.operation_history_file_name'));
	}

	/*
	 *  確認アドレス設定画面表示
	 */
	public function index()
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		$db_data = Tags_setting::paginate(config('const.admin_key_list_limit'));
		
		$disp_data = [
			'db_data' => $db_data,
			'ver' => time(),
		];
		
		return view('admin.master.tags.index', $disp_data);
	}

	/*
	 *  確認アドレス追加画面表示
	 */
	public function create()
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		$disp_data = [
			'ver' => time(),
		];
		
		return view('admin.master.tags.create', $disp_data);
	}

	/*
	 *  確認アドレス追加処理
	 */
	public function createSend(Request $request)
	{		
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		$this->validate($request, [
			'tag_name'	 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.from_name_length'),
			'tag'		 => 'bail|required|surrogate_pair_check|emoji_check',
		]);

		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['confirm_add'].",{$user['login_id']}");

		$db_value = [
			'name'	 => $request->input('tag_name'),
			'tag'	 => $request->input('tag')
		];
		
		//confirm_emailsテーブルにグループ名を追加
		$db_obj = new Tags_setting($db_value);

		//DB保存
		$db_obj->save();
		
		return null;
	}

	/*
	 *  編集画面表示
	 */
	public function edit($id)
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		$db_data = Tags_setting::where('id', $id)->first();

		$disp_data = [
			'db_data'	 => $db_data,
			'ver'		 => time(),
		];
		
		return view('admin.master.tags.edit', $disp_data);
	}

	/*
	 *  編集画面表示
	 */
	public function store(Request $request, $id)
	{
		$this->validate($request, [
			'tag_name'	 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.from_name_length'),
			'tag'		 => 'bail|required|surrogate_pair_check|emoji_check',
		]);

		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		$db_data = Tags_setting::where('id', $id)->update([
			'name'	=> $request->input('tag_name'),
			'tag'	=> $request->input('tag')
		]);

		$disp_data = [
			'db_data'	 => $db_data,
			'ver'		 => time(),
		];
		
		return null;
	}

	/*
	 *  確認アドレス削除処理
	 */
	public function updateSend(Request $request)
	{		
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		//ID取得
		$listId = $request->input('id');
		
		$listOpenFlg = $request->input('open_flg');

		//削除ID取得
		$listDelId = $request->input('del');

		//全データのopen_flgを0に更新
		$update = DB::table('tags_settings')->update(['open_flg' => 0]);

		if( !empty($listId) ){
			foreach($listId as $index => $id){
				//配列のエラーチェック
				$this->validate($request, [
					'tag_name.*'		=> 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.from_name_length'),
				]);

				//$listDelIdが配列かつ削除IDがあれば
				if( is_array($listDelId) && in_array($id, $listDelId) ){
					//テーブルからデータ削除
					Tags_setting::where('id', $id)->delete();

				}else{
					//open_flgにチェックがあれば
					if( is_array($listOpenFlg) && in_array($id, $listOpenFlg) ){
						$update = Tags_setting::where('id', $id)
							->update([
								'name'		=> $request->input('tag_name')[$index],
								'open_flg'	=> 1,
							]);
					}else{
						$update = Tags_setting::where('id', $id)->update(['name' => $request->input('tag_name')[$index]]);
					}
				}
			}

			//ログ出力
			$this->log_obj->addLog(config('const.admin_display_list')['confirm_delete'].",{$user['login_id']}");
		}

		return null;
	}


}
