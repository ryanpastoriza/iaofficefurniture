<template>
	<div class="card">
		<div class="card-header pb-0">
			<h5 class="card-title mb-0">{{ action }}</h5>
			<p class="form-text mb-0 text-danger">Fields with asterisks(*) are required.</p>
		</div>
		<div class="card-body pt-0">

			<div v-if="isEditing">
				<form @submit.prevent="update" enctype="multipart/form-data">
					<div class="row">
						
						<div class="col-12 col-lg-4">
							<div class="mb-3">
								<label class="form-label">Code <span class="required">*</span></label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.product_code" required/>
							</div>
							<div class="mb-3">
								<label class="form-label">Name <span class="required">*</span></label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.product_name" required/>
							</div>

							<div class="mb-3">
								<label class="form-label">On Demand <span class="required">*</span></label>
								<select class="form-select form-select rounded-0 w-auto" v-model="product.on_demand" required>
									<option value="0" selected>No</option>
									<option value="1">Yes</option>
								</select>
								<p class="form-text text-info">Note: Lorem Ipsum</p>
							</div>

							<div class="mb-3">
								<label class="form-label">Price</label>
								<input class="form-control form-control-lg rounded-0" type="number" v-model="product.price" />
							</div>							

							<div class="mb-3">
								<label class="form-label">Category <span class="required">*</span></label>
								<select class="form-select form-select-lg rounded-0" v-model="product.category_id" required>
									<option selected></option>
									<template v-for="category in categories">
										<option v-if="category.parent_category" :value="category.category_id">{{ titleCase(category.parent_category_name) }} - {{ titleCase(category.name) }}</option>
									</template>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label">Dimension</label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.dimension" />
							</div>

							<div class="mb-3">
								<label class="form-label">Featured Image</label>
								<input class="form-control rounded-0" ref="featuredfileupload" name="featuredimg" type="file" @change="selectFile" />
								<p class="form-text text-danger">Note: This will replace your existing Featured Image.</p>
							</div>

							<div class="mb-3">
								<table class="table table-bordered table-sm">
									<thead>
										<tr>
											<th>Filename</th>
										</tr>
									</thead>
									<tbody>
										<tr v-if="product.featured_image">
											<td>{{ product.featured_image }}</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>			

						<div class="col-12 col-lg-4">
							<div class="mb-3">
								<label class="form-label">Materials</label>
								<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="product.materials"></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="product.product_description"></textarea>
							</div>

							<div class="mb-3">
								<label class="form-label">Other Images</label>
								<input class="form-control rounded-0" ref="otherfileupload"  name="otherimg" type="file" @change="selectFile" multiple/>
							</div>

							<div class="mb-3">
								<table class="table table-bordered table-sm">
									<thead>
										<tr>
											<th>Filename</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(image, index) in product.other_images" :key="index">
											<td class="d-flex justify-content-between">
												<div>{{ image }}</div>
												<div>
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x align-middle me-2 text-danger clickable" @click="removeImage(image, index)"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>

						<div class="col-12 col-lg-4"></div>

						<div class="col-12 text-end">
							<button type="submit" class="btn btn-primary rounded-0">Save Changes</button>
						</div>
					</div>
				</form>
			</div>

			<div v-else>
				<form @submit.prevent="create" enctype="multipart/form-data">
					<div class="row">
						
						<div class="col-12 col-lg-4">

							<div class="mb-3">
								<label class="form-label">Code <span class="required">*</span></label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.product_code" required/>
							</div>

							<div class="mb-3">
								<label class="form-label">Name <span class="required">*</span></label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.product_name" required/>
							</div>

							<div class="mb-3">
								<label class="form-label">On Demand <span class="required">*</span></label>
								<select class="form-select form-select rounded-0 w-auto" v-model="product.on_demand" required>
									<option value="0" selected>No</option>
									<option value="1">Yes</option>
								</select>
								<p class="form-text text-info">Note: Lorem Ipsum</p>
							</div>

							<div class="mb-3">
								<label class="form-label">Price</label>
								<input class="form-control form-control-lg rounded-0" type="number" v-model="product.price" />
							</div>

							<div class="mb-3">
								<label class="form-label">Category <span class="required">*</span></label>
								<select class="form-select form-select-lg rounded-0" v-model="product.category_id" required>
									<option selected></option>
									<template v-for="category in categories">
										<option v-if="category.parent_category" :value="category.category_id">{{ titleCase(category.parent_category_name) }} - {{ titleCase(category.name) }}</option>
									</template>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label">Dimension</label>
								<input class="form-control form-control-lg rounded-0" type="text" v-model="product.dimension" />
							</div>

							<div class="mb-3">
								<label class="form-label">Featured Image</label>
								<input class="form-control rounded-0" ref="featuredfileupload" name="featuredimg" type="file" @change="selectFile" />
							</div>

							<div class="mb-3">
								<table class="table table-bordered table-sm">
									<thead>
										<tr>
											<th>Filename</th>
										</tr>
									</thead>
									<tbody>
										<tr v-if="product.featured_image">
											<td>{{ product.featured_image }}</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>			

						<div class="col-12 col-lg-4">
							<div class="mb-3">
								<label class="form-label">Materials</label>
								<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="product.materials"></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="product.product_description"></textarea>
							</div>

							<div class="mb-3">
								<label class="form-label">Other Images</label>
								<input class="form-control rounded-0" ref="otherfileupload"  name="otherimg" type="file" @change="selectFile" multiple/>
							</div>

							<div class="mb-3">
								<table class="table table-bordered table-sm">
									<thead>
										<tr>
											<th>Filename</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="image in product.other_images">
											<td>{{ image }}</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>

						<div class="col-12 col-lg-4"></div>

						<div class="col-12 text-end">
							<button type="submit" class="btn btn-primary rounded-0">Save Changes</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</template>

<script>
    export default {

    	props: ['identifier'],

    	data() {
            return {
            	action: 'Add New',
            	isEditing: false,
            	categories: [],
            	category: {
            		category_id: 0,
            		name: '',
            		parent_category: 0,
	            	slug: '',
	            	image: null,
	            	description: ''
            	},
            	product: {
          			product_id: 0,
					category_id: 0,
					price: '',
					on_demand: 0,
					product_code: '',
					product_name: '',
					product_description: '',
					dimension: '',
					materials: '',
					featured_image: null,
					other_images: []
          		},
          		featured_img_obj: null,
          		other_img_obj: [],
          		img_src: null
            }
        },

        methods: {

        	fetchCategories() {
        		axios.get(this.baseUrl() + 'admin/category/list').then((response) => {
                    this.categories = response.data.data;
                });
        	},

        	create() {

        		var formData = new FormData();
	    		formData.append('category_id', this.product.category_id);
				formData.append('price', parseFloat(this.product.price));
				formData.append('on_demand', this.product.on_demand);
				formData.append('product_code', this.product.product_code);
				formData.append('product_name', this.product.product_name);
				formData.append('product_description', this.product.product_description);
				formData.append('dimension', this.product.dimension);
				formData.append('materials', this.product.materials);

				if( this.featured_img_obj ) {
					formData.append('featuredimg', this.featured_img_obj);
				}

				if( this.other_img_obj.length ) {

					for (let i = 0; i < this.other_img_obj.length; i++) {

					  	let file = this.other_img_obj[i];
					  	formData.append('otherimg[' + i + ']', file);
					}
				}

				axios.post(this.baseUrl() + 'admin/product/store', formData)
		          .then((response) => {

		    		Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: response.data.message,
					  showConfirmButton: false,
					  timer: 1500,
					  toast: true,
					});

					this.clear();
		        });
        	},

        	update() {
  
        		if( this.product.product_id ) {

        			var formData = new FormData();
	        		formData.append("_method", "put");
	        		formData.append('category_id', this.product.category_id);
					formData.append('price', parseFloat(this.product.price));
					formData.append('on_demand', this.product.on_demand);
					formData.append('product_code', this.product.product_code);
					formData.append('product_name', this.product.product_name);
					formData.append('product_description', this.product.product_description);
					formData.append('dimension', this.product.dimension);
					formData.append('materials', this.product.materials);

					if( this.featured_img_obj ) {
						formData.append('featuredimg', this.featured_img_obj);
					}

					if( this.other_img_obj.length ) {

						for (let i = 0; i < this.other_img_obj.length; i++) {

						  	let file = this.other_img_obj[i];
						  	formData.append('otherimg[' + i + ']', file);
						}
					}

					axios.post(this.baseUrl() + 'admin/product/update/' + this.product.product_id, formData)
			          .then((response) => {

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

        	clear() {
      			this.product.product_id = 0;
				this.product.category_id = 0;
				this.product.price = '';
				this.product.on_demand = 0;
				this.product.product_code = '';
				this.product.product_name = '';
				this.product.product_description = '';
				this.product.dimension = '';
				this.product.materials = '';
				this.product.featured_image = null;
				this.product.other_images = [];
          		this.featured_img_obj = null;
          		this.other_img_obj = [];
          		this.$refs.featuredfileupload.value = null;
				this.$refs.otherfileupload.value = null;
        	},

        	selectFile(event) {

        		if( event.target.name == 'featuredimg' ) {

        			if( this.product.featured_image ) {
        				this.removeImage(this.product.featured_image, false);
        			}

        			this.product.featured_image = event.target.files[0].name;
        			this.featured_img_obj = event.target.files[0];
        		}

        		if( event.target.name == 'otherimg' ) {
        			
        			let files = event.target.files;

        			if( files.length ) {

			    		for (let i = 0; i < files.length; i++) {

						  	let file = files.item(i);
						  	this.product.other_images.push(file.name);
						  	this.other_img_obj.push(file);
						}
		    	    }

        		}
        	},

        	fill() {
        		
        		axios.get(this.baseUrl() + 'admin/product/' + this.identifier).then((response) => {
                    this.product = response.data.data;
                    this.product.price = this.product.price.toFixed(2);
                    this.img_src = this.product.img_src;
                });

        	},

        	removeImage(filename, index) {

        		var formData = new FormData();
        		var path = null;

        		if( index ) {
        			this.product.other_images.splice(index, 1);
        			path = this.img_src.others + '/' + filename;
        		}else {
        			path = this.img_src.featured + '/' + filename;
        		}

		    	formData.append('file', path);

		    	axios.post(this.baseUrl() + 'admin/product/img/remove', formData)
	          	.then((response) => {

	          		Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your file has been removed.',
					  showConfirmButton: false,
					  timer: 1500,
					  toast: true,
					});

		    	 });
        	},
        },

        mounted() {
        	this.fetchCategories();

        	if( this.identifier ) {
        		this.isEditing = true;
        		this.action = 'Edit Product';
        		this.fill();
        	}
        }
    }
</script>

<style>
.clickable {
    cursor:pointer;
}
.required {
	color: #dc3545;
	font-weight: 700;
	font-size: 1rem;

}
</style>