<template>
	<div>
		<h1 class="light-blue-text">ログイン</h1>
		<div class="row">
			<div class="col s7 input-field">
				<input type="email" name="email" id="form_email" class="form-control" v-model="email" @keyup.enter="login" required autofocus>
				<label for="form_email">E-mail</label>
				<p class="text-red" role="alert" v-if="showAlert">
					{{ alertMessage }}
				</p>
			</div>
			<div class="col s7 input-field">
				<input type="password" name="password" id="form_password" class="form-control" v-model="password" @keyup.enter="login" required autofocus>
				<label for="form_password">Password</label>
			</div>
			<div class="col s12 input-field">
				<button @click="login" type="submit" class="btn btn-primary">ログイン</button>
			</div>
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