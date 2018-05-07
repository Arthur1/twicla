<template>
	<div>
		<h1 class="light-blue-text">Next class is...</h1>
		<pre-loader v-if="! standby"></pre-loader>
		<div v-else>
			<div class="collection">
				<div class="collection-item" v-if="Object.keys(recentSchedule).length !== 0">
					<div>{{ recentSchedule.summary }}</div>
					<div class="grey-text">
						<i class="material-icons tiny">access_time</i>
						{{ date(recentSchedule.dtstart_array[2]) }}
						{{ time(recentSchedule.dtstart_array[2]) }}～{{ time(recentSchedule.dtend_array[2]) }}
					</div>
					<div class="grey-text">
						<i class="material-icons tiny">location_city</i>
						{{ recentSchedule.location }}
					</div>
				</div>
				<div class="collection-item" v-else>
					本日の講義はすでに終了しています
				</div>
			</div>
			<div class="center-align" v-if="! isSubmitted">
				<button class="btn btn-large waves-effect waves-light" @click="sendAttendance('出席')">出席</button>
				<button class="btn btn-large amber waves-effect waves-light" @click="sendAttendance('遅刻')">遅刻</button>
				<button class="btn btn-large red waves-effect waves-light" @click="sendAttendance('欠席')">欠席</button>
			</div>
			<div v-else class="center-align">
				<button class="btn btn-large waves-effect waves-light" disabled>出席</button>
				<button class="btn btn-large waves-effect waves-light" disabled>遅刻</button>
				<button class="btn btn-large waves-effect waves-light" disabled>欠席</button>
			</div>
		</div>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				standby: false,
				schedule: [],
				submitted: [],
			}
		},

		computed: {
			recentSchedule() {
				let recentRecord = {}
				this.schedule.some((record) => {
					if (record.dtend_array[2] * 1000 > new Date().getTime()) {
						recentRecord = record
						return true
					}
				}, this)
				return recentRecord
			},

			isSubmitted() {
				let recentRecord = this.recentSchedule
				return this.submitted.indexOf(recentRecord.uid) >= 0
			},
		},

		mounted() {
			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('schedule/todayList?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.schedule = res.data
					http.get('attendance/get?user_id=' + this.$store.getters.getUser.id, {}, res => {
						res.data.forEach(record => {
							this.submitted.push(record.uid)
							this.standby = true
						}, this)
					}, error => {
						M.toast({html: 'エラーが発生しました', classes: 'red white-text'})
					})
				}, error => {
					M.toast({html: '「設定」よりicalファイルの登録をしてください', classes: 'red white-text'})
				})
			}).catch(() => {
				M.toast({html: 'ログインしてください', classes: 'red white-text'})
				this.$router.push('/login')
			})
		},

		methods: {
			date: (timestamp) => {
				let date = new Date(timestamp * 1000);
				let month = date.getMonth() + 1;
				let day  = date.getDate();
				return month + '月' + day + '日'
			},
			time: (timestamp) => {
				let date = new Date(timestamp * 1000);
				let hour = ( date.getHours()   < 10 ) ? '0' + date.getHours()   : date.getHours();
				let min  = ( date.getMinutes() < 10 ) ? '0' + date.getMinutes() : date.getMinutes();
				return hour + ':' + min;
			},
			scheduleFilter: (schedule, needle) => {
				if (Object.keys(schedule).length === 0 || needle === '') return schedule
				let pickDate = new Date(needle)
				return schedule.filter((record) => {
					let date = new Date(record.dtstart_array[2] * 1000)
					return date.getYear() === pickDate.getYear() && date.getMonth() === pickDate.getMonth() && date.getDate() === pickDate.getDate()
				})
			},

			sendAttendance(status) {
				let params = {
					class_name: this.recentSchedule.summary,
					uid: this.recentSchedule.uid,
					user_id: this.$store.getters.getUser.id,
				}
				switch (status) {
					case '出席':
						params.status = 0
						break
					case '遅刻':
						params.status = 1
						params.late_minutes = 0
						break
					case '欠席':
						params.status = 2
						break
				}
				http.post('attendance/register', params, res => {
					M.toast({html: status + '登録に成功しました', classes: 'teal white-text'})
					this.submitted.push(params.uid)
				}, error => {
					M.toast({html: status + '登録に失敗しました', classes: 'red white-text'})
				})

			},
		},
	}
</script>