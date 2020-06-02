<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDataMigrationController extends Controller
{
	public function __construct()
	{

	}

	/*
	 *  
	 */
	public function index()
	{
		//会員ページのデフォルトのパラメータを取得
		$disp_param = Utility::getDefaultDispParam();

		//画面表示パラメータ設定
		$disp_data = array_merge([
			'title'					=> config('const.list_title')['mem_top'],
		],$disp_param);
		
		//画面表示
		return view('data_migration', $disp_data);
	}
}
