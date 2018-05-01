<template>
	<div>
		<h1 class="light-blue-text">スケジュール</h1>
		<ul class="collection">
			<li v-for="record in schedule" class="collection-item">
				<div>{{ record.summary }}</div>
				<div class="grey-text">{{ date(record.dtstart_array[2]) }}</div>
			</li>
		</ul>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				schedule: {},
			}
		},

		mounted() {
			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('schedule?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.schedule = res.data
				}, error => {
					M.toast({html: '「設定」よりicalファイルの登録をしてください', classes: 'red white-text'})
				})
			})
		},

		methods: {
			date(timestamp) {
				let date = new Date(timestamp * 1000);
				//let year  = date.getFullYear();
				let month = date.getMonth() + 1;
				let day  = date.getDate();
				let hour = ( date.getHours()   < 10 ) ? '0' + date.getHours()   : date.getHours();
				let min  = ( date.getMinutes() < 10 ) ? '0' + date.getMinutes() : date.getMinutes();
				return month + '月' + day + '日 ' + hour + ':' + min;
			},
		},
	}
</script>