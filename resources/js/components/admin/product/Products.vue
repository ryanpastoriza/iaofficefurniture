<template>
    <!-- <div class="col-12 mb-3 d-flex">
        <router-link :to="{ name: 'product.create' }" tag="button" class="btn btn-primary d-flex flex-row gap-1">
            <div v-html="plusSvg" class="text-white"></div> 
            <span>New Product</span>
        </router-link>
    </div> -->

    <div class="col-12 mb-3 d-flex flex-row gap-2 justify-content-between align-items-center">
      
        <div class="w-50 d-flex flex-row justify-content-start gap-1">
             <router-link :to="{ name: 'product.create' }" tag="button" class="btn btn-primary d-flex flex-row gap-1">
                <div v-html="plusSvg" class="text-white"></div> 
            </router-link>
            <button class="btn btn-danger" @click.prevent="confirmDelete">
                <div v-html="trashSvg"></div>
            </button>
        </div>

        <div class="w-50">
            <input v-model="search" class="form-control form-control-lg" type="text" placeholder="Search Product" />
        </div>

    </div>
  
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-sm">
                    <thead class="">
                        <tr class="">
                            <th></th>
                            <th class="w-25 text-uppercase">Product</th>
                            <th class="w-25 text-uppercase">Category</th>
                            <th class="text-end text-uppercase">Price / On Demand</th>
                            <th class="text-center text-uppercase">Featured</th>
                            <th class="text-end text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr v-for="product in filteredProducts" :key="product.product_id">
                            <td @click.stop><input class="form-check-input" type="checkbox" :value="product.product_id" v-model="checked" @change="check"></td>
                            <td class="d-flex flex-row align-items-center gap-2">
                                <div class="featured-image"><img :src="`${baseUrl()}${product.directory.images}${product.featured_image}`" alt=""></div>
                                <div class="d-flex flex-column">
                                    <div class="fw-semibold">{{ product.product_code }}</div> 
                                    <div class="text-muted">{{ titleCase(product.product_name) }}</div>
                                </div>
                                
                            </td>
                            <td>
                                <div>{{ titleCase(product.category.name) }}</div> 
                            </td>
                            <td class="text-end">
                                <div v-if="product.on_demand">
                                    <span class="badge bg-info">On Demand</span>
                                </div>
                                <div v-else>
                                    <span>{{ numFormat(product.price) }}</span>
                                </div>                                 
                            </td>
                            <td class="text-center">
                                <div v-if="product.featured" v-html="checkSvg" class="text-success" @click="featured()"></div>
                                <div v-else v-html="xSvg" class="text-danger" @click="featured()"></div>
                                
                            </td>
                            <td>
                                <div class="tool-box d-flex flex-row flex-wrap gap-2 justify-content-end">
                                    <div class="tool" @click="view(product.product_id)">
                                        <div v-html="editSvg"></div>
                                    </div>
                                    <!-- <div class="tool">
                                        <div v-html="trashSvg"></div>
                                    </div> -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex flex-row gap-1 mt-2 justify-content-between">
                    <div class="d-flex align-items-center">{{ pageInfo() }}</div>
                    <div class="d-flex flex-row gap-1 align-items-center">
                        <button class="page" @click="prevPage()" :class="{'inactive' : prevInactive}" :disabled="prev">
                            <div v-html="chevronLeftSvg"></div>
                        </button> 
                        <button class="page" @click="nextPage()" :class="{'inactive' : nextInactive}" :disabled="next">
                             <div v-html="chevronRightSvg"></div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import Select2 from 'vue3-select2-component';
    import feather from 'feather-icons';

    export default {

        components: {
            Select2
        },
    
        data() {
            return {
                products: [],
                checked: [],
                filtered: [],
                search: '',
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
                nextInactive: false,
                icons: {
                    edit: 'edit-2',
                    trash: 'trash',
                    chevron : {
                        left: 'chevron-left',
                        right: 'chevron-right'
                    },
                    check: 'check',
                    x: 'x',
                    plus: 'plus'
                }
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
                await axios.get(this.baseUrl() + 'api/product').then((response) => {
                    this.products = response.data.data;
                    this.filtered = this.products;
                    this.initializePagination();
                });
            },

            view(id) {
                this.$router.push({ name: 'product.edit', params: { id: id } });
            },

            alert() {

                Swal.fire({
                  position: 'top-end',
                  icon: 'warning',
                  title: 'Nothing Selected',
                  showConfirmButton: false,
                  timer: 1500,
                  toast: true,
                });
            },

            confirmDelete() {

                if( this.checked.length <= 0 ) {
                    this.alert(); return;
                }else {
                    Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Confirm'
                    }).then((result) => { 
                        if( result.isConfirmed ) {
                            this.delete();
                        }
                    });
                }

                
            },

            async delete() {
                let url = this.baseUrl() + 'api/product/' + this.checked;
               
                await axios.delete(url)
                  .then((response) => {

                    Swal.fire(
                      'Deleted!',
                      'Product Item/s has been removed',
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
            },

            editSvg: function () {
              return feather.icons[this.icons.edit].toSvg();
            },
            trashSvg: function () {
              return feather.icons[this.icons.trash].toSvg();
            },
             chevronLeftSvg: function () {
              return feather.icons[this.icons.chevron.left].toSvg();
            },
            chevronRightSvg: function () {
              return feather.icons[this.icons.chevron.right].toSvg();
            },
            checkSvg: function () {
              return feather.icons[this.icons.check].toSvg();
            },
            xSvg: function () {
              return feather.icons[this.icons.x].toSvg();
            },
            plusSvg: function () {
              return feather.icons[this.icons.plus].toSvg();
            }
        },

        watch: {

            'search'(newValue) {
                this.filtered =  this.products.filter( product => {
                    let name = product.product_name;
                    let category = product.category.name;
                    let data = name + ' ' + category;
                    return data.toLowerCase().includes(this.search.toLowerCase());
                } );

                this.initializePagination();
             
            }
        },

        mounted() {
            this.fetchData();
        }

    };
</script>

<style>

.featured-image img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.tool-box > .tool {
    align-items: center;
    background: #f1f1f1;
    border-radius: 50%;
    display: flex;
    height: 30px;
    justify-content: center;
    width: 30px;
}

.tool-box > .tool:hover{
    background:#CCC;cursor: pointer;
}

.tool-box > .tool svg {
    stroke-width: 1.5;
    color: inherit!important;
    height: 18px;
    width: 18px
}

.tool-box > .tool i {
    color: inherit;
    font-size: 18px
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