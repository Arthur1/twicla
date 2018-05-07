<template>
	<div class="row">
		<div class="col s12">
			<p>
				以下の必要事項を記入してください。
			</p>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="text" name="name" id="form_name" class="form-control" v-model="name" required>
			<label for="form_name">ユーザ名</label>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="email" name="email" id="form_email" class="form-control" v-model="email" required>
			<label for="form_email">メールアドレス</label>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="password" name="password" id="form_password" class="form-control" v-model="password" required>
			<label for="form_password">パスワード</label>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="password" name="password_check" id="form_password_check" class="form-control" v-model="password_check" required>
			<label for="form_password_check">パスワード(確認)</label>
		</div>
		<div class="col s12 input-field">
			<button @click="register" type="submit" class="btn btn-primary">登録</button>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				name: '',
				email: '',
				password: '',
				password_check: '',
			}
		},

		methods: {
			register() {
				let register_params = {name: this.name, email: this.email, password: this.password}
				this.$store.dispatch('register', register_params).then(() => {
					let login_params = {email: this.email, password: this.password}
					this.$store.dispatch('login', login_params).then(() => {
						this.$router.push('/')
						M.toast({html: '登録完了しました', classes: 'teal white-text'})
					}).catch(() => {
						M.toast({html: 'ログインに失敗しました。メニューから再度ログインしてください', classes: 'red white-text'})
					})
				}).catch(() => {
					M.toast({html: 'ユーザー登録に失敗しました', classes: 'red white-text'})
				})
			},
		},
	}
</script>