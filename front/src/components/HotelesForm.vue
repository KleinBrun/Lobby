<template>
	<div class="">
		<h1 class="title">Bienvenidos a Lobby PMS</h1>
		<div
			v-if="rawData && rawData.length > 0"
			class="input-group text-center">
			<select
				v-model="selectedHotel"
				class="form-select mb-3"
				id="inputGroupSelect04"
				aria-label="Example select with button addon">
				<option disabled value="">Seleccione su hotel...</option>
				<option
					v-for="(hotel, index) in rawData"
					:key="index"
					:value="hotel">
					{{ hotel.name }}
				</option>
			</select>
			<button
				@click="sendSelectedHotel"
				class="btn btn-primary"
				type="button">
				Entrar
			</button>
		</div>
		<h4 class="subtitle">Un software para todo tipo de alojamiento.</h4>
	</div>
</template>

<script>
import { useHotels } from '../store/hotels';
import router from '../router';
import { getDataHotel } from '@/Services';

export default {
	data() {
		return {
			selectedHotel: '',
			rawData: [],
		};
	},
	async created() {
		this.rawData = await getDataHotel();
	},
	methods: {
		sendSelectedHotel() {
			const store = useHotels();
			let selected = this.selectedHotel;
			store.setSelected(selected.id, selected.name);
			store.setBookings();
			if (typeof selected.id !== 'undefined') {
				router.push('/crud');
			}
		},
	},
};
</script>

<style scoped>
.title {
	font-family: Georgia, 'Times New Roman', Times, serif;
	font-size: 5em;
	text-align: center;
	margin-bottom: 3rem;
	color: #2d9596;
	margin-top: 10%;
}

.input-group {
	display: flex;
	align-items: center;
	flex-direction: column;
}

.form-select {
	max-width: 300px;
	width: 100%;
	height: 50px;
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 1rem;
}

.btn-primary {
	height: 50px;
	background-color: #2d9596;
	width: 100%;
	max-width: 300px;
}

.subtitle {
	font-size: 0.7rem;
	text-align: center;
	color: #888;
}

@media (max-width: 768px) {
	.title {
		font-size: 3em;
		margin-top: 10%;
	}
}
</style>
