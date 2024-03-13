
import { createRouter, createWebHistory } from 'vue-router';

import Categories from '../components/admin/category/Categories.vue';
import CategoryCreate from '../components/admin/category/CategoryCreate.vue';
import CategoryEdit from '../components/admin/category/CategoryEdit.vue';

import Products from '../components/admin/product/Products.vue';
import ProductCreate from '../components/admin/product/ProductCreate.vue';
import ProductEdit from '../components/admin/product/ProductEdit.vue';

const routes = [
    {
        path: '/admin/category',
        name: 'category',
        component: Categories
    },{
        path: '/admin/category/create',
        name: 'category.create',
        component: CategoryCreate
    },{
        path: '/admin/category/edit/:id',
        name: 'category.edit',
        component: CategoryEdit,
        props: true
    },{
    	path: '/admin/product',
        name: 'products',
        component: Products
    },{
    	path: '/admin/product/create',
        name: 'product.create',
        component: ProductCreate
    },{
    	path: '/admin/product/edit/:id',
        name: 'product.edit',
        component: ProductEdit,
        props: true
    }
];


const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;