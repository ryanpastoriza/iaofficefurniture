<template>
<div class="col-12 col-lg-3">
    <categorycreate ref="categoryForm" :reloadCategoryList="reloadCategoryList"></categorycreate>
</div>

<div class="col-12 col-lg-9">
    <categorylist ref="categoryTable" @view-category="display"></categorylist>
</div>
</template>

<script>
    
    import Categorylist from './Categorylist';
    import Categorycreate from './Categorycreate';
    import { ref, readonly } from 'vue';

    export default {

        components: {
            Categorylist,
            Categorycreate
        },

        methods: {

            display(category) {
                this.$refs.categoryForm.fill(category);
            },

            reloadCategoryList() {
                this.$refs.categoryTable.reload();
            }
            
        }
    }
</script>