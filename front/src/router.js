import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [
	{
		path: '/register',
		component: () => import('./components/RegisterForm.vue'),
	},
	{
		path: '/',
		component: () => import('./components/HotelesForm.vue'),
	},
	{
		path: '/crud',
		component: () => import('./components/CrudForm.vue'),
	},
];
const router = createRouter({
	history: createWebHashHistory(),
	routes,
});

export default router;