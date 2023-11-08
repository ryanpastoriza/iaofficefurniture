@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')

<section>
  <div class="container">

    <div class="row g-3 align-items-center mb-3">

    	<div class="col-auto" style="font-size: 13px;">Sort by:</div>
     	<div class="col-auto">
	        <select class="form-select form-select-sm">
	          <option>Default Sorting</option>
	          <option>Featured</option>
	          <option>Price - Low to High</option>
	          <option>Price - High to Low</option>
	        </select>
      	</div>
      	<div class="col-auto" style="font-size: 13px;"><b>{{ count($products) }}</b> Product/s found</div>

    </div>

    <div class="row">

      @if( count($products) > 0 )

        @foreach ( $products as $product )

          <div class="col-2 mb-4">
            <div class="product-item">
              <a href="{{ route('shop.product', $product->slug) }}">
              <div class="pi-img">
                <img src="{{ $product->img_src['featured'] }}/{{ $product->featured_image }}">
              </div>

              <div class="pi-info">
                <div class="pi-code">{{ $product->product_code }}</div>
                <div class="pi-name">{{ Str::title($product->product_name) }}</div>
                <div class="pi-price">&#8369; {{ number_format($product->price, 2) }}</div>
              </div>
          	  </a>

            </div>

          </div>

        @endforeach

      @endif


    </div>

  </div>
</section>

</main>

@include('web._shared.footer')

@endsection