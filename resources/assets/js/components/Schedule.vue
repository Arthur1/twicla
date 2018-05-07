<template>
	<div>
		<div class="row">
			<div class="col s12 input-field">
				<input type="text" class="datepicker" id="form_date" name="date">
				<label for="form_date">日時</label>
			</div>
		</div>
		<pre-loader v-if="! standby"></pre-loader>
		<ul v-else class="collection">
			<li v-for="record in scheduleFilter(schedule, datePick)" class="collection-item">
				<div>{{ record.summary }}</div>
				<div class="grey-text">
					<i class="material-icons tiny">access_time</i>
					{{ date(record.dtstart_array[2]) }}
					{{ time(record.dtstart_array[2]) }}～{{ time(record.dtend_array[2]) }}
				</div>
				<div class="grey-text">
					<i class="material-icons tiny">location_city</i>
					{{ record.location }}
				</div>
			</li>
		</ul>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				standby: false,
				datePick: '',
				schedule: [],
			}
		},

		mounted() {
			// initialize datepicker
			let el = document.getElementById('form_date')
			let option = {
				format: 'mmm d, yyyy',
			}
			let instance = M.Datepicker.init(el, option)
			el.onchange = () => {
				this.datePick = el.value
			}

			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('schedule/list?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.schedule = res.data
					this.standby = true
				}, error => {
					M.toast({html: '「設定」よりicalファイルの登録をしてください', classes: 'red white-text'})
					this.standby = true
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