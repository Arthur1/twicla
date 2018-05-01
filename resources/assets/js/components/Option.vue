<template>
	<div>
		<h1 class="light-blue-text">設定</h1>
		<h2 class="indigo-text">icalファイル</h2>
		<p>
			OCW-iから取得できるicalファイルのurlを入力してください。
		</p>
		<div class="row">
			<div class="col s9 m7 input-field">
				<input type="text" name="ics" id="form_ics" class="form-control" v-model="ics" @keyup.enter="registerIcs" required>
				<label for="form_ics">icalファイルURL</label>
				<p class="text-red" role="alert" v-if="showAlert">
					{{ alertMessage }}
				</p>
			</div>
			<div class="col s3 input-field">
				<button type="submit" @click="registerIcs" class="btn btn-primary">登録</button>
			</div>
		</div>
		<h2 class="indigo-text">Twitter連携</h2>
	</div>
</template>
<script>
	import userStore from '../stores/userStore'
	import http from '../services/http'

	export default {
		data() {
			return {
				ics: '',
				showAlert: false,
				alertMessage: '',
			}
		},

		mounted() {
			userStore.setCurrentUser(function() {
				http.get('ics/get?user_id=' + userStore.state.user.id, res => {
					this.ics = res.ics_url
				}, error => {
					console.log('error')
				})
			})
		},

		methods: {
			registerIcs() {
				let param = {user_id: userStore.state.user.id, ics: this.ics}
				http.post('ics/register', param, () => {
					console.log('success')
				}, () => {
					console.log('failed')
				})
			},
		},
	}
</script>