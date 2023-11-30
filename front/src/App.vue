<template>
	<div id="app">
		<NavBar></NavBar>
		<br /><br /><br /><br />
		<router-view></router-view>
	</div>
</template>

<script>
import { useHotels } from './store/hotels';
import NavBar from './components/NavBar.vue';
import router from './router';

export default {
	components: {
		NavBar,
	},
	data() {
		return {};
	},
	methods: {},
	async created() {
		const store = useHotels();
		await store.getHotelStore();
		if (store.hotelList.length === 0) {
			router.push('/register');
		} else {
			router.push('/');
		}
	},
	mounted() {
		document.title = 'Hoteles Lobby';
	},
};
</script>

<style>
#app {
	background-color: #f9fcf1;
	min-height: 100vh;
	display: flex;
	flex-direction: column;
}

@media (max-width: 200px) {
	/* Styles for screens smaller than 768px */
	#app {
		padding: 20px;
	}
}

@media (min-width: 769px) {
	/* Styles for screens larger than 768px */
	#app {
		padding: 40px;
	}
}
</style>
