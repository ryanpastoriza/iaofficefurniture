require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import helper from './helper';
import Swal from 'sweetalert2';

import Categories from './components/admin/category/Categories.vue';
import Products from './components/admin/product/Products.vue';
import Inquiry from './components/admin/inquiry/Inquiry.vue';
import Company from './components/admin/company/Company.vue';

window.Swal = Swal;
const app = createApp({
	components: {
		Categories,
		Products,
		Inquiry,
		Company
	}
});

app.use(helper).use(router);
app.mount('#app');