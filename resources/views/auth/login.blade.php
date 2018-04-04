@extends('template')

@section('title', 'ログイン')

@section('content')
<h1 class="light-blue-text">ログイン</h1>
<form method="POST" action="{{ route('login') }}">
{{ csrf_field() }}

<div class="row">
	<div class="col s12 m7 input-field">
		<input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
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
	<div class="col s12">
		<input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
		<label for="remember">ログイン状態を保持する</label>
	</div>
	<div class="col s12 input-field">
		<button type="submit" class="btn">ログイン</button>
	</div>
	<div class="col s12">
		<p>
			パスワードを忘れた方は<a href="{{ route('password.request') }}">こちら</a>
		</p>
	</div>
</div>
</form>
@endsection
