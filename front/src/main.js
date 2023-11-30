import 'bootstrap/dist/css/bootstrap.css';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router';
import App from './App.vue';
import { useHotels } from './store/hotels';

const pinia = createPinia();
const app = createApp(App);
async function inital() {
    app.use(pinia);
	app.use(router);
	app.mount('#app');
    const store = useHotels();
    await store.getHotelStore();
}
inital();
