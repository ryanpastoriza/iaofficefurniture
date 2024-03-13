 <div class="col-12 bg-white">
 <div class="row p-2">
  <div class="sort d-flex flex-row gap-3 justify-content-start p-2">

    <div class="align-self-center label">Sort By</div>
 
    <ul class="list-unstyled m-0 list d-flex flex-row">
      <li class="list-item">
         <select class="form-select form-select-sm" id="filter-products">
            <option value="">Default</option>
            <option value="l2h">Price: Low - High</option>
            <option value="h2l">Price: High - Low</option>
          </select>  
      </li>
    </ul>
    
  </div>
</div>

@if( count($products) > 0 )
<div id="product-list" class="row ia-collections row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mb-3">
        
    @foreach ($products as $product)
        <div class="col gy-3 product-item-box" data-price="{{ $product->price }}">
          <a href="{{ route('shop.product', $product->slug) }}" class="product-item" data-price="{{ $product->price }}">

            <div class="item-image mb-3">
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
@else 
<div class="row g-3 mt-3 mb-3">

  <div class="col-12">
    No Products Found in this Category
  </div>

</div>
@endif
</div>