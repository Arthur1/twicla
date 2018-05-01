import http from '../services/http'

export default {
	state: {
		user: {},
		authenticated: false,
	},

	mutations: {
		login(state, user) {
			state.authenticated = true
			state.user = user
		},

		logout(state) {
			state.authenticated = false
			state.user = {}
		},
	},

	actions: {
		login({commit}, login_params) {
			return new Promise((resolve, reject) => {
				http.post('authenticate', login_params, res => {
					commit('login', res.data.user)
					resolve()
				}, error => {
					reject()
				})
			})
		},

		logout({commit}) {
			return new Promise((resolve, reject) => {
				http.get('logout', {}, () => {
					localStorage.removeItem('jwt-token')
					commit('logout')
					resolve()
				}, error => {
					reject()
				})
			})
		},

		register({commit}, register_params) {
			return new Promise((resolve, reject) => {
				http.post('register', register_params, res => {
					resolve()
				}, error => {
					reject()
				})
			})
		},

		setCurrentUser({commit}) {
			return new Promise((resolve, reject) => {
				http.get('me', {}, res => {
					commit('login', res.data.user)
					resolve()
				}, error => {
					reject()
				})
			})
		},
	},

	getters: {
		isAuthenticated: state => {
			return state.authenticated
		},

		getUser: state => {
			return state.user
		},
	},
}