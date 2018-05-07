import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

export default new VueRouter({
	mode: 'history',

	routes: [
		{
			path: '/',
			name: 'Twicla',
			component: require('./components/Index.vue'),
		},
		{
			path: '/about',
			name: 'About',
			component: require('./components/About.vue'),
		},
		{
			path: '/login',
			name: 'ログイン',
			component: require('./components/Login.vue'),
		},
		{
			path: '/register',
			name: 'ユーザー登録',
			component: require('./components/Register.vue'),
		},
		{
			path: '/option',
			name: '設定',
			component: require('./components/Option.vue'),
		},
		{
			path: '/schedule',
			name: '講義予定',
			component: require('./components/Schedule.vue'),
		},
		{
			path: '/attendance',
			name: '出欠記録',
			component: require('./components/Attendance.vue'),
		},
	],

	scrollBehavior (to, from, savedPosition) {
		if (savedPosition) {
			return savedPosition
		} else {
			return { x: 0, y: 0 }
		}
	},
})