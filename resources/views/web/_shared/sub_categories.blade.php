<section>
  <div class="container">
  	@foreach ( $categories as $category )
		@if( count($category->subCategories) > 0 )

			<div class="row g-3 justify-content-start align-items-center mb-3">
				<div class="col-auto">
					<div class="section-title-sm">{{ Str::title($category->name) }}</div>
		  		</div>
		  		<div class="col">
					<div class="view-all">
						<a href="{{ route('shop.category', $category->slug) }}" class="btn btn-light btn-sm">View All <i class="fa-solid fa-caret-right"></i> </a>
					</div>
		  		</div>
			</div>
		    
		    <div class="row g-3 mb-3">
		    @foreach ( $category->subCategories as $subCategory )

				<div class="col-6 col-sm-3 col-md-3 col-lg-2 mb-1">
					<a href="{{ route('shop.category', $subCategory->slug) }}">
						<div class="product-item">
						  	
						  	<div class="pi-img">
						  		<img src="{{ $subCategory->image }}">
						  	</div>

							<div class="pi-info text-center">
								<div class="pi-code">{{ Str::title($subCategory->name) }}</div>
							</div>

						</div>
					</a>
				</div>
			@endforeach
			</div>
		@endif
	@endforeach
  </div>
</section>