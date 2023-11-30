<template>
	<div class="container">
		<ModalForm v-show="isModalVisible" @close="closeModal" />

		<div class="mb-3">
			<label class="h2 text-primary"> Hotel: {{ store.selected }} </label>
		</div>

		<div class="row mb-3">
			<div class="col-md-3">
				<input
					v-model="idFilter"
					placeholder="Filtrar por ID"
					class="form-control" />
			</div>
			<div class="col-md-3">
				<input
					v-model="nameFilter"
					placeholder="Filtrar por Nombre"
					class="form-control" />
			</div>
			<div class="col-md-3">
				<input
					v-model="docFilter"
					placeholder="Filtrar por Documento"
					class="form-control" />
			</div>
			<div class="col-md-3">
				<input
					v-model="llegadaFilter"
					placeholder="Filtrar por Fecha de Llegada"
					class="form-control" />
			</div>
		</div>
		<label id="tablename">Tabla de Reservas</label>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Documento</th>
					<th>Llegada</th>
					<th>Salida</th>
					<th>Valor</th>
					<th>Noches</th>
					<th>Huespedes</th>
					<th>Estado</th>
					<th>Editar</th>
					<th>Cancelar</th>
					<th>Accion</th>
					<th>Ver</th>
				</tr>
			</thead>
			<tbody :key="store.selectedID">
				<tr v-for="booking in filteredBookings" :key="booking.ID">
					<td>{{ booking.ID }}</td>
					<td>{{ booking.Name }}</td>
					<td>{{ booking.Doc }}</td>
					<td>{{ booking.Llegada }}</td>
					<td>{{ booking.Salida }}</td>
					<td>{{ formatearValorColombiano(booking.Valor) }}</td>
					<td>{{ booking.Noches }}</td>
					<td>{{ booking.Huespedes }}</td>
					<td :class="estadoClass(booking.Estado)">
						{{ estadoClass(booking.Estado) }}
					</td>
					<td>
						<button
							@click="editBooking(booking)"
							class="btn btn-warning btn-sm">
							Editar
						</button>
					</td>
					<td>
						<button
							@click="cancelBooking(booking, 'status', '3')"
							class="btn btn-danger btn-sm">
							Cancelar
						</button>
					</td>
					<td v-if="booking.Estado === '1'">
						<button
							@click="confirmBooking(booking, 'status', '2')"
							class="btn btn-success btn-sm">
							Confirmar
						</button>
					</td>
					<td v-if="booking.Estado !== '1'">
						<button
							@click="provBooking(booking, 'status', '1')"
							class="btn btn-primary btn-sm">
							Provisional
						</button>
					</td>
					<td>
						<button
							@click="showModal(booking)"
							class="btn btn-info btn-sm">
							Ver
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<BookingsFrom @updateTabla="updateTabla" :dataToEdit="dataToEdit" />
	</div>
</template>

<script>
import { useHotels } from '../store/hotels';
import BookingsFrom from './BookingsFrom.vue';
import ModalForm from './ModalForm.vue';

export default {
	components: {
		BookingsFrom,
		ModalForm,
	},
	data() {
		return {
			store: useHotels(),
			idFilter: '',
			llegadaFilter: '',
			nameFilter: '',
			docFilter: '',
			bookings: [],
			dataToEdit: '',
			isModalVisible: false,
		};
	},
	computed: {
		filteredBookings() {
			return this.bookings.filter(
				(booking) =>
					(booking.ID.includes(this.idFilter) ||
						this.idFilter === '') &&
					(booking.Name.includes(this.nameFilter) ||
						this.nameFilter === '') &&
					(booking.Llegada.includes(this.llegadaFilter) ||
						this.llegadaFilter === '') &&
					(booking.Doc.includes(this.docFilter) ||
						this.docFilter === '')
			);
		},
	},
	methods: {
		updateTable() {
			this.$emit('close');
		},
		estadoClass(estado) {
			switch (estado) {
				case '1':
					return 'provisional';
				case '2':
					return 'confirmada';
				case '3':
					return 'cancelada';
				default:
					return '';
			}
		},
		closeModal() {
			this.isModalVisible = false;
		},
		showModal(data) {
			this.store.setClients(data['ID']);
			this.store.selectedRow(data);
			this.isModalVisible = true;
		},
		editBooking(data) {
			this.dataToEdit = data;
			this.store.idEdit = data.ID;
		},
		cancelBooking(data, name, status) {
			this.store.statusCh(data.ID, name, status);
			data.Estado = '3';
		},
		data() {
			return this.store.selectedBooking;
		},
		provBooking(data, name, status) {
			this.store.statusCh(data.ID, name, status);
			data.Estado = '1';
		},
		confirmBooking(data, name, status) {
			this.store.statusCh(data.ID, name, status);
			data.Estado = '2';
		},
		async getBookingData() {
			await this.store.setBookings();
			this.bookings = this.store.bookingsList?.map((item) => ({
				ID: item.id.toString(),
				Name: item.name,
				Doc: item.doc,
				Llegada: item.date_arrive,
				Salida: item.date_leave,
				Valor: item.price,
				Noches: item.Nights,
				Huespedes: item.guests,
				Estado: item.status,
			}));
			this.bookings.sort((a, b) => b.ID - a.ID);
		},
		formatearValorColombiano(valor) {
			let formatter = new Intl.NumberFormat('es-CO', {
				style: 'currency',
				currency: 'COP',
				minimumFractionDigits: 0,
			});

			return formatter.format(valor);
		},
		async updateTabla() {
			await this.store.setBookings();
			this.bookings = this.store.bookingsList?.map((item) => ({
				ID: item.id.toString(),
				Name: item.name,
				Doc: item.doc,
				Llegada: item.date_arrive,
				Salida: item.date_leave,
				Valor: item.price,
				Noches: item.Nights,
				Huespedes: item.guests,
				Estado: item.status,
			}));
			this.bookings.sort((a, b) => b.ID - a.ID);
		},
	},
	created() {
		this.getBookingData();
	},
};
</script>

<style scoped>
label {
	font-size: 50px;
	font-family: Georgia, 'Times New Roman', Times, serif;
	font-weight: bolder;
}
input {
	font-family: Georgia, 'Times New Roman', Times, serif;
}
#tablename {
	color: #2d9596;
	font-family: Georgia, 'Times New Roman', Times, serif;
	font-weight: bolder;
	font-size: 20px;
}
</style>
