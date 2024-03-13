<div class="col-12 mb-3">
	<div class="row flex-wrap">
	@foreach ($categories as $category)
		<div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-4">
			<a class="box-item" href="{{ route('shop.category', $category->slug) }}">
				<div class="ia-image w-100 h-75">
					<img src="{{ url($category->featuredImage) }}" alt="{{ Str::title($category->name) }} Image">
				</div>
				<div class="ia-title text-center">{{ Str::title($category->name) }}</div>
			</a>
		</div>
	@endforeach
	</div>

	<!-- <div class="row justify-content-start mt-2 g-3">
		<div class="col-12">
		<a href="" class="btn-get-started mt-3">
		  <span>View All</span> <i class="bi bi-arrow-right"></i>
		</a>
		</div>
	</div> -->
</div>