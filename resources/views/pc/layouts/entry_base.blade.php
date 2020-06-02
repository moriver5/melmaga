<!DOCTYPE HTML>
<html amp lang="ja" prefix="og: http://ogp.me/ns#">
<head>
<meta name="google-site-verification" content="V0XCPpNsEr259iVt2qepiK5n5nAfSVDY0b0NttxrEJs" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta property="og:title" content="メルマガ運営管理">
<meta property="og:type" content="website">
<meta property="og:url" content="http://jra-yosou.jp">
<title>メルマガ配信{{ $title }}</title>
<link rel="canonical" href="http://jra-yosou.jp">
<link rel="stylesheet" href="/css/common/style.css">
<link rel="stylesheet" href="/css/common/pushy.css"><!-- スライドメニュー -->
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css"><!-- アニメーション -->

<script asyanc src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
@include('layouts.tags.piwik_code')
</head>

@yield('entry')

<footer>
<div class="inner">
<p class="logo"><img src="/css/common/images/logo.png" alt="メルマガ運営管理"></p>

<div class="utility">
<ul class="sitemap">
<li><a href="/index">TOP</a></li>
<li><a href="/info">お問い合わせ</a></li>
<li><a href="/privacy">プライバシーポリシー</a></li>
<li><a href="/rule">利用規約</a></li>
<li><a href="/outline">特定商取引法に基づく表記</a></li>
</ul>

<p class="copyright"><small>Copyright(C)2018 メルマガ運営管理 All Rights Reserved.</small></p>
<!-- /.utility --></div>
<!-- /.inner --></div>
</footer>

<p class="btn_pagetop"><a href="#header"><img src="/css/common/images/btn_pagetop.png" alt="Page top"></a></p>

<!-- スライドメニュー -->
<!-- ボタン -->
<div class="menu-btn"><p><img src="/css/common/images/btn_menu.png" alt="MENU"></p></div>

<!-- オーバーレイ -->
<div class="site-overlay"></div>

<!-- メニュー -->
<nav class="pushy pushy-left">

<p class="logo"><a href="index.html"><img src="/css/common/images/nav_logo.png" alt="メルマガ運営管理"></a></p>
<dl>
<dt>メニュー</dt>
<dd>
<ul>
<li class="index"><a href="index.html">トップページ</a></li>
<li><a href="/info">お問い合わせ</a></li>
<li><a href="/privacy">プライバシーポリシー</a></li>
<li><a href="/rule">利用規約</a></li>
<li><a href="/outline">特定商取引法に基づく表記</a></li>
</ul>
</dd>
</dl>
</nav>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js"></script><!-- 表示領域判定 -->
<script async src="/css/common/run.js"></script>
<script async>
// 表示領域でアニメーション制御（jquery.inview.min.js）
$(function() {
	$('.animated').each(function(){
		$('.inviewzoomIn').on('inview', function(event, isInView) {
			if (isInView) {
			// In
				$(this).addClass('zoomIn');
				$(this).css('opacity',1);
			} else {
			// Out
				$(this).removeClass('zoomIn');
				$(this).css('opacity',0);
			}
		});
	});
});
</script>
<!-- /スライドメニュー -->
<script async src="https://cdnjs.cloudflare.com/ajax/libs/pushy/1.1.0/js/pushy.min.js"></script><!-- スライドメニュー -->
</body>
</html>
