@extends('layouts.entry_base')
@extends('layouts.body_top_index')
@section('entry')

<main>
<div class="block_main">
<p class="image">
<picture>
<source media="(max-width:1000px)" srcset="/images/index_main_Mbl.jpg">
<img src="/images/index_main.jpg" alt="完全攻略！ズバリ的中 最強必勝レース分析">
</picture>
</p>

<!-- /.block_main --></div>


<div class="block_catch">
<form action="{{ url('regist') }}" method="post" class="block_regist">
{{csrf_field()}}
@if($errors->has('email'))
<p class="text_w f_bold">{{ $errors->first('email') }}</p>
@endif
<p class="form_mail"><input type="email" name="email" value="" maxlength={{ config('const.email_length') }} placeholder="メールアドレスを入力してください。（半角英数字）"></p>
<p class="btn_grn_01"><input type="submit" value="無料情報を受け取る"></p>
<input type="hidden" name="group_id" value="3">
<input type="hidden" name="lpid" value="2">
<ul class="list_note">
<li><span class="marker">※</span>利用規約とメール配信に同意の上ご登録下さい。</li>
<li><span class="marker">※</span>ご登録に個人情報（性別・年齢・住所・職業・電話番号）は必要ありません。</li>
<li><span class="marker">※</span>携帯でご登録の方はメールが確実に届かれますよう事前に【jra-yosou.jp】の指定解除受信設定をお願い致します。</li>
</ul>
</form>


<ol class="list_regist">
<li><dl>
<dt>STEP 1</dt>
<dd>メールアドレスを入力！</dd>
</dl></li>
<li><dl>
<dt>STEP 2</dt>
<dd>折り返しメールが届いたら<br>
記載URLをクリック！</dd>
</dl></li>
<li><dl>
<dt>STEP 3</dt>
<dd>本登録完了！</dd>
</dl></li>
</ol>

<div class="block_mail">
<p><img src="images/index_mail_01.png" alt="docomo、au、softbankなどのキャリアメールの他に、フリーメールもご利用頂けます！"></p>
<p><em><img src="images/index_mail_02.png" alt="※注意 icloud.comはご利用できません。"></em></p>
<!-- /.block_mail --></div>


<p class="img_catch"><img src="images/index_catch.png" alt="情報を見逃すな！会員登録で有力な無料情報が届く!!最先端の情報分析、最効率の投資分析、有効な本物の投資競馬を提供。"></p>


<form action="{{ url('regist') }}" method="post" class="block_regist">
{{csrf_field()}}
@if($errors->has('email'))
<p class="text_w f_bold">{{ $errors->first('email') }}</p>
@endif
<p class="label"><label for="mail_address">▼無料登録で情報を受け取る▼</label></p>
<p class="form_mail"><input type="email" name="email" id="mail_address" value="" maxlength={{ config('const.email_length') }} placeholder="メールアドレスを入力してください。（半角英数字）"></p>
<p class="btn_grn_01"><input type="submit" value="無料情報を受け取る"></p>
<input type="hidden" name="group_id" value="3">
<input type="hidden" name="lpid" value="">
<ul class="list_note">
<li><span class="marker">※</span>利用規約とメール配信に同意の上ご登録下さい。</li>
<li><span class="marker">※</span>ご登録に個人情報（性別・年齢・住所・職業・電話番号）は必要ありません。</li>
<li><span class="marker">※</span>携帯でご登録の方はメールが確実に届かれますよう事前に【jra-yosou.jp】の指定解除受信設定をお願い致します。</li>
</ul>
</form>
<!-- /.block_catch --></div>


<ol class="list_regist">
<li><dl>
<dt>STEP 1</dt>
<dd>メールアドレスを入力！</dd>
</dl></li>
<li><dl>
<dt>STEP 2</dt>
<dd>折り返しメールが届いたら<br>
記載URLをクリック！</dd>
</dl></li>
<li><dl>
<dt>STEP 3</dt>
<dd>本登録完了！</dd>
</dl></li>
</ol>

<div class="block_mail">
<p><img src="images/index_mail_01.png" alt="docomo、au、softbankなどのキャリアメールの他に、フリーメールもご利用頂けます！"></p>
<p><em><img src="images/index_mail_02.png" alt="※注意 icloud.comはご利用できません。"></em></p>
<!-- /.block_mail --></div>


<ul class="list_features">
<li>
<picture>
<source media="(max-width:1000px)" srcset="/images/index_features_01_Mbl.jpg">
<img src="/images/index_features_01.jpg" alt="各競馬情報誌の情報は、原稿を書く時間、印刷する時間、全国へ配達する時間を考えれば各誌発行日の前日の情報。もしくは何週間も前の情報である事は明白。当社は、各競馬情報誌の様に過去に取得した情報から精査するという事はございません。">
</picture>
</li>

<li>
<picture>
<source media="(max-width:1000px)" srcset="/images/index_features_02_Mbl.jpg">
<img src="/images/index_features_02.jpg" alt="わずかで変わり身を見せ、怪物にのし上がる馬も少なくない。その証拠に、実力馬に印が集中する各情報誌が的中させられていないという事で証明できる。逆に過去の情報から
精査された人気情報誌のトラックマンの印で低配当のオッズを作り上げてくれる為、その印以外の競走馬が好走する事で万馬券レースになるのです。">
</picture>
</li>

<li>
<picture>
<source media="(max-width:1000px)" srcset="/images/index_features_03_Mbl.jpg">
<img src="/images/index_features_03.jpg" alt="競馬に絶対はありませんが、最新かつ最先端の情報で、投資馬券でもレースを次々と的中させております。また、的中、不的中の結果を包み隠さずみなさまに公開する事で、その高い精度と信頼の実績を完全証明しております。">
</picture>
</li>
</ul>


<form action="{{ url('regist') }}" method="post" class="cont_regist">
{{csrf_field()}}
@if($errors->has('email'))
<p class="text_w f_bold">{{ $errors->first('email') }}</p>
@endif
<p class="label"><label for="mail_address2">▼無料登録で情報を受け取る▼</label></p>
<div class="block_regist">
<p class="form_mail"><input type="email" name="email" id="mail_address2" value="" maxlength={{ config('const.email_length') }} placeholder="メールアドレスを入力してください。（半角英数字）"></p>
<p class="btn_grn_01"><input type="submit" value="無料情報を受け取る"></p>

<ul class="list_note">
<li><span class="marker">※</span>利用規約とメール配信に同意の上ご登録下さい。</li>
<li><span class="marker">※</span>ご登録に個人情報（性別・年齢・住所・職業・電話番号）は必要ありません。</li>
<li><span class="marker">※</span>携帯でご登録の方はメールが確実に届かれますよう事前に【jra-yosou.jp】の指定解除受信設定をお願い致します。</li>
</ul>
<!-- /.block_regist --></div>
</form>


<ol class="list_regist">
<li><dl>
<dt>STEP 1</dt>
<dd>メールアドレスを入力！</dd>
</dl></li>
<li><dl>
<dt>STEP 2</dt>
<dd>折り返しメールが届いたら<br>
記載URLをクリック！</dd>
</dl></li>
<li><dl>
<dt>STEP 3</dt>
<dd>本登録完了！</dd>
</dl></li>
</ol>

<div class="block_mail">
<p><img src="images/index_mail_01.png" alt="docomo、au、softbankなどのキャリアメールの他に、フリーメールもご利用頂けます！"></p>
<p><em><img src="images/index_mail_02.png" alt="※注意 icloud.comはご利用できません。"></em></p>
<!-- /.block_mail --></div>
</main>
@endsection