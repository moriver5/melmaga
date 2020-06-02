<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*******************
 * 
	代理店管理画面
 * 
 *******************/

//代理店管理画面-ログイン前(http://ドメイン/agency 以降でアクセスがあったら)
Route::group(['prefix' => 'agency'], function() {
	//代理店管理ログイン前-ログイン画面
	Route::get('/', 'Agency\Auth\LoginController@showLoginForm');
	Route::get('login', 'Agency\Auth\LoginController@showLoginForm');
	Route::post('login', 'Agency\Auth\LoginController@login');

	//代理店管理画面-ログアウト
	Route::post('logout', 'Agency\Auth\LoginController@logout');
	Route::get('logout', 'Agency\Auth\LoginController@logout');

	//代理店管理画面-ログイン後の画面(http://ドメイン/agency/member 以降でアクセスがあったら)
	Route::group(['middleware' => 'auth.agency.token'], function() {
		//管理トップ
		Route::get('member', 'Agency\AgencyController@index');
		Route::get('member/home/{sid?}', 'Agency\AgencyController@index');

		//集計-期間
		Route::post('member/aggregate', 'Agency\AgencyController@searchPost');
		Route::get('member/aggregate', 'Agency\AgencyController@search');

		//集計-月別
		Route::post('member/aggregate/month/{ad_cd}', 'Agency\AgencyController@aggregateMonth');
		Route::get('member/aggregate/month/{ad_cd}', 'Agency\AgencyController@aggregateMonth');

	});

});

/*******************
 * 
	管理画面
 * 
 *******************/

//管理画面-ログイン前(http://ドメイン/admin 以降でアクセスがあったら)
//Route::group(['prefix' => 'admin', 'middleware' => ['check.allow.ip']], function() {
Route::group(['prefix' => 'admin'], function() {
	//管理ログイン前-アカウント新規作成
	Route::get('regist', 'Admin\Auth\LoginController@register');
	Route::post('regist/send', 'Admin\Auth\RegisterController@create');

	//管理ログイン前-パスワード設定(アカウント未登録用)
	Route::get('password/setting/{sid}', 'Admin\Auth\RegisterController@passwordSetting');
	Route::post('password/setting/send', 'Admin\Auth\RegisterController@passwordSettingSend');

	//管理ログイン前-パスワード再設定(アカウント登録済用)
	Route::get('password/resetting/{sid}', 'Admin\Auth\RegisterController@passwordReSetting');
	Route::post('password/resetting/send', 'Admin\Auth\RegisterController@passwordReSettingSend');

	//管理ログイン前-ログインID・パスワード忘れ
	Route::get('forget', 'Admin\Auth\LoginController@forget');
	Route::post('forget', 'Admin\Auth\LoginController@forgetSend');

	//管理ログイン前-ログイン画面
//	Route::get('/', 'Admin\Auth\LoginController@showLoginForm');
	Route::get('/', function(){
		return redirect('/admin/login');
	});
	Route::get('login', 'Admin\Auth\LoginController@showLoginForm');
	Route::post('login', 'Admin\Auth\LoginController@login');

	//管理画面-ログアウト
	Route::post('logout', 'Admin\Auth\LoginController@logout');
	Route::get('logout', 'Admin\Auth\LoginController@logout');
 	
	//管理画面-ログイン後の画面(http://ドメイン/admin/member 以降でアクセスがあったら)
	Route::group(['middleware' => 'auth.admin.token'], function() {
		//管理トップ
		Route::get('member', 'Admin\AdminMemberController@index');
		Route::get('member/home/{sid?}', 'Admin\AdminMemberController@index');

		//アカウント新規作成関連
		Route::get('member/create/{page?}', 'Admin\AdminMemberController@create');
		Route::post('member/create/send', 'Admin\AdminMemberController@createSend');

		//アカウント編集関連
		Route::get('member/edit/{page}/{id}', 'Admin\AdminMemberController@edit');
		Route::post('member/edit/send', 'Admin\AdminMemberController@store');

		//クライアント一覧
		Route::get('member/client', 'Admin\AdminClientController@index');

		//クライアント-一括削除
		Route::post('member/client/del/send', 'Admin\AdminClientController@bulkDeleteSend');

		//クライアント検索-顧客データ新規作成
		Route::get('member/client/create', 'Admin\AdminClientController@create');
		Route::post('member/client/create/send', 'Admin\AdminClientController@createSend');

		//クライアント検索
		Route::get('member/client/search', 'Admin\AdminClientController@search');
		Route::post('member/client/search', 'Admin\AdminClientController@searchPost');

		//クライアントインポート
		Route::get('member/client/import', 'Admin\AdminClientController@importClientData');
		Route::post('member/client/import/upload', 'Admin\AdminClientController@importClientUpload');

		//クライアントインポート-不正メールアドレスリストのダウンロード
		Route::get('member/client/import/dl/bad_email', 'Admin\AdminClientController@downLoadBadEmail');

		//クライアントインポート-不明ドメインリストのダウンロード
		Route::get('member/client/import/dl/unknown_mx_domain', 'Admin\AdminClientController@downLoadUnknownMxDomain');

		//クライアントインポート-重複メールアドレスリストのダウンロード
		Route::get('member/client/import/dl/duplicate_email', 'Admin\AdminClientController@downLoadDuplicateEmail');

		//クライアントインポート-不正メールアドレスリストファイルの削除
		Route::get('member/client/import/del/bad_email', 'Admin\AdminClientController@deleteBadEmail');

		//クライアントインポート-不明ドメインリストファイルの削除
		Route::get('member/client/import/del/unknown_mx_domain', 'Admin\AdminClientController@deleteUnknownMxDomain');

		//クライアントインポート-重複メールアドレスリストファイルの削除
		Route::get('member/client/import/del/duplicate_email', 'Admin\AdminClientController@deleteDuplicateEmail');

		//クライアント検索エクスポート
		Route::post('member/client/search/export', 'Admin\AdminClientController@clientExport');

		//クライアントエクスポートの操作ログ
		Route::get('member/client/export/opeartion/log', 'Admin\AdminClientController@clientExportOperationLog');
		Route::post('member/client/export/opeartion/log', 'Admin\AdminClientController@clientExportOperationLog');

		//クライアント編集画面-メルマガ履歴画面表示
		Route::get('member/client/edit/{id}/melmaga/history', 'Admin\AdminClientController@historyMelmaga');

		//クライアント編集画面-アクセス履歴
		Route::get('member/client/edit/{id}/access/history', 'Admin\AdminClientController@accessHistory');

		//クライアント個別リスト画面
		Route::get('member/client/list/{page}/{client_id}', 'Admin\AdminClientController@personalList');

		//クライアント個別リスト画面-更新
		Route::post('member/client/list/{page}/{client_id}/send', 'Admin\AdminClientController@updateUserSend');

		//クライアント編集画面
		Route::get('member/client/edit/{page}/{client_id}/{group_id}', 'Admin\AdminClientController@edit');

		//クライアント編集画面-更新処理
		Route::post('member/client/edit/send', 'Admin\AdminClientController@store');

		//クライアント編集画面-個別メール画面表示
//		Route::get('member/client/edit/{id}/mail/view', 'Admin\AdminClientController@editMail');

		//クライアント編集画面-個別メール送信履歴画面表示
//		Route::get('member/client/edit/{id}/mail/history', 'Admin\AdminClientController@historyMailLog');

		//クライアント編集画面-個別メール送信履歴-詳細画面表示
//		Route::get('member/client/edit/{id}/mail/history/detail/{detail_id}', 'Admin\AdminClientController@historyMailLogDetail');

		//クライアント検索設定
		Route::get('member/client/search/setting', 'Admin\AdminClientController@searchSetting');

		//グループ管理
		Route::get('member/group', 'Admin\AdminMasterGroupController@index');

		//グループ管理-更新
		Route::post('member/group/send', 'Admin\AdminMasterGroupController@store');

		//グループ管理-グループ追加画面表示
		Route::get('member/group/add', 'Admin\AdminMasterGroupController@create');

		//グループ管理-グループ追加処理
		Route::post('member/group/add/send', 'Admin\AdminMasterGroupController@createSend');
		
		//グループ管理-一括移行
		Route::get('member/group/move/bulk', 'Admin\AdminMasterGroupController@bulkMoveGroup');

		//グループ管理-一括移行-更新
		Route::post('member/group/move/bulk/send', 'Admin\AdminMasterGroupController@bulkMoveGroupSend');

		//グループ管理-自動メール文設定
		Route::get('member/group/setting/{group_id}', 'Admin\AdminMasterMailContentController@index');
		Route::get('member/group/setting/redirect/{group_id}/{id?}', 'Admin\AdminMasterMailContentController@index');

		//グループ管理-自動メール文
		Route::get('member/group/setting/add/{group_id}', 'Admin\AdminMasterMailContentController@addSetting');

		//グループ管理-自動メール文更新
		Route::post('member/group/setting/send', 'Admin\AdminMasterMailContentController@store');

		//グループ管理-%変換設定
		Route::get('member/group/convert/setting/{group_id}', 'Admin\AdminMasterConvertController@index');

		//グループ管理-%変換設定-更新処理
		Route::post('member/group/convert/setting/send', 'Admin\AdminMasterConvertController@store');

		//グループ管理-%変換設定-キー追加画面表示
		Route::get('member/group/convert/setting/add/{group_id}', 'Admin\AdminMasterConvertController@create');

		//グループ管理-%変換設定-キー追加処理
		Route::post('member/group/convert/setting/add/send', 'Admin\AdminMasterConvertController@createSend');

		//グループ管理-グループ内検索
		Route::get('member/group/search', 'Admin\AdminMasterGroupController@groupSearch');

		//グループ管理-グループ内検索-IDごとの登録者表示
		Route::get('member/group/search/{id}', 'Admin\AdminMasterGroupController@listGroupUser');

		//グループ管理-グループ内検索-IDごとの登録者表示-カテゴリ一括移行
		Route::post('member/group/search/{group_id}/category/bulk/move/send', 'Admin\AdminMasterGroupController@moveBulkCategorySend');

		//グループ管理-グループ内検索-IDごとの登録者表示-ユーザーごとのカテゴリ移行
		Route::post('member/group/search/{group_id}/category/move/send', 'Admin\AdminMasterGroupController@moveCategorySend');

		//グループ管理-グループ内検索-カテゴリ追加画面表示
		Route::get('member/group/search/category/add/{id}', 'Admin\AdminMasterGroupController@createCategory');

		//グループ管理-グループ内検索-カテゴリ追加画面表示-追加処理
		Route::post('member/group/search/category/add/{id}/send', 'Admin\AdminMasterGroupController@createCategorySend');

		//ランディングページ-ドメイン一覧
		Route::get('member/lp', 'Admin\AdminLandingPageController@index');

		//ランディングページ-LP編集(デフォルトのLP一覧)
		Route::get('member/lp/list/{lpid}', 'Admin\AdminLandingPageController@listLandingPage');

		//ランディングページ-LP一覧(ページ一覧)
		Route::get('member/lp/list/{lpid}/subpage', 'Admin\AdminLandingPageController@listSubLandingPage');

		//ランディングページ-LP一覧(ページ一覧)-更新処理
		Route::post('member/lp/list/{lpid}/subpage/update/send', 'Admin\AdminLandingPageController@updatelistSubLandingPage');

		//ランディングページ-LP一覧(ページ一覧)-ページ追加
		Route::post('member/lp/list/{lpid}/subpage/add/send', 'Admin\AdminLandingPageController@addSubLandingPageSend');

		//ランディングページ-LP一覧(ページ編集)-ページ追加
		Route::post('member/lp/list/{lpid}/subpage/{page_name}/add/send', 'Admin\AdminLandingPageController@addFileSubLandingPageSend');

		//ランディングページ-LP一覧(ページ一覧)-参照-画像
		Route::get('member/lp/list/subpage/content/img/{lpid}/{page_name}', 'Admin\AdminLandingPageController@uploadSubLandingPageImg');

		//ランディングページ-LP一覧(ページ一覧)-参照-画像アップロード処理
		Route::post('member/lp/list/subpage/content/img/{lpid}/{page_name}/upload', 'Admin\AdminLandingPageController@uploadSubLandingPageImgUpload');

		//ランディングページ-LP一覧-参照-画像削除
		Route::post('member/lp/list/subpage/content/img/{lpid}/{page_name}/delete', 'Admin\AdminLandingPageController@deleteSubLandingPageImg');

		//ランディングページ-LP一覧(ページ一覧)-参照
		Route::get('member/lp/list/{lpid}/subpage/content/{page_name?}/{name?}', 'Admin\AdminLandingPageController@createSubLandingPage');

		//ランディングページ-LP一覧(ページ一覧)-参照-更新処理
		Route::post('member/lp/list/{lpid}/subpage/content/{page_name}/{name}/send', 'Admin\AdminLandingPageController@updateSubLandingPageSend');

		//ランディングページ編集-プレビュー表示
		Route::post('member/lp/subpage/{lpid}/{page_name}/{name}/preview', 'Admin\AdminLandingPageController@previewSubLandingPageSend');
		Route::get('member/lp/subpage/{lpid}/{page_name}/{name}/preview', 'Admin\AdminLandingPageController@previewSubLandingPage');

		//ランディングページ-共通ページ一覧
//		Route::get('member/lp/common', 'Admin\AdminLandingPageController@index_common');

		//ランディングページ-共通ページアップロード
//		Route::post('member/lp/common/create/upload', 'Admin\AdminLandingPageController@uploadCommonLandingPageUpload');

		//ランディングページ-共通ページアップロード-ファイル削除
//		Route::post('member/lp/common/delete', 'Admin\AdminLandingPageController@deleteCommonLandingPage');

		//ランディングページ編集-プレビュー表示
		Route::post('member/lp/create/content/{id}/{name}/preview', 'Admin\AdminLandingPageController@previewLandingPageSend');
		Route::get('member/lp/create/content/{id}/{name}/preview', 'Admin\AdminLandingPageController@previewLandingPage');

		//ランディングページ-LP一覧-参照
		Route::get('member/lp/create/content/{id}/{name?}', 'Admin\AdminLandingPageController@createLandingPage');

		//ランディングページ-LP一覧-参照-更新処理
		Route::post('member/lp/create/content/{id}/{name}/send', 'Admin\AdminLandingPageController@updateLandingPageSend');

		//ランディングページ-LP一覧-参照-画像
		Route::get('member/lp/create/img/{id}', 'Admin\AdminLandingPageController@uploadLandingPageImg');

		//ランディングページ-LP一覧-参照-画像アップロード処理
		Route::post('member/lp/create/img/{id}/upload', 'Admin\AdminLandingPageController@uploadLandingPageImgUpload');

		//ランディングページ-LP一覧-参照-画像削除
		Route::post('member/lp/create/img/{id}/delete', 'Admin\AdminLandingPageController@deleteLandingPageImg');

		//ランディングページ-LP一覧-検索設定画面表示
		Route::get('member/lp/search/setting', 'Admin\AdminLandingPageController@searchSetting');

		//ランディングページ-LP一覧-検索
		Route::get('member/lp/search', 'Admin\AdminLandingPageController@search');
		Route::post('member/lp/search', 'Admin\AdminLandingPageController@searchPost');

		//ランディングページ-LP一覧-新規作成
		Route::get('member/lp/create', 'Admin\AdminLandingPageController@create');
		Route::post('member/lp/create/send', 'Admin\AdminLandingPageController@createSend');

		//ランディングページ-LP一覧-LP編集-個別ページ追加
		Route::post('member/lp/create/content/{id}/add/page/send', 'Admin\AdminLandingPageController@addLandingPageSend');

		//ランディングページ-LP一覧-編集
		Route::get('member/lp/edit/{page}/{id}', 'Admin\AdminLandingPageController@edit');

		//ランディングページ-LP一覧-編集処理
		Route::post('member/lp/edit/send', 'Admin\AdminLandingPageController@store');

		//メルマガ-即時配信メルマガ-トップ
		Route::get('member/melmaga', 'Admin\AdminMelmagaController@index');

		//メルマガ-検索設定画面表示
		Route::get('member/melmaga/search/setting', 'Admin\AdminMelmagaController@searchSetting');

		//メルマガ-検索
		Route::get('member/melmaga/search', 'Admin\AdminMelmagaController@search');
		Route::post('member/melmaga/search', 'Admin\AdminMelmagaController@searchPost');

		//メルマガ-検索-メルマガ即時配信
		Route::post('member/melmaga/search/mail/send', 'Admin\AdminMelmagaController@sendImmediateMelmaga');

		//メルマガ-メルマガ配信履歴
		Route::get('member/melmaga/mail/history', 'Admin\AdminMelmagaController@historySendMelmaga');

		//集計-メルマガ配信履歴-配信リスト
		Route::get('member/melmaga/mail/history/list/{melmaga_id}', 'Admin\AdminMelmagaController@listHistorySendMelmaga');

		//メルマガ-メルマガ配信履歴-配信メルマガ確認
		Route::get('member/melmaga/mail/history/view/{page}/{send_id}/{client_id?}', 'Admin\AdminMelmagaController@viewHistorySendMelmaga');

		//メルマガ-送信失敗一覧
		Route::get('member/melmaga/mail/failed/list', 'Admin\AdminMelmagaController@failedSendMelmaga');

		//メルマガ-送信失敗一覧-再配信
		Route::post('member/melmaga/mail/failed/list/redelivery', 'Admin\AdminMelmagaController@sendFailedMelmaga');

		//メルマガ-送信失敗一覧-メルマガ送信失敗リスト
		Route::get('member/melmaga/mail/failed/list/emails/{page}/{melmaga_id}', 'Admin\AdminMelmagaController@listFailedSendMelmaga');

		//メルマガ-送信失敗一覧-一括削除
		Route::post('member/melmaga/mail/failed/list/del', 'Admin\AdminMelmagaController@bulkDeleteSend');

		//メルマガ-予約配信メルマガ-トップ
		Route::get('member/melmaga/reserve', 'Admin\AdminMelmagaReserveController@index');

		//メルマガ-検索設定画面表示
		Route::get('member/melmaga/reserve/search/setting', 'Admin\AdminMelmagaReserveController@searchSetting');

		//メルマガ-予約配信メルマガ-検索
		Route::get('member/melmaga/reserve/search', 'Admin\AdminMelmagaReserveController@search');
		Route::post('member/melmaga/reserve/search', 'Admin\AdminMelmagaReserveController@searchPost');

		//メルマガ-検索-予約配信メルマガ-メルマガ予約配信
		Route::post('member/melmaga/reserve/search/mail/send', 'Admin\AdminMelmagaReserveController@sendReserveMelmaga');

		//メルマガ-予約配信メルマガ-予約状況
		Route::get('member/melmaga/reserve/status', 'Admin\AdminMelmagaReserveController@statusReserveMelmaga');

		//メルマガ-予約配信メルマガ-予約状況-メルマガ編集
		Route::get('member/melmaga/reserve/status/edit/{page}/{melmaga_id}', 'Admin\AdminMelmagaReserveController@editReserveMelmaga');

		//メルマガ-予約配信メルマガ-予約状況-メルマガ編集-更新
		Route::post('member/melmaga/reserve/status/edit/{melmaga_id}/send', 'Admin\AdminMelmagaReserveController@sendEditReserveMelmaga');

		//メルマガ-予約配信メルマガ-予約状況-キャンセル
		Route::post('member/melmaga/reserve/status/cancel/{page}/{id}', 'Admin\AdminMelmagaReserveController@sendCancel');

		//メルマガ-登録後送信メール
		Route::get('member/melmaga/registered/mail', 'Admin\AdminMelmagaRegisteredMailController@index');

		//メルマガ-登録後送信メール-一括削除
		Route::post('member/melmaga/registered/mail/delete/send', 'Admin\AdminMelmagaRegisteredMailController@bulkUpdate');

		//メルマガ-登録後送信メール-新規作成
		Route::get('member/melmaga/registered/mail/create', 'Admin\AdminMelmagaRegisteredMailController@create');

		//メルマガ-登録後送信メール-新規作成-作成処理
		Route::post('member/melmaga/registered/mail/create/send', 'Admin\AdminMelmagaRegisteredMailController@createSend');

		//メルマガ-登録後送信メール-検索設定
		Route::get('member/melmaga/registered/mail/search/setting', 'Admin\AdminMelmagaRegisteredMailController@searchSetting');

		//メルマガ-登録後送信メール-検索設定-検索処理
		Route::get('member/melmaga/registered/mail/search', 'Admin\AdminMelmagaRegisteredMailController@search');
		Route::post('member/melmaga/registered/mail/search', 'Admin\AdminMelmagaRegisteredMailController@searchPost');

		//メルマガ-登録後送信メール-編集画面表示
		Route::get('member/melmaga/registered/mail/edit/{page}/{id}', 'Admin\AdminMelmagaRegisteredMailController@edit');

		//メルマガ-登録後送信メール-編集画面表示-編集処理
		Route::post('member/melmaga/registered/mail/edit/send', 'Admin\AdminMelmagaRegisteredMailController@store');

		//メルマガ-絵文字変換表示(HTML)
		Route::get('member/melmaga/emoji/convert/html', 'Admin\AdminEmojiController@convertHtmlMelmaga');

		//マスタ管理-絵文字変換表示
		Route::get('member/master/emoji/convert/{id}', 'Admin\AdminEmojiController@convert');

		//マスタ管理-タグ設定
		Route::get('member/master/tags/setting', 'Admin\AdminMasterTagsSettingController@index');

		//マスタ管理-タグ設定-追加
		Route::get('member/master/tags/setting/add', 'Admin\AdminMasterTagsSettingController@create');

		//マスタ管理-タグ設定-追加処理
		Route::post('member/master/tags/setting/add/send', 'Admin\AdminMasterTagsSettingController@createSend');

		//マスタ管理-タグ設定-一括更新処理
		Route::post('member/master/tags/setting/update/send', 'Admin\AdminMasterTagsSettingController@updateSend');

		//マスタ管理-タグ設定-編集画面
		Route::get('member/master/tags/setting/edit/{id}', 'Admin\AdminMasterTagsSettingController@edit');

		//マスタ管理-タグ設定-編集画面-更新処理
		Route::post('member/master/tags/setting/edit/{id}/send', 'Admin\AdminMasterTagsSettingController@store');

		//マスタ管理-メールアドレス禁止ワード設定
		Route::get('member/master/mailaddress_ng_word/setting', 'Admin\AdminMasterMailAddressNgWordController@index');

		//マスタ管理-メールアドレス禁止ワード設定-更新処理
		Route::post('member/master/mailaddress_ng_word/setting/send', 'Admin\AdminMasterMailAddressNgWordController@store');

		//マスタ管理-ドメイン設定
		Route::get('member/master/domain/setting', 'Admin\AdminMasterDomainController@index');

		//マスタ管理-ドメイン設定-更新
		Route::post('member/master/domain/setting/send', 'Admin\AdminMasterDomainController@store');

		//マスタ管理-ドメイン設定-追加
		Route::get('member/master/domain/setting/add', 'Admin\AdminMasterDomainController@create');

		//マスタ管理-ドメイン設定-追加処理
		Route::post('member/master/domain/setting/add/send', 'Admin\AdminMasterDomainController@createSend');

		//マスタ管理-リレーサーバー設定
		Route::get('member/master/relayserver/setting', 'Admin\AdminMasterRelayServerController@index');

		//マスタ管理-リレーサーバー設定-更新処理
		Route::post('member/master/relayserver/setting/send', 'Admin\AdminMasterRelayServerController@store');

		//マスタ管理-自動メール文設定-変換表表示
		Route::get('member/master/mail_sentence/setting/convert/{id}', 'Admin\AdminMasterMailContentController@convert');

		//マスタ管理-確認アドレス設定
		Route::get('member/master/confirm/email/setting', 'Admin\AdminMasterConfirmEmailSettingController@index');

		//マスタ管理-確認アドレス設定-アドレス追加画面
		Route::get('member/master/confirm/email/setting/add', 'Admin\AdminMasterConfirmEmailSettingController@create');

		//マスタ管理-確認アドレス設定-アドレス追加-追加処理
		Route::post('member/master/confirm/email/setting/add/send', 'Admin\AdminMasterConfirmEmailSettingController@createSend');

		//マスタ管理-確認アドレス設定-更新処理
		Route::post('member/master/confirm/email/setting/del/send', 'Admin\AdminMasterConfirmEmailSettingController@updateSend');

		//マスタ管理-メンテナンス設定
		Route::get('member/maintenance/setting', 'Admin\AdminMasterMaintenanceController@index');

		//マスタ管理-メンテナンス設定処理
		Route::post('member/maintenance/setting/send', 'Admin\AdminMasterMaintenanceController@createSend');

		//マスタ管理-メンテナンス設定-メンテナンス画面プレビュー
		Route::get('member/maintenance/setting/preview', 'Admin\AdminMasterMaintenanceController@preview');
/*
		//マスタ管理-画像UPLOAD
		Route::get('member/master/img/upload/{sort_type?}', 'Admin\AdminImgUploadController@index');

		//マスタ管理-画像UPLOAD処理
		Route::post('member/master/img/upload/send', 'Admin\AdminImgUploadController@uploadImg');

		//マスタ管理-画像削除処理
		Route::post('member/master/img/upload/delete', 'Admin\AdminImgUploadController@deleteImg');

*/
		//集計-アクセス解析-年
		Route::get('member/analytics/access/{year?}', 'Admin\AdminAnalyticsController@index');

		//集計-アクセス解析-月
		Route::get('member/analytics/access/{year}/{month}', 'Admin\AdminAnalyticsController@monthAnalysis');

		//集計-アクセス解析-日
		Route::get('member/analytics/access/{year}/{month}/{day}', 'Admin\AdminAnalyticsController@dayAnalysis');

		//集計-メルマガ解析-トップ
		Route::get('member/analytics/melmaga/access', 'Admin\AdminMelmagaAnalyticsController@index');

		//集計-メルマガ解析-閲覧済
		Route::get('member/analytics/melmaga/access/visited/{melmaga_id}', 'Admin\AdminMelmagaAnalyticsController@viewVisited');

		//集計-メルマガ解析-閲覧済
		Route::get('member/analytics/melmaga/access/unseen/{melmaga_id}', 'Admin\AdminMelmagaAnalyticsController@viewUnseen');

		//集計-PVログ-年
		Route::get('member/analytics/pv/access/{year?}', 'Admin\AdminPvAnalyticsController@index');

		//集計-PVログ-月
		Route::get('member/analytics/pv/access/{year}/{month}/{pv_name}', 'Admin\AdminPvAnalyticsController@monthAnalysis');

		//集計-利用統計-年
		Route::get('member/analytics/statistics/access/{year?}', 'Admin\AdminUserStatisticsController@index');

		//集計-利用統計-月
		Route::get('member/analytics/statistics/access/{year}/{month}', 'Admin\AdminUserStatisticsController@monthAnalysis');

		//集計-利用統計-日
		Route::get('member/analytics/statistics/access/{year}/{month}/{day}', 'Admin\AdminUserStatisticsController@dayAnalysis');

		//広告-広告コード-一覧
		Route::get('member/ad/adcode', 'Admin\AdminAdCodeController@index');

		//広告-広告コード-一覧-一括削除
		Route::post('member/ad/adcode/send', 'Admin\AdminAdCodeController@bulkDeleteSend');

		//広告-広告コード-新規作成
		Route::get('member/ad/adcode/create', 'Admin\AdminAdCodeController@create');

		//広告-広告コード-新規作成処理
		Route::post('member/ad/adcode/create/send', 'Admin\AdminAdCodeController@createSend');

		//広告-広告コード-編集
		Route::get('member/ad/adcode/edit/{page}/{ad_id}', 'Admin\AdminAdCodeController@edit');

		//広告-広告コード-編集処理
		Route::post('member/ad/adcode/edit/send', 'Admin\AdminAdCodeController@store');

		//広告-広告コード-検索設定
		Route::get('member/ad/adcode/search/setting', 'Admin\AdminAdCodeController@searchSetting');

		//広告-広告コード-検索処理
		Route::post('member/ad/adcode/search', 'Admin\AdminAdCodeController@searchPost');
		Route::get('member/ad/adcode/search', 'Admin\AdminAdCodeController@search');

		//広告-代理店-一覧
		Route::get('member/ad/agency', 'Admin\AdminAdAgencyController@index');

		//広告-代理店-一括削除
		Route::post('member/ad/agency/send', 'Admin\AdminAdAgencyController@bulkDeleteSend');

		//広告-代理店-新規作成
		Route::get('member/ad/agency/create', 'Admin\AdminAdAgencyController@create');

		//広告-代理店-新規作成処理
		Route::post('member/ad/agency/create/send', 'Admin\AdminAdAgencyController@createSend');

		//広告-代理店-編集
		Route::get('member/ad/agency/edit/{page}/{ad_id}', 'Admin\AdminAdAgencyController@edit');

		//広告-代理店-編集処理
		Route::post('member/ad/agency/edit/send', 'Admin\AdminAdAgencyController@store');

		//広告-媒体集計-一覧
		Route::get('member/ad/media', 'Admin\AdminAdMediaController@index');

		//広告-媒体集計-検索設定
		Route::get('member/ad/media/search/setting', 'Admin\AdminAdMediaController@searchSetting');

		//広告-媒体集計-検索処理
		Route::post('member/ad/media/search', 'Admin\AdminAdMediaController@searchPost');
		Route::get('member/ad/media/search', 'Admin\AdminAdMediaController@search');

	});
});

//仮登録ボタン押下
Route::post('/regist', 'Auth\RegisterController@create');

//ランディングページ
//Route::group(['middleware' => 'check.ban.accessip'], function() {
	Route::get('{string?}', 'RedirectLandingPageController@index', function($string){
	})->where('string', '[A-Za-z0-9?=./_-]*');
//});

/*******************
 * 
	会員ページ
 * 
 *******************/
/*
Route::group(['middleware' => ['auth.token', 'member.lastaccess.update', 'view.melmaga']], function () {

});
*/

