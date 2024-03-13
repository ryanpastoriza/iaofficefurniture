<template>
     <div class="col-12 mb-3">
        <router-link :to="{ name: 'category.create' }" tag="button" class="btn btn-primary rounded-0"> Add New Category </router-link>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-4">
                         <input v-model="search" class="form-control form-control-lg" type="text" placeholder="Search Category"  />
                    </div>
                    <div class="col-8 d-flex flex-row gap-2 justify-content-end">

                        <div class="d-flex flex-row align-items-center h-100">
                           
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="parent" checked>
                                <span class="form-check-label">
                                  Main Category
                                </span>
                            </label>

                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="sub" checked>
                                <span class="form-check-label">
                                  Sub-Category
                                </span>
                            </label>     
                           <!--  <select class="form-select rounded-0 w-auto" v-model="filter" @change="filterByCategory">
                                <option value="" selected>Filter: All</option>
                                <option value="parent">Category</option>
                                <option value="sub">Sub Category</option>
                            </select> -->
                        </div>

                        <div class="vr"></div>

                        <div class="d-flex align-items-center gap-2">
                           
                                <button type="button" class="btn btn-outline-success">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </button>

                                 <button type="button" class="btn btn-outline-danger" @click="remove">
                                    <i class="align-middle" data-feather="trash"></i>
                                </button>
                        </div>
                    </div>
                </div>          

                <table class="table table-hover" id="category-list">
                    <thead class="table-light">
                        <tr>
                            <th class="w-auto"></th>
                            <th class="w-25">Name</th>
                            <th class="w-25">Main Category</th>
                            <th class="w-25">Slug</th>
                            <th class="w-25">Featured Image</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
    
                        <tr v-for="category in filteredCategories" :key="category.category_id" @click="view(category.category_id)">
                            <td class="text-center" @click.stop><input class="form-check-input" type="checkbox" :value="category.category_id" v-model="checked" @change="check"></td>
                            <td>
                               <!--  <img :src="category.image_url" alt=""> -->
                                <span>{{ titleCase(category.name) }}</span>
                            </td>
                            <td>{{ titleCase(category.parent) }}</td>
                            <td>{{ category.slug }}</td>
                            <td>{{ category.image }}</td>
                        </tr>
                       
                    </tbody>
                </table>

                <div class="d-flex flex-row gap-1 mt-2 justify-content-between">
                    <div class="d-flex align-items-center">{{ pageInfo() }}</div>
                    <div class="d-flex flex-row gap-1 align-items-center">
                        <button class="page" @click="prevPage()" :class="{'inactive' : prevInactive}" :disabled="prev"><i class="align-middle" data-feather="chevron-left"></i></button> 
                        <button class="page" @click="nextPage()" :class="{'inactive' : nextInactive}" :disabled="next"><i class="align-middle" data-feather="chevron-right"></i></button>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                checked: [],
                categories: [],
                filtered: [],
                search: '',
                filter: '',
                pageSize: 10,
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

            async fetchData() {
                await axios.get(this.baseUrl() + 'api/category').then((response) => {
                    this.categories = response.data.data;
                    this.filtered = this.categories;
                    this.initializePagination();
                });
            },

            view(id) {
                this.$router.push({ name: 'category.edit', params: { id: id } });
            },

            remove() {

                if( this.checked.length ) {

                    Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!.",
                      // icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.delete();
                        }
                    });

                    return;
                }

                Swal.fire({
                  position: 'top-end',
                  icon: 'warning',
                  title: 'You must select an item',
                  showConfirmButton: false,
                  timer: 1500,
                  toast: true,
                });
            },

            async delete() {
                
                let url = this.baseUrl() + 'api/category/' + this.checked;
               
                await axios.delete(url).then((response) => {

                    Swal.fire(
                      'Deleted!',
                      'Category Item/s has been removed',
                      'success'
                    );

                    this.fetchData();
                    this.checked = [];

                }).catch(function (error) {

                    Swal.fire(
                      'Error!',
                       error.response.data.message,
                      'error'
                    );
                });
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

        mounted() {
            this.fetchData();
            feather.replace();
        }
    };
</script>



<style>
/*#category-list img {
    height: 25px;
    max-width: 25px;
    object-fit: contain;
}*/

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