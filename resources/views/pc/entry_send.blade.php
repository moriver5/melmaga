@extends('layouts.entry_base')
@extends('layouts.body_top_index')
@section('entry')
<main>
<h1 class="ttl_01">メルマガ登録</h1>

<section>
<div class="cont">
@if( $msg_flg == 1 )
<p>入力したメールアドレス宛に本登録用のメールを送信しました。<br />
<br />
しばらくしても届かない場合は下記までお問い合わせください。<br />
<a href="mailto:{{ config('const.replay_to_mail') }}">{{ config('const.replay_to_mail') }}</a>
</p>
@elseif( $msg_flg == 2 )
<p>入力したメールアドレスは既に登録されています。<br />
<br />
心当たりのない場合は下記までお問い合わせください。<br />
<a href="mailto:{{ config('const.replay_to_mail') }}">{{ config('const.replay_to_mail') }}</a>
</p>
@else
<p>マスタ管理の自動メール文設定がされていません。<br />
設定しないとメールが送信されません。</p>
@endif
</div>
</section>

</main>
@endsection