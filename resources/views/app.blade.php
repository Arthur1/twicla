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
</head>
<body class="grey lighten-5">
<div id="app">
	<header-bar></header-bar>
	<main class="container">
		<router-view></router-view>
	</main>
	<footer-bar></footer-bar>
</div>
<script>
	window.Laravel = {};
	window.Laravel.csrfToken = "{{ csrf_token() }}";
</script>
<script src="/js/app.js"></script>
<script src="/js/materialize.js"></script>
</body>
</html>
