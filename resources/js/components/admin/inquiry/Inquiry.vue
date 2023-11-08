<template>
<div class="col-12">
	<div v-if="showDetails">
		<button type="button" class="btn btn-light rounded-0 mb-2" @click="backToList">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>Back to Inquiry List
		</button>
		<inquirydetails ref="inquiryDetails" :identifier="identifier"></inquirydetails>
	</div>

	<div v-else>
		<inquirylist ref="inquiryList" @view-inquiry="display"></inquirylist>
	</div>
</div>
</template>

<script>
    
    import Inquirylist from './Inquirylist';
    import Inquirydetails from './Inquirydetails';
    import { ref, readonly } from 'vue';
 
    export default {

        components: {
            Inquirylist,
            Inquirydetails
        },

        data() {
            return {
            	showDetails: false,
            	identifier: 0,
            }
        },

        methods: {

        	display(id) {
        		this.identifier = id;
        		this.showDetails = true;
        	},

        	backToList() {
        		this.identifier = 0;
        		this.showDetails = false;
        	}

        }


    }

</script>