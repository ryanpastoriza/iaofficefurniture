<section>
  <div class="container">

    <div class="row g-3">
      <div class="col d-flex justify-content-start flex-column mb-3">
        <div class="section-title">Featured Products</div>
        <div class="section-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</div>
      </div>
    </div>

      <div class="row g-3">


      @foreach ($featuredProducts as $product)

        <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3">

              <a href="{{ route('shop.product', $product->slug) }}">
              <div class="card align-items-center product">
                <img src="{{ $product->img_src['featured'] }}/{{ $product->featured_image }}">

                <div class="card-body d-flex flex-column text-center">
                  <div class="product__info border-0">
                    <div class="product__category">{{ Str::title($product->category) }}</div>
                      <div class="product__code">{{ $product->product_code }} - {{ Str::title($product->product_name) }}</div>
                      <div class="product__price">&#8369; {{ number_format($product->price, 2) }}</div>
                    </div>
                </div>
              </div>
              </a>

        </div>

    @endforeach


      </div>

    </div>
</section>