<template>
	<nav
		class="navbar navbar-expand-lg fixed-top bg-light navbar-light"
		id="head">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img
					id="MDB-logo"
					src="lobby.png"
					alt="MDB Logo"
					draggable="false"
					height="30" />
			</a>
			<button
				class="navbar-toggler"
				type="button"
				data-mdb-toggle="collapse"
				data-mdb-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto align-items-center">
					<li class="nav-item">
						<a class="nav-link mx-2" href="/">
							<i class="fas fa-bell pe-2"></i>
							<router-link class="link" to="/">Home</router-link>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mx-2" href="/">
							<i class="fas fa-bell pe-2"></i>
							<router-link class="link" to="/register"
								>Registra tu Hotel</router-link
							>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<style scoped>
.navbar {
	background-color: #333;
}

.navbar-brand img {
	height: 40px;
}

.navbar a {
	color: rgb(0, 0, 0);
}
.navbar .router-link-active {
	color: rgb(0, 0, 0);
}
.navbar .router-link-active::after {
	content: '';
	display: block;
	width: 100%;
	height: 3px;
	border-radius: 3px;
}
.navbar-nav {
	margin-left: auto;
}
.navbar-nav .nav-item {
	margin: 0 10px;
}
.navbar-nav .nav-link {
	padding: 10px 15px;
}
.navbar-nav .nav-link:hover {
	background-color: #2d9596;
	border-radius: 15px;
	color: white;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
	transform: scale(0.9);
	transition: all 0.1s ease-in-out;
}
.link {
	font-family: Georgia, 'Times New Roman', Times, serif;
	font-weight: bolder;
	text-decoration: none;
}
.subtitle {
	font-size: 0.7rem;
	text-align: center;
	color: #888;
}
@media (max-width: 768px) {
	.navbar-nav {
		flex-direction: column;
		align-items: center;
	}

	.navbar-nav .nav-item {
		margin: 10px 0;
	}

	.navbar-nav .nav-link {
		padding: 10px;
	}
}
@media (max-width: 576px) {
	.navbar-brand img {
		height: 30px;
	}
}
</style>
