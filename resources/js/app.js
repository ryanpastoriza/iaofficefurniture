require('./bootstrap');

import { createApp } from 'vue';
import helper from './helper';
import Swal from 'sweetalert2';
import Category from './components/admin/category/Category.vue';
import Product from './components/admin/product/Product.vue';
import Inquiry from './components/admin/inquiry/Inquiry.vue';

window.Swal = Swal;
const app = createApp({
	components: {
		Category,
		Product,
		Inquiry
	}
});


app.use(helper);
app.mount('#app');
