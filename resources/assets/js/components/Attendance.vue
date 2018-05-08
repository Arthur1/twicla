<template>
	<div>
		<pre-loader v-if="! standby"></pre-loader>
		<table v-else class="highlight">
			<thead>
				<tr>
					<th>講義名</th>
					<th class="teal-text text-darken-1">出席</th>
					<th class="amber-text text-darken-1">遅刻</th>
					<th class="red-text text-darken-1">欠席</th>
					<th>合計</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(record, key) in countData">
					<td>{{ key }}</td>
					<td>{{ setDefault(record[0], 0) }}</td>
					<td>{{ setDefault(record[1], 0) }}</td>
					<td>{{ setDefault(record[2], 0) }}</td>
					<td>{{ setDefault(record[0], 0) + setDefault(record[1], 0) + setDefault(record[2], 0) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	import http from '../services/http'

	export default {
		data() {
			return {
				standby: false,
				countData: [],
			}
		},

		mounted() {
			this.$store.dispatch('setCurrentUser').then(() => {
				http.get('attendance/count?user_id=' + this.$store.getters.getUser.id, {}, res => {
					this.countData = res.data
					this.standby = true
				}, error => {
					M.toast({html: 'エラーが発生しました', classes: 'red white-text'})
					this.standby = true
				})
			}).catch(() => {
				M.toast({html: 'ログインしてください', classes: 'red white-text'})
				this.$router.push('/login')
			})
		},

		methods: {
			setDefault(value, defaultValue = null) {
				if (typeof value == 'undefined') {
					return defaultValue
				} else {
					return value
				}
			},
		},
	}
</script>