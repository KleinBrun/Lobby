<script>
import { computed, watch, ref } from 'vue';
import { saveBooking, editBookingId } from '@/Services';
import { useHotels } from '../store/hotels';

export default {
	name: 'BookingForm',
	props: {
		dataToEdit: {
			type: Object,
			required: true,
		},
	},

	data(props) {
		const guestName = ref('');
		const guestDoc = ref('');
		const people = ref('');
		const arrivalDate = ref('');
		const nights = ref('');
		const reservationValue = ref('');
		watch(() => {
			guestName.value = props.dataToEdit.Name;
			guestDoc.value = props.dataToEdit.Doc;
			people.value = props.dataToEdit.Huespedes;
			arrivalDate.value = props.dataToEdit.Llegada;
			nights.value = props.dataToEdit.Noches;
			reservationValue.value = props.dataToEdit.Valor;
		});
		return {
			store: useHotels(),
			guestId: '',
			guestName,
			guestDoc,
			people,
			arrivalDate,
			nights,
			reservationValue,
			idEditStore: computed(() => this.store.idEdit),
			dataEdit: [computed(() => this.store.selectedBooking)],
			departureDate: '',
			guests: [{ name: '', doc: '' }],
		};
	},
	methods: {
		updateTbl() {
			this.$emit('updateTabla');
		},
		data() {
			this.$emit('data');
		},
		calculateDepartureDate() {
			console.log("🚀🕸 ~ this.arrivalDate:", this.arrivalDate)
			if (this.arrivalDate !== undefined) {
				if (this.arrivalDate.length > 1) {
					const date = new Date(this.arrivalDate);
					date.setDate(date.getDate() + parseInt(this.nights));
					this.departureDate = date.toISOString().split('T')[0];
				}
			}
		},
		addGuest() {
			this.guests.push({ name: '', doc: '' });
		},
		submitForm() {
			this.calculateDepartureDate();
			const data = {
				id_hotel: this.store.selectedID,
				name: this.guestName,
				doc: this.guestDoc,
				date_arrive: this.arrivalDate,
				date_leave: this.departureDate,
				price: this.reservationValue,
				Nights: this.nights,
				guests: this.people,
				status: 1,
			};

			let dataClients = '0';
			if (
				this.people > 1 &&
				this.guests[0].name !== '' &&
				this.guests[0].doc !== ''
			) {
				const client = this.guests.map((item) => ({
					name: item.name,
					doc: item.doc.toString(),
				}));
				dataClients = client;
			}
			saveBooking(data, dataClients);
			this.clearForm();
			this.updateTbl();
			this.updateTbl();
			this.updateTbl();
		},
		btnEditBooking() {
			this.calculateDepartureDate();
			const data = {
				id: this.idEditStore,
				id_hotel: this.store.selectedID,
				name: this.guestName,
				doc: this.guestDoc,
				date_arrive: this.arrivalDate,
				date_leave: this.departureDate,
				price: this.reservationValue,
				Nights: this.nights,
				guests: this.people,
				status: 1,
			};

			editBookingId(data);
			this.store.idEdit = '0';
			this.clearForm();
			this.updateTbl();
			this.updateTbl();
			this.updateTbl();
		},
		btnCanceledit() {
			this.store.idEdit = '0';
		},
		clearForm() {
			this.guestName = '';
			this.guestDoc = '';
			this.people = '';
			this.arrivalDate = '';
			this.nights = '';
			this.reservationValue = '';
			this.departureDate = '';
			this.guests = [{ name: '', doc: '' }];
		},
	},
};
</script>

<template>
	<hr />
	<div class="container">
		<h2 v-if="idEditStore === '0'">Formulario de Reserva</h2>
		<h2 v-if="idEditStore !== '0'">
			Actualizacion Reserva con ID : {{ idEditStore }}
		</h2>
		<form @submit.prevent="submitForm" class="row g-3">
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Nombre del huésped principal</label
				>
				<input
					value="asdsad"
					type="text"
					class="form-control"
					id="guestName"
					v-model="guestName"
					required />
			</div>
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Documento del huésped</label
				>
				<input
					type="text"
					class="form-control"
					id="guestDoc"
					v-model="guestDoc"
					required />
			</div>
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Número de personas</label
				>
				<input
					type="text"
					class="form-control"
					id="people"
					v-model="people"
					required />
			</div>
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Fecha de llegada</label
				>
				<input
					type="date"
					class="form-control"
					id="arrivalDate"
					v-model="arrivalDate"
					required />
			</div>
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Cantidad de noches</label
				>
				<input
					type="text"
					class="form-control"
					id="nights"
					v-model="nights"
					@input="calculateDepartureDate"
					required />
			</div>
			<div class="col-md-4">
				<label for="inputCity" class="form-label"
					>Valor de la reserva</label
				>
				<input
					type="text"
					class="form-control"
					id="nights"
					v-model="reservationValue"
					@input="calculateDepartureDate"
					required />
			</div>

			<div
				class="col-md-12"
				v-for="(guest, index) in guests"
				:key="index">
				<label for="guestName" class="form-label" v-if="people > 1"
					>Nombre del huésped</label
				>
				<input
					type="text"
					class="form-control"
					id="guestName"
					v-model="guest.name"
					v-if="people > 1" />
				<label for="guestDoc" class="col-md-6" v-if="people > 1"
					>Documento del huésped</label
				>
				<input
					type="text"
					class="form-control"
					id="guestDoc"
					v-model="guest.doc"
					v-if="people > 1" />
			</div>
			<button type="button" @click="addGuest" v-if="people > 1">
				Agregar huésped
			</button>
			<button
				v-if="idEditStore === '0'"
				type="submit"
				class="btn btn-primary">
				Enviar
			</button>
			<button
				v-if="idEditStore !== '0'"
				@click="btnEditBooking"
				type="button"
				class="btn btn-primary">
				Editar
			</button>
			<button
				v-if="idEditStore !== '0'"
				@click="btnCanceledit"
				type="button"
				class="btn btn-danger">
				Cancelar
			</button>
		</form>
	</div>
</template>

<style scoped>
h2 {
	color: #2d9596;
	font-family: Georgia, 'Times New Roman', Times, serif;
}
label {
	color: #265073;
	font-family: Georgia, 'Times New Roman', Times, serif;
}
input {
	font-family: Georgia, 'Times New Roman', Times, serif;
}
button {
	position: relative;
	width: 150px;
	margin-left: 50%;
}
</style>
