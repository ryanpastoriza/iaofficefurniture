<template>
	<div class="card">
		<div class="card-header pb-0">
			<h5 class="card-title mb-0">{{ action }}</h5>
			<p class="form-text mb-0 text-danger">Fields with asterisks(*) are required.</p>
		</div>
		<div class="card-body pt-0">

			<div v-if="isEditing">
				<form @submit.prevent="update" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Name <span class="required">*</span></label>
					<input class="form-control form-control-lg rounded-0" v-model="category.name" type="text" required/>
				</div>
				<div class="mb-3">
					<label class="form-label">Parent Category</label>
					<select class="form-select form-select-lg rounded-0" v-model="category.parent_category">
						<option value="0">--</option>
						<template v-for="category in categories">
							<option v-if="!category.parent_category" :value="category.category_id">{{ titleCase(category.name) }}</option>
						</template>
					</select>
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
				<div class="mb-3 d-flex justify-content-between">
					<button @click.prevent="cancelUpdate" class="btn btn-light rounded-0">Cancel</button>	
					<button type="submit" class="btn btn-primary rounded-0">Save Changes</button>
				</div>
				</form>
			</div>
			<div v-else>
				<form @submit.prevent="create" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Name <span class="required">*</span></label>
					<input class="form-control form-control-lg rounded-0" v-model="category.name" @keyup="suggestSlug" type="text" required/>
				</div>
				<div class="mb-3">
					<label class="form-label">Parent Category</label>
					<select class="form-select form-select-lg rounded-0" v-model="category.parent_category">
						<option value="0">--</option>
						<template v-for="category in categories">
							<option v-if="!category.parent_category" :value="category.category_id">{{ category.name }}</option>
						</template>
					</select>
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
				</form>
			</div>
		</div>
	</div>
</template>

<script>
    export default {

    	props: ['reloadCategoryList'],
    	
        data() {
            return {
            	action: 'Add New',
            	isEditing: false,
            	categories: [],
            	category: {
            		category_id: null,
            		name: null,
            		parent_category: 0,
	            	slug: null,
	            	image: null,
	            	description: null
            	}
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
	    		formData.append('name', this.category.name);
				formData.append('parent_category', this.category.parent_category);
				formData.append('slug', this.category.slug);
				formData.append('description', this.category.description);
				formData.append('img', this.category.image);

				axios.post(this.baseUrl() + 'admin/category/store', formData)
		          .then((response) => {
		    		console.log(response);
		    		Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: response.data.message,
					  showConfirmButton: false,
					  timer: 1500,
					  toast: true,
					});
					this.clear();
					this.reloadCategoryList();
		        });
        	},

        	update() {

        		if( this.category.category_id ) {

	        		var formData = new FormData();
	        		formData.append("_method", "put");
		    		formData.append('name', this.category.name);
					formData.append('parent_category', this.category.parent_category);
					formData.append('slug', this.category.slug);
					formData.append('description', this.category.description);
					formData.append('img', this.category.image);

					axios.post(this.baseUrl() + 'admin/category/update/' + this.category.category_id, formData)
			          .then((response) => {
			    		console.log(response);
			    		Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: response.data.message,
						  showConfirmButton: false,
						  timer: 1500,
						  toast: true,
						});
						this.clear();
						this.reloadCategoryList();
			        });

		        }
        	},

        	cancelUpdate() {
        		this.clear();
		    	this.isEditing = false;
        	},

        	selectFile(event) {
	    	    if(event.target.files.length){
					this.category.image = event.target.files[0];
	    	    }
        	},

        	fill(data) {
        		this.clear();
        		this.isEditing = true;
        		this.action = "Editing: " + data.name;

        		this.category.category_id = data.category_id;
        		this.category.name = data.name;
        		this.category.parent_category = data.parent_category;
        		this.category.slug = data.slug;
        		this.category.description = data.description;
        	},

        	clear() {
        		this.action = "Add New";
        		this.isEditing = false;
        		this.category.category_id = null;
				this.category.name = null;
				this.category.parent_category = 0;
				this.category.slug = null;
				this.category.image = null;
				this.category.description = null;
				this.$refs.fileupload.value = null;
        	},

        	suggestSlug() {

        		let name = this.category.name;
        		let slug = name.split(' ');

        		this.category.slug = slug.join('-');
        	}


        },

        mounted() {
        	this.fetchCategories();
        }
    }
</script>

<style>
.required {
	color: #dc3545;
	font-weight: 700;
	font-size: 1rem;

}
</style>