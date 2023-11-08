<template>
<div class="col-12 mb-3">
	<div v-if="showForm">
		<button type="button" class="btn btn-light rounded-0" @click="backToList">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>Back to Product List
		</button>
	</div>
	<div v-else>
		<button type="button" class="btn btn-primary rounded-0" @click="showForm = true">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus align-middle me-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Add New Product
		</button>
	</div>
</div>

<div class="col-12">
	<div v-if="showForm">
		<productcreate ref="productForm" :identifier="identifier"></productcreate>
	</div>

	<div v-else>
		<productlist ref="productTable" @edit-product="display"></productlist>
	</div>
	
</div>

<div class="col-12">
	
</div>

</template>

<script>
	
	import Productlist from './Productlist';
    import Productcreate from './Productcreate';
    import { ref, readonly } from 'vue';

    export default {

    	components: {
            Productlist,
            Productcreate
        },

          data() {
            return {
            	showForm: false,
            	identifier: 0,
            }
        },

        methods: {

        	display(id) {
        		this.identifier = id;
        		this.showForm = true;
        	},

        	backToList() {
        		this.identifier = 0;
        		this.showForm = false;
        	},

        	newProduct() {
        		this.identifier = 0;
        		this.showForm = true;
        	}

        },
    }
</script>