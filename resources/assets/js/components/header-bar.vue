<template>
	<div>
		<ul class="sidenav" id="slide-out">
			<li><router-link class="sidenav-close" to="/">Top</router-link></li>
			<li><router-link class="sidenav-close" to="/about">About</router-link></li>
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
					</ul>
				</div>
			</nav>
		</header>
	</div>
</template>