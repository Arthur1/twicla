import http from '../services/http'

export default {
	debug: true,
	state: {
		user: {},
		authenticated: false,
	},

	login(email, password, successCb = null, errorCb = null) {
		var login_param = {email: email, password: password}
		http.post('authenticate', login_param, res => {
			this.state.user = res.data.user
			this.state.authenticated = true
			successCb()
		}, error => {
			errorCb()
		})
	},

	logout(successCb = null, errorCb = null) {
		http.get('logout', () => {
			localStorage.removeItem('jwt-token')
			this.state.authenticated = false
			successCb()
		}, errorCb)
	},

	register(name, email, password, successCb = null, errorCb = null) {
		var register_param = {name: name, email: email, password: password}
		http.post('register', register_param, res => {
			successCb()
		}, error => {
			errorCb()
		})
	},

	setCurrentUser() {
		http.get('me', res => {
			this.state.user = res.data.user
			this.state.authenticated = true
		})
	},

	/**
	 * Init the store.
	 */
	init() {
		this.setCurrentUser()
	}
}