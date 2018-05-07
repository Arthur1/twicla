<template>
	<div>
		<p>
			以下の必要事項を記入してログインしてください
		</p>
		<div class="row">
			<div class="col s12 m9 l7 input-field">
				<input type="email" name="email" id="form_email" class="form-control" v-model="email" @keyup.enter="login" required autofocus>
				<label for="form_email">メールアドレス</label>
			</div>
			<div class="col s12 m9 l7 input-field">
				<input type="password" name="password" id="form_password" class="form-control" v-model="password" @keyup.enter="login" required autofocus>
				<label for="form_password">パスワード</label>
			</div>
			<div class="col s12 input-field">
				<button @click="login" type="submit" class="btn btn-primary">ログイン</button>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				email: '',
				password: '',
			}
		},

		methods: {
			login() {
				let params = {email: this.email, password: this.password}
				this.$store.dispatch('login', params).then(() => {
					M.toast({html: 'ログインしました', classes: 'teal white-text'})
					this.$router.push('/')
				}).catch(() => {
					M.toast({html: 'ログインに失敗しました。メールアドレスとパスワードが正しいかお確かめください。', classes: 'red white-text'})
				})
			},
		},
	}
</script>