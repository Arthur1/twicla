<template>
	<div>
		<h1 class="light-blue-text">icalファイル</h1>
		<p>
			OCW-iから取得できるicalファイルのurlを入力してください。
		</p>
		<div class="row">
			<div class="col s12 m9 input-field">
				<input type="text" name="ics" id="form_ics" class="form-control" v-model="ics" @keyup.enter="registerIcs" required autofocus>
				<label for="form_ics">icalファイルURL</label>
			</div>
			<div class="col s12 m3 input-field">
				<button type="submit" @click="registerIcs" class="btn btn-primary"><i class="material-icons right">send</i>登録</button>
			</div>
		</div>
		<h1 class="light-blue-text">Twitter連携</h1>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				ics: '',
			}
		},

		mounted() {
			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('ics/get?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.ics = res.data.ics_url
					M.updateTextFields()
				}, error => {
					M.toast({html: '登録情報の確認に失敗しました', classes: 'red white-text'})
				})
			}).catch(() => {
				this.$router.push('/login')
			})
		},

		methods: {
			registerIcs() {
				let params = {user_id: this.$store.getters.getUser.id, ics: this.ics}
				http.post('ics/register', params, res => {
					M.toast({html: 'icalファイルの登録に成功しました', classes: 'teal white-text'})
				}, error => {
					M.toast({html: 'icalファイルの登録に失敗しました。URLが正しいか確認してください', classes: 'red white-text'})
				})
			},
		},
	}
</script>