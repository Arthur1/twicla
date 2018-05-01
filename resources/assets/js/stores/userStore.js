import http from '../services/http'

export default {
	debug: true,
	state: {
		user: {},
		authenticated: false,
	},

	login(email, password, successCb = () => {}, errorCb = () => {}) {
		var login_param = {email: email, password: password}
		http.post('authenticate', login_param, res => {
			this.state.user = res.data.user
			this.state.authenticated = true
			successCb()
		}, error => {
			errorCb()
		})
	},

	logout(successCb = () => {}, errorCb = () => {}) {
		http.get('logout', () => {
			localStorage.removeItem('jwt-token')
			this.state.authenticated = false
			successCb()
		}, errorCb)
	},

	register(name, email, password, successCb = () => {}, errorCb = () => {}) {
		var register_param = {name: name, email: email, password: password}
		http.post('register', register_param, res => {
			successCb()
		}, error => {
			errorCb()
		})
	},

	setCurrentUser(successCb) {
		http.get('me', res => {
			this.state.user = res.data.user
			this.state.authenticated = true
			successCb
		}, error => {
			console.log('error')
		})
	},

	/**
	 * Init the store.
	 */
	init() {
		this.setCurrentUser()
	}
}