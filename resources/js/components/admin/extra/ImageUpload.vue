<template>
	<div class="file-container">
			
			<div class="file-upload">
				<input type="file" ref="imageupload" @change="browse">
			</div>

			<div class="file-action d-flex flex-row flex-wrap gap-2">

				<button class="btn btn-primary" @click.prevent="trigger">
					 <i class="align-middle" data-feather="upload-cloud"></i>
				</button>

				<button class="btn btn-danger" @click.prevent="removeImage">
					 <i class="align-middle" data-feather="x"></i>
				</button>
			</div>

			<div class="file-preview">
				<picture>
				  <source :srcset="preview">
				  <img :src="placeholder" class="thumbnail">
				</picture>
			</div>

	</div>
</template>

<script>

export default {

	name : 'ImageUpload',

	emits: ['update:modelValue'],
	props: {
		placeholder: {
			type: String,
			default: ''
		},
		modelValue: null
	},

	data() {
		return {
			preview: null,
			allowed: ['image/jpeg', 'image/png', 'image/webp']
		}
	},

	watch: {
		modelValue: {
	      handler(val) {

	      	if( typeof val == 'string' ) {
	      		this.convert(val);
	      		return;
	      	}
	        this.setValue(val);
	      },
	      deep: true
	    },
 	},

	methods: {

		trigger() {
			this.$refs.imageupload.click();
		},

		browse(event) {
			let file = event.target.files[0];

			if( this.verify(file.type) ) {
				this.setValue(file);
				this.preview = URL.createObjectURL(file);
			}
		},

		setValue(val) {

			if( !val ) {
				this.preview = null;
			}
			this.$emit('update:modelValue', val);
		},

		async convert(url) {
			await fetch(url).then(response => response.blob())
  			.then(blob => {
  				if( this.allowed.includes(blob.type) ) {
  					this.preview = URL.createObjectURL(blob);
  				}else {
  					this.preview = null;
  				}
  				
  				
 			});
		},

		removeImage() {
			this.preview = this.convert(this.placeholder);
			this.setValue(null);
		},

		verify(type) {

	    	if( this.allowed.includes(type) ) {
	    		return true;
	    	}
			return false;
	    }

	},

	mounted() {
		// this.$emit('onPreview', this.fileUrl);
		// this.setValue(this.fileUrl);
		// console.log(this.url)
	}
};


</script>

<style>

.file-container {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	position: relative;
	border: 2px dashed #555;
	padding: 5px;
}

.file-container div.file-action {
	position: absolute;
	background: rgba(0, 0, 0, 0.5);
	padding: 5px;
	bottom: 10px;
}

.file-container div.file-upload {
	position: absolute;
	display: none;
}

.file-container div.file-preview .thumbnail {
	/*max-height: 100%;*/
    max-width: 100%;
    object-fit: contain;
}
	
</style>