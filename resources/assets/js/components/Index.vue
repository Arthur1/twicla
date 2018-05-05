<template>
	<div>
		<h1 class="light-blue-text">Next class is...</h1>
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
		<div class="center-align">
			<button class="btn btn-large waves-effect waves-light">出席</button>
			<button class="btn btn-large amber waves-effect waves-light">遅刻</button>
			<button class="btn btn-large red waves-effect waves-light">欠席</button>
		</div>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				datePick: '',
				schedule: [],
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
			}
		},

		mounted() {
			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('schedule/todayList?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.schedule = res.data
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
		},
	}
</script>