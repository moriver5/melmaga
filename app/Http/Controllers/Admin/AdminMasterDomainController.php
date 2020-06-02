<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\SysLog;
use App\Model\Domain;
use Utility;
use Carbon\Carbon;
use DB;

class AdminMasterDomainController extends Controller
{
	public function __construct()
	{
		//ログファイルのインスタンス生成
		//引数：ログの操作項目、ログファイルまでのフルパス
		$this->log_obj = new SysLog(config('const.operation_export_log_name'), config('const.system_log_dir_path').config('const.operation_history_file_name'));
	}
	
	/*
	 *  グループ画面表示
	 */
	public function index()
	{
		//ログイン管理者情報取得
//		$user = Utility::getAdminDefaultDispParam();
		
		$db_data = Domain::paginate(config('const.admin_key_list_limit'));
		
		$disp_data = [
			'db_data' => $db_data,
			'ver' => time(),
		];
		
		return view('admin.master.domain.index', $disp_data);
	}
	
	/*
	 *  グループ画面-グループ追加画面追加
	 */
	public function create()
	{		
		//サーバーに設定されているドメイン一覧を取得
		$list_domain = Utility::getDomainList(config('const.domain_setting_file'));

		//DBに登録されているドメイン一覧を取得
		$db_data = Domain::get();

		$list_reg_domain = [];
		foreach($db_data as $lines){
			$list_reg_domain[] = $lines->domain;
		}

		//DBに登録されていないドメインのリストにする
		$list_domain = array_diff($list_domain, $list_reg_domain);

		$disp_data = [
			'list_domain'	=> $list_domain,
			'ver'			=> time(),
		];
		
		return view('admin.master.domain.create', $disp_data);
	}
	
	/*
	 *  グループ画面-グループ追加処理
	 */
	public function createSend(Request $request)
	{		
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		$this->validate($request, [
			'domain' => 'required|max:'.config('const.domain_name_max_length').'|check_exist_domain',
			'memo'	 => 'max:'.config('const.domain_memo_max_length'),
		]);
		
		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['group_add'].",{$user['login_id']}");	

		$db_value = [
			'domain' => $request->input('domain'),
			'memo'	 => $request->input('memo')
		];
		
		//groupテーブルにグループ名を追加
		$db_obj = new Domain($db_value);
		
		//DB保存
		$db_obj->save();
		
		$disp_data = [
			'ver' => time(),
		];
		
		return null;
	}
	
	/*
	 *  グループ管理画面の更新処理
	 */
	public function store(Request $request)
	{

		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		//ID取得
		$listId = $request->input('id');

		//削除ID取得
		$listDelId = $request->input('del');
		
		//更新ログ
		if( empty($listDelId) ){
			//ログ出力
			$this->log_obj->addLog(config('const.admin_display_list')['group_update'].",{$user['login_id']}");	

		//削除ログ
		}else{
			//ログ出力
			$this->log_obj->addLog(config('const.admin_display_list')['group_delete'].",{$user['login_id']}");	
		}	
			
		foreach($listId as $index => $id){
			//配列のエラーチェック
			$this->validate($request, [
				'domain.*'		=> 'required|max:'.config('const.domain_name_max_length').'|check_exist_domain',
				'memo.*'		=> 'max:'.config('const.domain_memo_max_length'),
			]);

			//$listDelIdが配列かつ削除IDがあれば
			if( is_array($listDelId) && in_array($id, $listDelId) ){
				//テーブルからデータ削除
				Domain::where('id', $id)->delete();

			}else{
				//グループ管理画面の更新処理
				$update = Domain::where('id', $id)
					->update([
						'domain'	=> $request->input('domain')[$index],
						'memo'		=> $request->input('memo')[$index],
					]);
			}
		}
						
		return null;
	}
	
	/*
	 * グループ一括移行
	 */
	public function bulkMoveGroup()
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();

		//DBのgroupテーブルからデータ取得
		$db_group_data = Group::get();

		$disp_data = [
			'db_group_data'		=> $db_group_data,
			'ver'				=> time(),
		];

		return view('admin.group.move', $disp_data); 
	}
	
	/*
	 * グループ一括移行の更新処理
	 */
	public function bulkMoveGroupSend(Request $request)
	{
		//ログイン管理者情報取得
		$user = Utility::getAdminDefaultDispParam();
		
		//移行元のグループID取得
		$listGroupId = $request->input('move_group_id');

		$this->validate($request, [
			'move_group_id'	=> 'required',
			'group_id'		=> 'required',
		]);
		
		//動的クエリを生成するため
		$query = User_group::whereIn('group_id', $listGroupId)->update([
				'group_id'	=> $request->input('group_id')
			]);
//error_log(print_r($query,true)."\n",3,"/data/www/melmaga/storage/logs/nishi_log.txt");
		//ログ出力
		$this->log_obj->addLog(config('const.admin_display_list')['group_bulk_move'].",{$user['login_id']}");	

		return null;
	}
}
