<div class="col-12">
  <div class="fp-slider swiper">
    <div class="ia-collections swiper-wrapper">
    
       @foreach ($featuredProducts as $product)
      <div class="swiper-slide">
        <a href="{{ route('shop.product', $product->slug) }}" class="product-item">

          <div class="item-image">
            <img src="{{ url($product->featuredImg) }}" alt="{{ $product->product_name }} Image">
          </div>

          <div class="item-information text-center">
              <h3 class="">{{ $product->product_code }}</h3>
              <h5>{{ $product->product_name }}</h5>
          </div>

          <div class="item-price">
              @if( $product->on_demand )
                <div class="badge bg-main">Call For Pricing</div>
              @else 
                 &#8369; {{ number_format($product->price, 2) }}
              @endif
          </div>

        </a>
      </div>
    @endforeach

    </div>
    <div class="swiper-button swiper-button-prev"></div>
    <div class="swiper-button swiper-button-next"></div>
  </div>
</div>