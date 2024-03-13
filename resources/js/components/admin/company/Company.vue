<template>
	<div class="col-12 col-sm-6">
	    <div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title mb-0">Company Information</h5>
			</div>
			<div class="card-body pt-0">

				<div>
					<form @submit.prevent="update" enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Company Name</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.name" type="text" required />
						</div>
						<div class="mb-3">
							<label class="form-label">Address </label>
							<textarea class="form-control form-control-lg rounded-0" rows="3" v-model="company.address"></textarea>
						</div>

						<div class="mb-3">
							<label class="form-label">Phone Number</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.phone" type="text"/>
						</div>

						<div class="mb-3">
							<label class="form-label">Mobile Number</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.mobile" type="text"/>
						</div>

						<div class="mb-3">
							<label class="form-label">Facebook</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.facebook" type="text"/>
						</div>
						<div class="mb-3">
							<label class="form-label">Twitter</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.twitter" type="text"/>
						</div>

						<div class="mb-3">
							<label class="form-label">LinkedIn</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.linkedin" type="text"/>
						</div>

						<div class="mb-3">
							<label class="form-label">Instagram</label>
							<input class="form-control form-control-lg rounded-0" v-model="company.instagram" type="text"/>
						</div>

						<div class="mb-3 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary rounded-0" >Save Changes</button>
						</div>
				
					</form>
				</div>

			</div>

		</div>
	</div>

</template>

<script>
    export default {
        data() {
            return {
            	company: {
            		company_id: '',
            		name: '',
            		address: '',
            		phone: '',
            		mobile: '',
            		facebook: '',
            		twitter: '',
            		instagram: '',
            		linkedin: ''
            	}
            }
        },

        methods: {
        	getCompanyInfo() {
        		axios.get(this.baseUrl() + 'admin/company/show').then((response) => {
                    this.company = response.data.data;
                });
        	},

        	update() {

        		var formData = new FormData();
        		formData.append("_method", "put");
	    		formData.append('name', this.company.name);
				formData.append('address', this.company.address);
				formData.append('phone', this.company.phone);
				formData.append('mobile', this.company.mobile);
				formData.append('facebook', this.company.facebook);
				formData.append('twitter', this.company.twitter);
				formData.append('instagram', this.company.instagram);
				formData.append('linkedin', this.company.linkedin);

				axios.post(this.baseUrl() + 'admin/company/update/' + this.company.company_id, formData)
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

        mounted() {
        	this.getCompanyInfo();
        }
    }
</script>