<script>
import { useHotels } from '../store/hotels.js';

export default {
	name: 'HotelModal',
	data() {
		const store = useHotels();
		store.setClients(store.selectedBooking['ID']);
		return {
			store,
		};
	},
	methods: {
		close() {
			this.$emit('close');
		},
		estadoClass(estado) {
			switch (estado) {
				case '1':
					return 'PROVISIONAL';
				case '2':
					return 'CONFIRMADA';
				case '3':
					return 'CANCELADA';
				default:
					return '';
			}
		},
		formatearValorColombiano(valor) {
			let formatter = new Intl.NumberFormat('es-CO', {
				style: 'currency',
				currency: 'COP',
				minimumFractionDigits: 0,
			});

			return formatter.format(valor);
		},
	},
};
</script>

<template>
	<div class="modal-backdrop">
		<div class="modal">
			<header class="modal-header">
				<slot name="header"
					>Reserva En Hotel {{ store.selected }} N°
					{{ store.selectedBooking['ID'] }}</slot
				>
				<br />
				<button type="button" class="btn-close" @click="close">
					x
				</button>
			</header>

			<section class="modal-body">
				<slot name="body" id="name">
					<label>Nombre: </label
					>{{ store.selectedBooking['Name'] }} </slot
				>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<slot name="body"
					><label>Documento: </label
					>{{ store.selectedBooking['Doc'] }} </slot
				><br />
				<slot name="body"
					><label>Hora LLegada: </label
					>{{ store.selectedBooking['Llegada'] }} </slot
				>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<slot name="body"
					><label>Hora Salida: </label
					>{{ store.selectedBooking['Salida'] }} </slot
				><br />
				<slot name="body"
					><label>Precio: </label
					>{{ formatearValorColombiano(store.selectedBooking['Valor']) }} </slot
				><br />
				<slot name="body"
					><label>Numero de Noches: </label
					>{{ store.selectedBooking['Noches'] }} </slot
				><br />
				<slot name="body"
					><label>Huespedes: </label
					>{{ store.selectedBooking['Huespedes'] }} </slot
				><br />
				<slot name="body"
					><label>Estatus: </label
					>{{ estadoClass(store.selectedBooking['Estado']) }}
				</slot>
			</section>
			<table>
				<tr>
					<th>Nombre</th>
					<th>Documento</th>
				</tr>
				<tr v-for="(client, index) in store.clientsList" :key="index">
					<td>{{ client.name }}</td>
					<td>{{ client.doc }}</td>
				</tr>
			</table>

			<footer class="modal-footer">
				<button type="button" class="btn-green" @click="close">
					Cerrar
				</button>
			</footer>
		</div>
	</div>
</template>

<style scoped>
.modal-backdrop {
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background-color: rgba(0, 0, 0, 0.3);
	display: flex;
	justify-content: center;
	align-items: center;
}

.modal {
	background: #f9fcf1;
	box-shadow: 2px 2px 20px 1px;
	overflow-x: auto;
	display: flex;
	flex-direction: column;
	width: 80%;
	height: 80%;
	max-width: 800px;
	max-height: 600px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.modal-header,
.modal-footer {
	padding: 15px;
	display: flex;
}

.modal-header {
	font-size: 30px;
	font-weight: bolder;
	position: relative;
	border-bottom: 1px solid #2d9596;
	color: #2d9596;
	justify-content: space-between;
}

.modal-footer {
	border-top: 1px solid #2d9596;
	flex-direction: column;
	justify-content: flex-end;
}

.modal-body {
	font-size: 30px;
	position: relative;
	padding: 20px 10px;
}

.btn-close {
	position: absolute;
	top: 0;
	right: 0;
	border: none;
	font-size: 20px;
	padding: 10px;
	cursor: pointer;
	font-weight: bold;
	color: #4aae9b;
	background: transparent;
}

.btn-green {
	color: #ecf4d6;
	background: #2d9596;
	border: 1px solid #2d9596;
	border-radius: 2px;
}
table {
	color: #2d9596;
}
label {
	margin-top: -10px;
	color: #2d9596;
}
</style>
