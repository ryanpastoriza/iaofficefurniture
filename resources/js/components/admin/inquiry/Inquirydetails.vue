<template>
	<div class="card">
        <div class="card-body p-4">

        	<h5 class="inquiry-subject mb-4">{{ titleCase(inquiry.subject) }}</h5>

          	<div class="d-flex flex-row gap-2">

	          	<div>
	          		<img :src="baseUrl() + 'img/profile_mask2.png'" style="width: 40px; height: 40px;border-radius: 50%; background-color: #CCC;">
	          	</div>

	          	<div class="d-flex flex-column align-content-start w-100">
	          		<div class="d-flex flex-row justify-content-between">
	          			<span class="inquiry-name">{{ titleCase(inquiry.name) }}</span>
	          			<span class="inquiry-time">{{ inquiry.date }}</span>
	          			<!-- Sun, Sep 17, 3:41 PM (3 days ago) -->
	          		</div>
		            <!--   <span class="mailbox-read-time float-right">Date</span> -->
		          	<div class="inquiry-email">&lt;{{ inquiry.email_address }}&gt;</div>
	          	</div>
            
          	</div>

          	<div class="inquiry-message p-5 mt-3">
            
	            <div class="message">{{ inquiry.message }}</div>
	          	<div class="inquiry">{{ inquiry.inquiry }}</div>

          	</div>

        </div>
    </div>
	
</template>

<script>
 

    export default {

    	props: ['identifier'],

    	data() {
    		return {
    			inquiry: {
    				inquiry_id: 0,
    				name: '',
    				email_address: '',
    				contact_number: '',
    				subject: '',
    				message: '',
    				inquiry: ''
    			}
    		}
    	},

    	methods: {

    		fetchInquiryDetails() {
    			axios.get(this.baseUrl() + 'admin/inquiry/' + this.identifier).then((response) => {
                    this.inquiry = response.data.data;
                });
    		}

    	},

    	async mounted() {
    		this.fetchInquiryDetails();
    	}

    }

</script>
<style>
.mailbox-date {
	font-size: 12px;
}

.inquiry-message {
	border: 1px solid #f1f1f1;
}

.inquiry {
	font-weight:600;
	font-size: 14px;
	margin-top: 10px;
}

.inquiry-subject {
	font-size: 29px;
	font-weight: 500;
}

.inquiry-name {
	font-size: 0.875rem;
	font-weight: bold;
}

.inquiry-time {
	font-size: 12px;
	color: #5e5e5e;
}

.inquiry-email {
	font-size: 12px;
}
</style>