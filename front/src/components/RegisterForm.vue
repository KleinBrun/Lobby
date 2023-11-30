<template>
	<form @submit.prevent="submitForm" class="form-container container">
		<h1 class="text-center mb-4">Bienvenidos</h1>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="name">Nombre Del Hotel:</label>
				<input
					id="name"
					v-model="name"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="email">Direccion:</label>
				<input
					id="email"
					v-model="adress"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="password">Pais:</label>
				<input
					id="password"
					v-model="country"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="password">Estado/Departamento:</label>
				<input
					id="password"
					v-model="depto"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="password">Ciudad/Municipio:</label>
				<input
					id="password"
					v-model="city"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="password">NIT:</label>
				<input
					id="password"
					v-model="nit"
					type="text"
					class="form-control"
					required />
			</div>

			<div class="form-group col-md-6">
				<label for="password">Teléfono:</label>
				<input
					id="password"
					v-model="phone"
					type="text"
					class="form-control" />
			</div>
		</div>

		<div class="form-group col-md-12">
			<button type="submit" class="btn btn-primary btn-block">
				Registrarse
			</button>
		</div>
	</form>
</template>

<script>
import { ref } from 'vue';
import { saveHotel } from '../Services';

export default {
	data() {
		return {
			name: ref(''),
			adress: ref(''),
			country: ref(''),
			depto: ref(''),
			city: ref(''),
			nit: ref(''),
			phone: ref(''),
		};
	},
	methods: {
		submitForm() {
			const data = {
				name: this.name,
				adress: this.adress,
				country: this.country,
				depto: this.depto,
				city: this.city,
				nit: this.nit,
				phone: this.phone || 0,
			};
			saveHotel(data);
		},
	},
};
</script>

<style scoped>
.form-container {
	font-family: Georgia, 'Times New Roman', Times, serif;
	max-width: 800px;
	margin: 0 auto;
	padding: 20px;
	color: #2d9596;
}

label {
	color: #265073;
	display: block;
	margin-bottom: 0.5rem;
	margin-left: 13rem;
}

input {
	width: 90%;
	padding: 0.5rem;
	margin-bottom: 0rem;
	margin-left: 13rem;
}

button {
	margin-top: 20px;
	padding: 0.5rem 1rem;
	background-color: #2d9596;
	color: #fff;
	border: none;
	cursor: pointer;
	margin-left: 20rem;
}

button:hover {
	background-color: #265073;
}

/* Media queries */
@media (max-width: 768px) {
	.form-container {
		padding: 10px;
	}

	label,
	input {
		margin-left: 0;
	}

	button {
		margin-left: 0;
	}
}
</style>
