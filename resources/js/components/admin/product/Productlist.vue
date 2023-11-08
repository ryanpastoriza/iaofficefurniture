<template>
	<div class="card">
		<div class="card-body">

            <div class="mb-3 d-flex justify-content-between">

                <div class="d-flex gap-2">
                    
                    <div class="d-flex">
                        <select class="form-select rounded-0 w-auto" v-model="action">
                            <option value="null" selected>Bulk Actions</option>
                            <option value="set">Set as Featured Product</option>
                            <option value="unset">Unset as Featured Product</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-outline-secondary ms-2 rounded-0"  @click.prevent="applyAction">Apply</button>
                    </div>
                    
                </div>

                <div class="d-flex">
                    <div class="d-flex justify-content-end">
                        <input v-model="search" class="form-control rounded-0 w-auto" type="text" placeholder="Search" />
                    </div>
                </div>

            </div>

			<table class="table table-sm table-hover my-0">
				<thead>
					<tr>
						<th></th>
						<th>Code</th>
						<th>Name</th>
						<th>Categories</th>
						<th class="text-end">Price</th>
						<th>Slug</th>
						<th width="300">Description</th>
						<th class="text-center">Featured</th>
                        <th class="text-center">On Demand</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="product in filteredProducts" :key="product.product_id" class="clickable" @click="view(product.product_id)">
						<td><input class="form-check-input" type="checkbox" :value="product.product_id" v-model="checked" @change="check" @click.stop></td>
						<td>{{ product.product_code }}</td>
						<td>{{ titleCase(product.product_name) }}</td>
						<td>
							<div>{{ titleCase(product.parent_category_name) }}</div> 
							<div class="text-muted">{{ titleCase(product.category) }}</div>
						</td>
						<td class="text-end">
                            <span v-if="product.on_demand" class="badge bg-success">Call for pricing</span>
                            <span v-else>{{ numFormat(product.price) }}</span>
                            
                        </td>
						<td>{{ product.slug }}</td>
						<td>{{ product.product_description }}</td>
						<td class="text-center">
							<span v-if="product.featured" class="badge bg-primary">Yes</span>
							<span v-else class="badge bg-danger">No</span>
						</td>
                        <td class="text-center">
                            <span v-if="product.on_demand" class="badge bg-primary">Yes</span>
                            <span v-else class="badge bg-danger">No</span>
                        </td>
					</tr>
				</tbody>
			</table>

			<div class="d-flex flex-row gap-1 mt-2 justify-content-between">
                <div class="d-flex align-items-center">{{ pageInfo() }}</div>
                <div class="d-flex flex-row gap-1 align-items-center">
                    <button class="page" @click="prevPage()" :class="{'inactive' : prevInactive}" :disabled="prev">Previous</button> 
                    <button class="page" @click="nextPage()" :class="{'inactive' : nextInactive}" :disabled="next">Next</button>    
                </div>
            </div>

		</div>
	</div>
</template>

<script>
    export default {

    	emits: ['edit-product'],

    	data() {
    		return {
    			action: null,
    			products: [],
    			product: null,
    			checked: [],
                filter: '',
    			filtered: [],
    			search: '',
                pageSize: 20,
                currentPage: 1,
                items: 0,
                pages: 0,
                index: 0,
                start: 0,
                end: 0,
                prev: false,
                next:false,
                prevInactive: false,
                nextInactive: false
    		}
    	},

    	methods: {

    		initializePagination() {
                this.currentPage = 1;
                this.index = 0;
                this.start = 0;
                this.end = 0;
                this.items = this.filtered.length;
                this.pages = Math.ceil( this.items / this.pageSize );
                this.switchPage(this.currentPage);
            },

            switchPage(page) {

                if(page <= 1) {
                    this.prev = true;
                    this.prevInactive = true;
                } else {
                    this.prev = false;
                    this.prevInactive = false;
                }

                if(page >= this.pages) {
                    this.next = true;
                    this.nextInactive = true;
                } else {
                    this.next = false;
                    this.nextInactive = false;
                }
            },

            nextPage() {
              if((this.currentPage * this.pageSize) < this.items) this.currentPage++;
              this.switchPage(this.currentPage);
            },

            prevPage() {
              if(this.currentPage > 1) this.currentPage--;
              this.switchPage(this.currentPage);
            },

            pageInfo() {

                let start =  (((this.currentPage-1) * this.pageSize) + 1 );
                let end = this.currentPage * this.pageSize;
                let items = this.items;

                if( end > items ){ end = items; }
                return 'Showing ' + start + ' to ' + end + ' of ' + items + ' Entries';
            },

    		fetchData() {
                axios.get(this.baseUrl() + 'admin/product/list').then((response) => {
                    this.products = response.data.data;
                    this.filtered = this.products;
                    this.initializePagination();
                });
            },

            view(id) {
            	this.$emit('edit-product', id);
            },

            applyAction() {

                if( this.checked.length <= 0 ) {

                    Swal.fire({
                      position: 'top-end',
                      icon: 'warning',
                      title: 'Nothing Selected',
                      showConfirmButton: false,
                      timer: 1500,
                      toast: true,
                    });

                    return;
                }

            
            	switch(this.action) {

            		case 'set': this.toggleFeaturedProduct(1); break;

            		case 'unset': this.toggleFeaturedProduct(0); break;

                    case 'delete': 
                        Swal.fire({
                          title: 'Are you sure?',
                          text: "You won't be able to revert this!",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.delete(); 
                            }
                        });
                    break;

            		default: 
            			Swal.fire({
						  position: 'top-end',
						  icon: 'info',
						  title: 'No action was selected',
						  showConfirmButton: false,
						  timer: 1500,
						  toast: true,
						});
            		break;
            	}

            },

            toggleFeaturedProduct(featured) {

            	let formData = new FormData();
				formData.append('isFeatured', featured);
				for (let i = 0; i < this.checked.length; i++) {
				  	formData.append('product_id[' + i + ']', this.checked[i]);
				}

				axios.post(this.baseUrl() + 'admin/product/set/featured', formData)
		          .then((response) => {

		          	this.fetchData();
		          	this.action = null;
		          	this.checked = [];
		          	
		        });
            },

            delete() {

                let url = this.baseUrl() + 'admin/product/destroy/' + this.checked;
               
                axios.delete(url)
                  .then((response) => {

                    Swal.fire(
                      'Deleted!',
                      'Product Item/s has been removed',
                      'success'
                    );

                    this.fetchData();
                    this.action = null;
                    this.checked = [];

                }).catch(function (error) {

                    Swal.fire(
                      'Error!',
                       error.response.data.message,
                      'error'
                    );
                });
            }

    	},

    	computed: {

    		filteredProducts() {
    			return this.filtered.filter((row, index) => {

                    let start = (this.currentPage-1) * this.pageSize;
                    let end = this.currentPage * this.pageSize;
   
                    if(index >= start && index < end) {
                        this.index = index;
                        this.start = start;
                        this.end = end;
                        return true;
                    }
                });
    		}
    	},

    	watch: {

            'search'(newValue) {
                this.filtered =  this.products.filter( product => {
                    let data = product.product_name;
                    return data.toLowerCase().includes(this.search.toLowerCase());
                } );

                this.initializePagination();
            }
        },

    	async mounted() {
    		this.fetchData();
    	}

    }
</script>

<style>
.clickable {
    cursor:pointer;
}

.page {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    cursor: pointer;
}

.page:hover {
    text-decoration: none;
    border-color: #dee2e6; 
    background-color: #0d6efd;
    color: #FFFFFF;
}

.inactive, .page.inactive:hover { 
    background-color: #FFFFFF;
    color: #999;
    cursor: default;
}
</style>