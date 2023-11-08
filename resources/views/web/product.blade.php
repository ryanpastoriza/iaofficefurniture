@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')

<section>
  <div class="container">

    <div class="row g-3">
      
      <div class="col-12">

        <div class="card mb-3 border-0">
          <div class="row g-0 pd-item">

            <div class="col-md-4">

              <div class="col-12 d-flex justify-content-center pointer">
                <img  class="pd-img p-image-lb" src="{{ $product->img_src['featured'].'/'.$product->featured_image }}">    
              </div>

              <div class="col-12 py-3">
               <div class="d-flex flex-wrap">
              @if( count($product->other_images) > 0 )
                @foreach($product->other_images as $img) 

                  <div class="p-2 pd-thumb-cont pointer">
                    <img class="pd-thumb p-image-lb" src="{{ $product->img_src['others'].'/'.$img }}">
                  </div>

                @endforeach
              @endif
                </div>
              </div>
              
            </div>

            <div class="col-md-6 ps-4">
              <div class="card-body">
                <div class="pb-2 pd-divider">
                  <div class="pd-category">{{ Str::title($product->category) }}</div>
                  <div class="pd-name">{{ $product->product_code }} - {{ Str::title($product->product_name) }}</div>
                  <div class="mt-2 pd-price">&#8369; {{ number_format($product->price, 2) }} </div>
                  <!-- <div class="mt-2 price"><del>₱ 0.00</del></div> -->
                  <!-- <div class="mt-2 pd-price">Call for pricing</div> -->
                </div>
                @if( $product->dimension )
                  <div class="mt-2">
                    <div class="pd-label">Dimension:</div>
                    <div class="pd-val">{{ $product->dimension }}</div>
                  </div>
                @endif
                @if( $product->materials )
                  <div class="mt-2">
                    <div class="pd-label">Materials:</div>
                    <div class="pd-val">{{ $product->materials }}</div>
                  </div>
                @endif
                @if( $product->product_description )
                  <div class="mt-2">
                    <div class="pd-label">Description:</div>
                    <div class="pd-val">{{ $product->product_description }}
                    </div>
                  </div>
                @endif
                <div class="mt-4 pb-3">
                  <button class="btn-inquire rounded-0">Inquire Item</button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

<section class="p-0">
  <div class="container">

    <div class="row g-3">
      <div class="col d-flex justify-content-start flex-column mb-3">
        <div class="section-title">You may also like</div>
        <!-- <div class="section-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</div> -->
      </div>
    </div>

    <div class="row">

      @if( count($randomProducts) > 0 )

        @foreach ( $randomProducts as $product )

          <div class="col-2 mb-4">
            <div class="product-item">
              <a href="{{ route('shop.product', $product->slug) }}">
              <div class="pi-img">
                <img src="{{ $product->img_src }}/{{ $product->featured_image }}">
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


<!-- Inquire Item modal -->
<div class="modal inquire-product-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inquiry Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          
          <div class="col-12 px-4">

            <div class="row p-2 inquired-item" style="box-sizing: border-box; justify-content: center;">
              <div class="col-6 d-flex flex-column">
                <span class="badge bg-primary">Product</span>
                <div class="inquired-product text-center text-truncate" style="font-size: 13px;"></div>
              </div>

              <div class="col-6 d-flex flex-column">
                <span class="badge bg-primary">Price</span>
                <div class="inquired-price text-center" style="font-size: 13px;"></div>
              </div>
            </div>

          </div>

          <div class="col-12 contact">
             <form class="php-email-form" action="{{ route('inquiry.store') }}" method="post" id="product-inquiry-form">
              @csrf
              <input type="hidden" name="page" value="product-details">
              <input id="inquiry" type="hidden" name="inquiry" />
              
              <div class="form-group mt-3">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
              </div>

              <div class="form-group mt-3">
                <input type="number" class="form-control" name="contact_number" placeholder="Contact Number" required>
              </div>

              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email_address" placeholder="Email" required>
              </div>

              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>

              <div class="mt-2 text-center">
                <button type="submit" class="btn-block">Send Message</button>
              </div>
            </form>
          </div>
         
        </div>


      </div>
    </div>
  </div>
</div>
</main>

@include('web._shared.clients')
@include('web._shared.footer')

@endsection