<section>
	<div class="container">

	<!-- 	<div class="row g-3">
			<div class="col d-flex justify-content-start flex-column mb-3">
				<div class="section-title">SHOP BY CATEGORY</div>
				<div class="section-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</div>
      		</div>
		</div> -->

		<div class="row g-3">

			@foreach ($categories as $category)

				<div class="col-6 col-sm-4 col-md-4 col-lg-3 pointer">
		          <div class="card category-item">
		            
		            <a class="image-hover-zoom text-center" href="{{ route('shop.category', $category->slug) }}">
		                <img src="{{ $category->image }}">
		                <div class="image-overlay-cover image-overlay-primary d-flex align-items-center justify-content-center text-center">
		                 <p class="overlay-content">VIEW MORE</p>
		                </div>
		            </a>

		            <div class="card-body">
		            	<div class="d-flex justify-content-center category-title">
		                	{{ Str::title($category->name) }}
		              	</div>
		            </div>

		          </div>
		        </div>
			   
			@endforeach

		</div>
	</div>
</section>