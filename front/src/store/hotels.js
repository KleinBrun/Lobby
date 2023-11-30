import {
	changeStatusID,
	getClientsID,
	getDataBooking,
	getDataHotel,
} from '@/Services';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useHotels = defineStore('hotels', () => {
	const hotelList = ref([]);
	const selected = ref('');
	const selectedID = ref('');
	const bookingsList = ref([]);
	const clientsList = ref([]);
	const selectedBooking = ref([]);
	const nameMain = ref('');
	const docMain = ref('');
	const peopleMain = ref('');
	const arrivalMain = ref('');
	const nightsMain = ref('');
	const valueMain = ref('');
	const idEdit = ref('0');

	const setSelected = async (id, name) => {
		selectedID.value = await id;
		selected.value = await name;
	};

	const setHotels = async (hotels) => {
		hotelList.value = await hotels;
	};
	const setBookings = async () => {
		const response = await getDataBooking(selectedID.value);
		bookingsList.value = response;
	};
	const setClients = async (id) => {
		const response = await getClientsID(id);
		clientsList.value = response;
	};
	const statusCh = async (id, name, status) => {
		await changeStatusID(id, name, status);
	};

	const selectedRow = (newValue) => {
		selectedBooking.value = newValue;
	};
	const getHotelStore = async () => {
		hotelList.value = await getDataHotel();
	};
	return {
		hotelList,
		setHotels,
		selected,
		selectedID,
		setSelected,
		bookingsList,
		setBookings,
		selectedBooking,
		selectedRow,
		clientsList,
		setClients,
		nameMain,
		statusCh,
		docMain,
		peopleMain,
		arrivalMain,
		nightsMain,
		valueMain,
		idEdit,
		getHotelStore,
	};
});
