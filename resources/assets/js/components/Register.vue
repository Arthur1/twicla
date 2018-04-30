<template>
	<div class="row">
		<div class="col s12">
			<h1 class="light-blue-text">ユーザー登録</h1>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="text" name="name" id="form_name" class="form-control" v-model="name" required>
			<label for="form_name">ユーザ名</label>
		</div>
		<div class="col s12 m9 l7 input-field">
			<input type="email" name="email" id="form_email" class="form-control" v-model="email" required>
			<label for="form_email">メールアドレス</label>
			<p class="text-red" role="alert" v-if="showAlert">
				{{ alertMessage }}
			</p>
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
			<button type="submit" class="btn btn-primary">登録</button>
		</div>
	</div>
</template>
<script>
	import userStore from '../stores/userStore'
	import http from '../services/http'

	export default {
		data() {
			return {
				email: '',
				password: '',
				showAlert: false,
				alertMessage: '',
			}
		},
		methods: {
			register() {

			},
			login() {
				userStore.login(this.email, this.password, res => {
					this.$router.push('/')
				}, error => {
					this.showAlert = true
					this.alertMessage = 'メールアドレスかパスワードが違います。'
				})
			},
		}
	}
</script>