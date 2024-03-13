<template>
	<div class="col-12 mb-3">
		<router-link :to="{ name: 'category' }" tag="button" class="btn btn-outline-secondary rounded-0">
			<i class="align-middle" data-feather="arrow-left"></i>
		</router-link>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title mb-0">Edit Category</h5>
				<p class="form-text mb-0 text-danger">Fields with asterisks(*) are required.</p>
			</div>
			<div class="card-body pt-0">
				<form @submit.prevent="update" enctype="multipart/form-data">
				<div class="row">
					<div class="col-12 d-flex flex-column">
						<div class="mb-3">
							<label class="form-label">Name <span class="required">*</span></label>
							<input class="form-control form-control-lg rounded-0" v-model="category.name" @keyup="suggestSlug" type="text" required/>
						</div>
						<div class="mb-3">
							<label class="form-label">Main Category</label>
							<Select2 
							 v-model="selectedValue" 
							 :options="options" 
							 :settings="{ placeholder : 'Select Category',  allowClear: true }" 
							 @select="onChangeCategory($event)" />
						</div>
						<div class="mb-3">
							<label class="form-label">Slug <span class="required">*</span></label>
							<input class="form-control form-control-lg rounded-0" type="text" v-model="category.slug" required/>
							<p class="form-text text-muted">The “slug” is the URL-friendly version of the name. It is usually all lower case and contains only letters, numbers, and hyphens.</p>
						</div>
						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="category.description"></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">Image</label>
							<input class="form-control rounded-0" ref="fileupload" name="img" type="file" @change="selectFile" />
						</div>
						<div class="mb-3 text-end">
							<button type="submit" class="btn btn-primary rounded-0">Save Changes</button>
						</div>
						
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>

import Select2 from 'vue3-select2-component';

export default {

	components: {
		Select2
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
        	category: {
        		category_id: null,
        		name: null,
        		parent_category: 0,
            	slug: null,
            	image: null,
            	description: null
        	},
        	file: null,
        	selectedValue: []
        }
    },

    methods: {

    	async fetchCategories() {
    		await axios.get(this.baseUrl() + 'api/category/').then((response) => {
                let data = response.data.data;
	            data.forEach((item, index) => {
	            	if( item.parent_category == 0 ) {
	            		this.options.push({
					  		id : item.category_id,
					  		text : this.titleCase(item.name)
					  	});
	            	}
				});
            });
    	},

    	async update() {

    		if( this.category.category_id ) {

        		var formData = new FormData();
        		formData.append("_method", "put");
	    		formData.append('name', this.category.name);
				formData.append('parent_category', this.category.parent_category);
				formData.append('slug', this.category.slug);
				formData.append('description', this.category.description);
				formData.append('img', this.category.image);

				await axios.post(this.baseUrl() + 'api/category/' + this.category.category_id, formData)
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

    	cancelUpdate() {
    		this.clear();
    	},

    	selectFile(event) {
    	    if(event.target.files.length){
				this.category.image = event.target.files[0];
    	    }
    	},

    	async fill() {
    		await axios.get(this.baseUrl() + 'api/category/' + this.id).then((response) => {
	            this.category = response.data.data;
	            this.selectedValue = [this.category.parent_category, this.category.parent];
	        });
    	},

    	clear() {
    		this.category.category_id = null;
			this.category.name = null;
			this.category.parent_category = 0;
			this.category.slug = null;
			this.category.image = null;
			this.category.description = null;
			this.file = null;
			this.selectedValue = [];
			this.$refs.fileupload.value = null;
    	},

    	suggestSlug() {

    		let name = this.category.name;
    		let slug = name.split(' ');

    		this.category.slug = slug.join('-');
    	},

    	onChangeCategory({id, text}){
    		this.selectedValue = [id, text];
    		this.category.parent_category = id;
        }


    },

    mounted() {
    	this.fetchCategories();
    	this.fill();
    	feather.replace();
    }
};

</script>

<style>
.required {
	color: #dc3545;
	font-weight: 700;
	font-size: 1rem;

}
</style>