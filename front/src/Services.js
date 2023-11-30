import axios from 'axios';
import router from './router';
// import { useHotels } from './store/hotels';
// const store = useHotels();
const endpoint = 'http://127.0.0.1:8000/api';
export const getDataHotel = async () => {
	try {
		let url = endpoint + '/hotels/';
		const response = await axios.get(url);
		console.log("🚀🕸 ~ response:", response.data.hotels)
		return response.data.hotels;
	} catch (error) {
		alert(error);
	}
};

export const saveHotel = async (data) => {
	try {
		let url = endpoint + '/hotels/';
		const response = await axios.post(url, { data });
		if (response.status == 200) {
			router.push('/');
		} 
	} catch (error) {
		alert(error);
	}
};

export const getDataBooking = async (id) => {
	try {
		let url = endpoint + '/bookings/' + id;
		const response = await axios.get(url);
		return response.data.booking || [];
	} catch (error) {
		alert(error);
	}
};

export const saveBooking = async (data, dataClient) => {
	try {
		let url = endpoint + '/bookings/';
		await axios.post(url, { data, dataClient });
	} catch (error) {
		alert(error);
	}
};
export const editBookingId = async (data) => {
	try {
		let url = endpoint + '/bookings/update';
		await axios.post(url, { data });
	} catch (error) {
		alert(error);
	}
};

export const getClientsID = async (id) => {
	try {
		let url = endpoint + '/clients/' + id;
		const response = await axios.get(url);
		return response.data.clients || [];
	} catch (error) {
		alert(error);
	}
};
export const changeStatusID = async (id, name, status) => {
	try {
		let url = endpoint + '/bookings/' + id + '/' + name + '/' + status;
		await axios.get(url);
	} catch (error) {
		alert(error);
	}
};
