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
				//console.log(login_params)
				//console.log(commit)
				http.post('authenticate', login_params, res => {
					commit('login', res.data.user)
					resolve()
				}, error => {
					console.log('Login Error')
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
					console.log('Logout Error')
					reject()
				})
			})
		},

		register({commit}, register_params) {
			return new Promise((resolve, reject) => {
				http.post('register', register_params, res => {
					resolve()
				}, error => {
					console.log('Register Error')
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
					console.log('set current user error')
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