<template>

	<div class="col-12 mb-3 d-flex align-items-start flex-column">
		<router-link :to="{ name: 'products' }" class="link-secondary text-decoration-none">
			<i class="align-middle" data-feather="arrow-left"></i> Back to Product List
		</router-link>
		<h1 class="p-0 m-0 text-body fw-bold">Edit Product</h1>
	</div>

	<form @submit.prevent="update" enctype="multipart/form-data">
	<div class="row">

		<div class="col-12 mb-3">
			<div class="d-flex justify-content-end">
				<button type="submit" class="btn btn-primary">Save Changes</button>
			</div>
		</div>

		<div class="col-6 d-flex flex-column">

			<div class="card border">
				<div class="card-header border-bottom">
					<h5 class="card-title mb-0 text-body">Basic Information</h5>
				</div>
				<div class="card-body">
					<div class="row">

						<div class="col-12 text-body">

							<div class="mb-3">
								<label class="form-label fw-semibold"> Product Model / Code</label>
								<input class="form-control form-control-lg text-uppercase" type="text" v-model="product.product_code" required/>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold"> Product Title / Name </label>
								<input class="form-control form-control-lg text-capitalize" type="text" v-model="product.product_name" required/>
							</div>

							<div class="mb-3 d-flex flex-row gap-2 justify-content-evenly">

								<div class="w-50">
									<label class="form-label fw-semibold">Category</label>
									 <Select2 
									 v-model="selectedValue" 
									 :options="options" 
									 :settings="{ placeholder : 'Select Category',  allowClear: true }" 
									 @select="onChangeCategory($event)" required />
								</div>

								<div class="w-25">
									<label class="form-label fw-semibold">On Demand</label>
									<select class="form-select form-select-lg" v-model="product.on_demand" required>
										<option value="0" selected>No</option>
										<option value="1">Yes</option>
									</select>
								</div>

								<div class="w-25">
									<label class="form-label fw-semibold">Price</label>
									<input class="form-control form-control-lg" type="number" v-model="product.price" :disabled="product.on_demand == 1" placeholder="0.00" />
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Product Description</label>
								<textarea class="form-control text-capitalize" rows="3" v-model="product.product_description"></textarea>
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold"> Slug</label>
								<input class="form-control form-control-lg" type="text" v-model="product.slug" disabled/>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="card border">
				<div class="card-header border-bottom">
					<h5 class="card-title mb-0 text-body">Product Specifications</h5>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-12">

							<div class="mb-3 mt-3">
								<label class="form-label fw-semibold">Dimension</label>
								<input class="form-control form-control-lg" type="text" v-model="product.dimension" />
							</div>

							<div class="mb-3 mt-3">
								<label class="form-label fw-semibold">Color</label>
								<input class="form-control form-control-lg" type="text" v-model="product.color" />
							</div>

							<div class="mb-3">
								<label class="form-label fw-semibold">Materials</label>
								<textarea class="form-control form-control-lg" rows="3" v-model="product.materials"></textarea>
							</div>

						</div>
					</div>

				</div>
			</div>
			

		</div>

		<div class="col-6 d-flex flex-column">

			<div class="card border">
				<div class="card-header border-bottom">
					<h5 class="card-title mb-0 text-body">Product Visibility</h5>
				</div>
				<div class="card-body">
					<div class="row d-flex">

						<div class="mb-3 d-flex justify-content-between">
							
							<div class="">
								<label class="form-label fw-semibold">Status</label>
							</div>


							<div class="">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" v-model="product.status">
								</div>
							</div>

						</div>

						<div class="d-flex justify-content-between">
							
							<div class="">
								<label class="form-label fw-semibold">Featured</label>
							</div>


							<div class="">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" v-model="product.featured">
								</div>
							</div>

						</div>
						

					</div>
				</div>
			</div>

			<div class="card border">
				<div class="card-header border-bottom">
					<h5 class="card-title mb-0 text-body">Product Images</h5>
				</div>
				<div class="card-body">
					<div class="row d-flex">

						<div class="col-12 px-3">
							<div class="media">

								<div class="thumbnail">
									<ImageUpload :placeholder="thumbnail" v-model="image_featured"/>
								</div>

								<div class="thumbnail">
									<ImageUpload :placeholder="thumbnail" v-model="image_1"/>
								</div>

								<div class="thumbnail">
									<ImageUpload :placeholder="thumbnail" v-model="image_2"/>
								</div>

								<div class="thumbnail">
									<ImageUpload :placeholder="thumbnail" v-model="image_3"/>
								</div>
								
							</div>

						</div>

					</div>
				</div>
			</div>
		</div>
		
	</div>
	</form>
	
</template>

<script>

import ImageUpload from '../extra/ImageUpload.vue';
import Select2 from 'vue3-select2-component';

export default {

	components: {
		Select2,
		ImageUpload
	},

	props: {
        id: {
            required: true,
            type: String
        }
    },

	data() {
	    return {
	    	options: [],
	    	selectedValue: [],
	    	product: {
	  			product_id: 0,
				category: [],
				price: '0.00',
				on_demand: 0,
				product_code: null,
				product_name: null,
				product_description: null,
				dimension: null,
				materials: null,
				color: null,
				status: null,
				slug: null,
				featured: false
	  		},
	  		thumbnail: null,
	  		image_featured: null,
	  		image_1: null,
	  		image_2: null,
	  		image_3: null
	    }
	},

	methods: {

		async fetchCategories() {
			await axios.get(this.baseUrl() + 'api/category').then((response) => {
				let data = response.data.data;
	            data.forEach((item, index) => {
				  this.options.push({
				  	id : item.category_id,
				  	text : this.titleCase(item.name)
				  });
				});
	        });
		},

		update() {

		if( this.product.product_id ) {

				var formData = new FormData();
				formData.append('_method', 'put');
				formData.append('category_id', this.product.category.category_id);
				formData.append('product_code', this.product.product_code);
				formData.append('product_name', this.product.product_name);
				formData.append('product_description', this.product.product_description);
				formData.append('dimension', this.product.dimension);
				formData.append('materials', this.product.materials);
				formData.append('color', this.product.color);
				formData.append('slug', this.product.slug);
				formData.append('featuredimg', this.image_featured);
				formData.append('image_1', this.image_1);
				formData.append('image_2', this.image_2);
				formData.append('image_3', this.image_3);
				formData.append('on_demand', this.product.on_demand);

				if( this.product.on_demand == 1 ) {
					this.product.price = 0;
				}

				formData.append('price', parseFloat(this.product.price));

				formData.append('featured', (this.product.featured) ? 1 : 0 );
				formData.append('status', (this.product.status) ? 1 : 0 );

				axios.post(this.baseUrl() + 'api/product/' + this.product.product_id, formData)
		          .then((response) => {
		          	console.log(response.data.data);
		    		Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: response.data.message,
					  showConfirmButton: false,
					  timer: 1500,
					  toast: true,
					});
		        });

			}
		},

		async fill() {

			await axios.get(this.baseUrl() + 'api/product/' + this.id).then((response) => {
					// console.log(response.data.data);
	            this.product = response.data.data;
	            this.product.status = ( this.product.status) ? true : false;
	            this.product.featured = ( this.product.featured) ? true : false;
	            this.product.price = this.product.price.toFixed(2);
	   //          this.product.dimension =  
				// this.product.materials =  
				// this.product.color =  
	            this.image_featured = this.baseUrl() + this.product.directory.images + this.product.featured_image;
	            this.image_1 = this.baseUrl() + this.product.directory.images + 'image_1.jpg';
	            this.image_2 = this.baseUrl() + this.product.directory.images + 'image_2.jpg';
	            this.image_3 = this.baseUrl() + this.product.directory.images + 'image_3.jpg';
	          
	            this.selectedValue = [this.product.category.category_id, this.product.category.name];
	        });
	        
		},

		onChangeCategory({id, text}){
			this.product.category.category_id = id ;
			this.product.category.name = text;
        }

	},

	mounted() {
		this.fetchCategories();
		feather.replace();
		this.thumbnail = this.baseUrl() + 'img/image-placeholder.webp';
		this.fill();
	}
};
</script>

<style>
.media {
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
	justify-content: flex-start;
	gap: 20px;
	padding: 10px;
	/*border: 2px dashed #555;*/
	/*border-radius: 10px;*/
}

.media .thumbnail {
	max-height: 150px;
	max-width: 150px;
}

.media .thumbnail + .thumbnail {
	max-height: 150px;
	max-width: 150px;
}

textarea {
	resize: none;
}

.select2-container .select2-selection--single {
    height: 35px!important;
 }

.select2-container--default .select2-selection--single .select2-selection__arrow {
	 height: 33px!important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
	line-height: 35px!important;
}

.select2-search--dropdown .select2-search__field {
	outline: 0;
}

</style>