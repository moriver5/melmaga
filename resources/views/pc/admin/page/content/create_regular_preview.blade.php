<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta name="robots" content="noindex,nofollow">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title>メルマガ運営管理</title>
<link rel="stylesheet" href="/css/common/style.css">
<link rel="stylesheet" href="/css/common/pushy.css">
</head>
<body id="state_in" class="index">
<div id="container">
	<main>
	<h1 class="ttl_01">情報公開</h1>
	<div class="cont">
	<section>
		<div id="create_preview">
		@if( !empty($db_data->html_body) )
			{!! $db_data->html_body !!}
		@endif
		</div>
	</section>
	</div>
	</main>
</div>
</body>
</html>
