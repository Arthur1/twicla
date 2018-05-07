<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>twicla</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/css/materialize.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#03a9f4">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#fafafa">
</head>
<body class="grey lighten-5">
<div id="app">
	<header-bar></header-bar>
	<main class="container">
		<router-view></router-view>
	</main>
</div>
<script>
	window.Laravel = {};
	window.Laravel.csrfToken = "{{ csrf_token() }}";
</script>
<script src="/js/materialize.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
