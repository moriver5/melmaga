<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\SysLog;
use App\Model\Convert_table;
use App\Model\Group;
use Utility;

class AdminMasterConvertController extends Controller
{
	//
	public function __construct()
	{
		//ログファイルのインスタンス生成
		//引数：ログの操作項目、ログファイルまでのフルパス
		$this->log_obj = new SysLog(config('const.operation_export_log_name'), config('const.system_log_dir_path').config('const.operation_history_file_name'));
	}
	
	/*
	 *  %変換表画面表示
	 */
	public function index($group_id)
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		$db_data = Convert_table::where('group_id', $group_id)->paginate(config('const.admin_key_list_limit'));
		$group_data = Group::where('id', $group_id)->first();

		$disp_data = [
			'group_id'	=> $group_id,
			'group_name'=> $group_data->name,
			'db_data'	=> $db_data,
			'ver'		=> time(),
		];
		
		return view('admin.master.convert_setting', $disp_data);
	}
	
	/*
	 *  %変換設定の更新処理
	 */
	public function store(Request $request)
	{

		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['convert_list_update'].",{$user['login_id']}");

		//ID取得
		$listId = $request->input('id');

		//削除ID取得
		$listDelId = $request->input('del');
		
		foreach($listId as $index => $id){
			//配列のエラーチェック
			$this->validate($request, [
				'key.*'		 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.convert_key_max_length'),
				'value.*'	 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.convert_value_max_length'),
				'remarks.*'	 => 'bail|surrogate_pair_check|emoji_check|max:'.config('const.convert_memo_max_length'),
			]);

			//$listDelIdが配列かつ削除IDがあれば
			if( is_array($listDelId) && in_array($id, $listDelId) ){
				//テーブルからデータ削除
				Convert_table::where('id', $id)->delete();

			}else{
				//%変換設定の更新処理
				$update = Convert_table::where('id', $id)
					->update([
						'key'		=> $request->input('key')[$index],
						'value'		=> $request->input('value')[$index],
						'memo'		=> $request->input('remarks')[$index],
					]);
			}
		}
						
		return null;
	}
	
	/*
	 *  変換設定画面-キー追加画面追加
	 */
	public function create($group_id)
	{		
		$disp_data = [
			'group_id'	=> $group_id,
			'ver'		=> time(),
		];
		
		return view('admin.master.convert_create', $disp_data);
	}
	
	/*
	 *  変換設定画面-キー追加処理
	 */
	public function createSend(Request $request)
	{		
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		$this->validate($request, [
			'key'		 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.convert_key_max_length'),
			'value'		 => 'bail|required|surrogate_pair_check|emoji_check|max:'.config('const.convert_value_max_length'),
			'remarks'	 => 'bail|surrogate_pair_check|emoji_check|max:'.config('const.convert_memo_max_length'),
		]);
		
		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['convert_key_add'].",{$user['login_id']}");

		$db_value = [
			'group_id'	 => $request->input('group_id'),
			'key'		 => $request->input('key'),
			'value'		 => $request->input('value'),
			'memo'		 => $request->input('remarks'),
		];
		
		//convert_tablesにキーを追加
		$db_obj = new Convert_table($db_value);
		
		//DB保存
		$db_obj->save();
		
		$disp_data = [
			'ver' => time(),
		];
		
		
		return null;
	}
	
	
}
