@extends('web/_layout.app')
@section('content')


<main id="main">

<div class="container gx-md-5 py-5">

  <div class="row">
    
    <div class="col-12 product-summary mt-4 bg-white mb-3">

      <div class="single-product">

        <div class="row">
          
          <div class="col-lg-6 col-12 col-md-6 product-image d-flex justify-content-center">
            <img src="{{ url($product->featuredImg) }}" alt="">
          </div>

          <div class="col-lg-6 col-12 col-md-6 summary d-flex flex-column gap-3">
            <div class="title">{{ $product->product_code }} - {{ Str::title($product->product_name) }}</div>
            <div class="d-flex flex-row">
              <i class="bi bi-star me-1"></i>
              <i class="bi bi-star me-1"></i>
              <i class="bi bi-star me-1"></i>
              <i class="bi bi-star me-1"></i>
              <i class="bi bi-star me-1"></i>
            </div>
            <div class="price">&#8369; {{ number_format($product->price, 2) }}</div>
            <div class="description">{{ $product->product_description }}</div>
            <div class="description d-flex flex-column pt-1"> 
              <div class="label">Category:</div>
              <div class="value">
                <span class="badge bg-primary">{{ $product->category->main->name }}</span>
                <span class="badge bg-primary">{{ $product->category->name }}</span>
              </div>
            </div>
            <div class="product-view d-flex flex-row justify-content-start gap-3 border-top py-3" data-price="{{ number_format($product->price, 2) }}" data-product="{{ $product->product_code }}">
              <button class="btn btn-inquire" data-bs-toggle="offcanvas" data-bs-target="#item-inquiry-form" aria-controls="item-inquiry-form">Inquire Item</button>
              <button class="btn btn-cart" disabled> <i class="bi bi-cart"></i> Add to Cart</button>
            </div>
          </div>

        </div>
        
      </div>

    </div>

    <hr />

  </div>
</div>

 <aside class="bd-sidebar">
      <div class="offcanvas offcanvas-end" tabindex="-1" id="item-inquiry-form" aria-labelledby="item-inquiry-form-label">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="">Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
         <div class="row">
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
    </aside>


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

@include('web._shared.footer', $categories)

@endsection