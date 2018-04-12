<style scoped>
#user-icon {

}
#user-icon-initial {
	display: block;
	text-align: center;
	font-size: 2.0em;
	line-height: 60px;
	width: 100%;
	height: 100%;
}
</style>
<template>
	<div>
		<ul class="sidenav" id="slide-out">
			<li v-if="userState.authenticated">
				<div class="user-view">
					<div class="background">
						<img src="/img/menu-bg.jpg" style="width: 100%;">
					</div>
					<div class="circle pink lighten-2 white-text" id="user-cion">
						<span id="user-icon-initial">{{ userState.user.name.slice(0, 1).toUpperCase() }}</span>
					</div>
					<span class="white-text name">{{ userState.user.name }}</span>
					<span class="white-text email">{{ userState.user.email }}</span>
				</div>
			</li>
			<li><router-link class="sidenav-close" to="/">Top</router-link></li>
			<li><router-link class="sidenav-close" to="/about">About</router-link></li>
			<li v-if="userState.authenticated">{{ userState.user.name }}</li>
			<li v-else><router-link class="sidenav-close" to="/login">ログイン</router-link></li>
		</ul>
		<header class="navbar-fixed">
			<nav>
				<div class="nav-wrapper light-blue">
					<a href="/" class="left hide-on-med-and-down brand-logo">twicla</a>
					<a href="" class="hide-on-large-only" style="font-size: 1.2em;">twicla</a>
					<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><router-link class="sidenav-close" to="/">Top</router-link></li>
						<li><router-link class="sidenav-close" to="/about">About</router-link></li>
						<li v-if="userState.authenticated">{{ userState.user.name }}</li>
						<li v-else><router-link class="sidenav-close" to="/login">ログイン</router-link></li>
					</ul>
				</div>
			</nav>
		</header>
	</div>
</template>
<script>
import userStore from '../stores/userStore'

export default {
	data() {
		return {
			userState: userStore.state
		}
	}
}
</script>