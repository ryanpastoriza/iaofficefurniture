<div class="col-12 mb-3">
	<div class="sc-slider swiper">
	<div class="swiper-wrapper">
	@foreach ($subcategories as $subcategory)
		<div class="swiper-slide">
			<a class="box-item" href="{{ route('shop.category', $subcategory->slug) }}">
				<div class="ia-image w-100 h-75">
					<img src="{{ url($subcategory->featuredImage) }}" alt="{{ Str::title($subcategory->name) }} Image">
				</div>
				<div class="ia-title w-100 text-center d-flex flex-column">
					<span>{{ Str::title($subcategory->name) }}</span>
					<span class="text-muted">{{ Str::title($subcategory->parent) }}</span>
				</div>
			</a>
		</div>
	@endforeach
	</div>
	<div class="swiper-button swiper-button-prev"></div>
    <div class="swiper-button swiper-button-next"></div>
    </div>
</div>