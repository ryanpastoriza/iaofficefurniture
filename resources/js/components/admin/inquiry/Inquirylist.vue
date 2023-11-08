<template>
<div class="card">
    <div class="card-body">

       
        <div v-if="filtered.length > 0">

            <div class="mb-3 d-flex justify-content-between">

                <div class="d-flex gap-2">
                    
                    <div class="d-flex">
                        <select class="form-select rounded-0 w-auto" v-model="action">
                            <option value="null" selected>Bulk Actions</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-outline-secondary ms-2 rounded-0" @click.prevent="applyAction">Apply</button>
                    </div>
                    
                </div>

                <div class="d-flex">
                    <div class="d-flex justify-content-end">
                        <input v-model="search" class="form-control rounded-0 w-100" type="text" placeholder="Search" />
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row gap-3 mt-2 justify-content-end mb-3 p-2" style="background-color: #f1f1f1;">

                <div class="d-flex align-items-center">{{ pageInfo() }}</div>
                <div class="d-flex flex-row gap-1 align-items-center">
                    <button class="page" @click="prevPage()" :class="{'inactive' : prevInactive}" :disabled="prev">Prev</button> 
                    <button class="page" @click="nextPage()" :class="{'inactive' : nextInactive}" :disabled="next">Next</button>    
                </div>
            </div>

            <table class="table table-hover my-0">
                <tbody>
                    <tr class="clickable" v-for="inquiry in filteredInquiries" :key="inquiry.inquiry_id" @click="view(inquiry.inquiry_id)">
                        <td class="align-top w-auto">
                            <div class="d-flex">
                                <div><input class="form-check-input" type="checkbox" :value="inquiry.inquiry_id" v-model="checked" @change="check" @click.stop></div>
                                <div class="d-flex ms-2">
                                    <div>{{ titleCase(inquiry.name) }} <span class="inquiry-email">&lt;{{ inquiry.email_address }}&gt;</span> </div>
                                </div> 
                                
                            </div>
                        </td>
                        <td class="align-top w-auto">
                            <div>{{ titleCase(inquiry.subject) }} - <span class="text-muted">{{ inquiry.message.substring(0,40) }}.. .</span></div>
                        </td>
                        <td class="align-top w-auto">
                            <div>{{ inquiry.inquiry ? inquiry.inquiry.substring(0, 30) + '.. .' : inquiry.inquiry }}</div>
                        </td>
                        <td class="align-top w-auto text-end">{{ inquiry.date }}</td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div v-else>

            <div class="text-center">No Data Available</div>
            
        </div>

    </div>
</div>
</template>

<script>

    export default {

        data() {
            return {
                inquiries: [],
                action: null,
                filtered: [],
                search: '',
                checked: [],
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
                return start + ' to ' + end + ' of ' + items;
            },


            fetchData() {
                axios.get(this.baseUrl() + 'admin/inquiry/list').then((response) => {
                    this.inquiries = response.data.data;
                    this.filtered = this.inquiries;
                    this.initializePagination();
                });
            },

            view(id) {
                this.$emit('view-inquiry', id);
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
                    break;
                }

            },

            delete() {

                let url = this.baseUrl() + 'admin/inquiry/destroy/' + this.checked;
               
                axios.delete(url)
                  .then((response) => {

                    console.log(response);
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
            },

        },

        computed: {

            filteredInquiries() {

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
                this.filtered =  this.inquiries.filter( inquiry => {
                    let data = inquiry.name;
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
    padding: 0.3rem 0.55rem;
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
.inquiry-email {
    font-size: 12px;
    color: #999;
}
</style>