<template>
   <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title mb-0">List of Product Categories</h5>
        </div>
        <div class="card-body">

            <div class="mb-3 d-flex justify-content-between">

                <div class="d-flex gap-2">
                    
                    <div class="d-flex">
                        <select class="form-select rounded-0 w-auto" v-model="action">
                            <option value="null" selected>Bulk Actions</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-outline-secondary ms-2 rounded-0" @click.prevent="applyAction">Apply</button>
                    </div>

                    <div class="d-flex">
                        <select class="form-select rounded-0 w-auto" v-model="filter" @change="filterByCategory">
                            <option value="" selected>Filter: All</option>
                            <option value="parent">Category</option>
                            <option value="sub">Sub Category</option>
                        </select>
                    </div>
                    
                </div>

                <div class="d-flex">
                    <div class="d-flex justify-content-end">
                        <input v-model="search" class="form-control rounded-0 w-100" type="text" placeholder="Search" />
                    </div>
                </div>

            </div>

            <table class="table table-sm table-bordered table-hover my-0">
                <thead>
                    <tr>
                        <th class="width-auto"></th>
                        <th class="w-auto">Name</th>
                        <th class="w-auto">Category (P)</th>
                        <th class="w-auto">Slug</th>
                        <!-- <th class="w-25">Description</th> -->
                        <th class="w-auto">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in filteredCategories" :key="category.category_id" class="clickable" @click="view(category)">
                        <td class="text-center"><input class="form-check-input" type="checkbox" :value="category.category_id" v-model="checked" @change="check" @click.stop></td>
                        <td>{{ titleCase(category.name) }}</td>
                        <td>{{ titleCase(category.parent_category_name) }}</td>
                        <td>{{ category.slug }}</td>
                        <!-- <td>{{ category.description }}</td> -->
                        <td>{{ category.image }}</td>
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

        emits: ['view-category'],

        data() {
            return {
                action: null,
                checked: [],
                categories: [],
                filtered: [],
                category: null,
                search: '',
                filter: '',
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
                axios.get(this.baseUrl() + 'admin/category/list').then((response) => {
                    this.categories = response.data.data;
                    this.filtered = this.categories;
                    this.initializePagination();
                });
            },

            view(row) {
                this.category = row;
                this.$emit('view-category', this.category);
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
                }
            },

            delete() {

                let url = this.baseUrl() + 'admin/category/destroy/' + this.checked;
               
                axios.delete(url)
                  .then((response) => {

                    Swal.fire(
                      'Deleted!',
                      'Category Item/s has been removed',
                      'success'
                    );

                    this.fetchData();
                    this.checked = [];
                    this.action = null;

                }).catch(function (error) {

                    Swal.fire(
                      'Error!',
                       error.response.data.message,
                      'error'
                    );
                });
                
            },

            reload() {
                this.fetchData();
            },

            filterByCategory() {

                switch(this.filter) {

                    case 'parent':
                        this.filtered = this.categories.filter( category => {
                            let data = category.parent_category;
                            if( data == 0 ) { return true; }
                        });
                    break;
                    case 'sub': 
                        this.filtered = this.categories.filter( category => {
                            let data = category.parent_category;

                            if( data > 0 ) { return true; }
                        });
                    break;
                    default: 
                        this.filtered = this.categories.filter( category => {
                            let data = category.name;
                            return data.toLowerCase().includes(this.filter.toLowerCase());

                        });  
                }
                this.initializePagination();
            }

        },

        computed: {

            filteredCategories() {
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
                this.filtered = this.categories.filter( category => {
                    let data = category.name;
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