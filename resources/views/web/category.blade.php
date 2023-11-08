@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')

<section class="py-0 mt-3">
  <div class="container">
  
    @if( count($category->subCategories) > 0 )
        
      <div class="row g-3 mb-3">
      @foreach ( $category->subCategories as $subCategory )

        <div class="col-6 col-sm-3 col-md-3 col-lg-2 mb-1">
          <a href="{{ route('shop.category', $subCategory->slug) }}">
            <div class="product-item">
                
                <div class="pi-img">
                  <img src="{{ $subCategory->image }}">
                </div>

              <div class="pi-info text-center">
                <div class="pi-code">{{ Str::title($subCategory->name) }} ({{ $subCategory->product_count }})</div>
              </div>

            </div>
          </a>
        </div>

      @endforeach
      </div>
    @endif

  </div>
</section>


<section class="p-0">
  <div class="container">

    <div class="row g-3 mb-3">
      <div class="col py-2" style="font-size: 13px; background-color: #f1f1f1;">
        <b>{{ count($products) }}</b> Products found
      </div>
    </div>

    <div class="row g-3 align-items-stretch mb-3 d-flex">
     <div class="col-auto d-flex align-items-center" style="font-size: 13px;">Sort by:</div>
     <div class="col-auto d-flex align-items-center">
        <select class="form-select form-select-sm">
          <option>Default Sorting</option>
          <option>Featured</option>
          <option>Price - Low to High</option>
          <option>Price - High to Low</option>
        </select>
      </div>

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
                <div class="pi-name">{{ $product->product_name }}</div>
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

@include('web._shared.clients')
@include('web._shared.footer')

@endsection