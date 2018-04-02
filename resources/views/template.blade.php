<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/css/materialize.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body class="grey lighten-5">
<header class="navbar-fixed">
	<nav>
		<div class="nav-wrapper blue">
			<a href="/" class="left hide-on-med-and-down brand-logo">twicla</a>
			<a href="" class="hide-on-large-only" style="font-size: 1.2em;">twicla</a>
			<a href="#" data-activates="mobile-menu" class="button-collapse left"><i class="material-icons">menu</i></a>
			<ul class="side-nav" id="mobile-menu">
				<li>ああああ</li>
			</ul>
			<ul class="right hide-on-med-and-down">
				<li>ああああ<li>
			</ul>
		</div>
	</nav>
</header>
<main class="container">
	 @yield('content')
</main>
<footer class="page-footer grey darken-1" id="footer">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">twicla</h5>
				<p class="grey-text text-lighten-4">ツイッタラーのための出席管理ツール</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			&copy; 2018 Arthur
		</div>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/js/materialize.min.js"></script>
<script src="/js/footerFixed.js"></script>
<script src="/js/template.js"></script>
</body>
</html>
