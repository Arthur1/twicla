@extends('template')

@section('title', 'ユーザー登録')

@section('content')
<h1 class="light-blue-text">ユーザー登録</h1>
<form method="POST" action="{{ route('register') }}">
{{ csrf_field() }}

<div class="row">
	<div class="col s12 m7 input-field">
		<input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
		<label for="name">名前</label>
		@if ($errors->has('name'))
			<span class="red-text">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
		@endif
	</div>
	<div class="col s12 m7 input-field">
		<input id="email" type="email" name="email" value="{{ old('email') }}" required>
		<label for="email">メールアドレス</label>
		@if ($errors->has('email'))
			<span class="red-text">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
	</div>
	<div class="col s12 m7 input-field">
		<input id="password" type="password" name="password" value="{{ old('password') }}" required>
		<label for="password">パスワード</label>
		@if ($errors->has('password'))
			<span class="red-text">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
		@endif
	</div>
	<div class="col s12 m7 input-field">
		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
		<label for="password">パスワード(確認)</label>
	</div>
	<div class="col s12 input-field">
		<button type="submit" class="btn">登録</button>
	</div>
</div>
</form>
@endsection