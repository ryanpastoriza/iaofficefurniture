@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')


<section class="no-padding">

    <div class="container contact">

    	<!-- <div class="row">
  			<div class="col d-flex justify-content-center">
  				<div class="section-title">
  				  <h2>Message</h2>
  				  <p>Thank you for visiting our website. We value your interest in our services and would love to hear from you. You can reach us at the following:</p>
  				</div>
        </div>
  		</div>
 -->
        <div class="row">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Unit 3 Alfina Bldg, 892 Quirino Highway, Quezon City, 1117 Metro Manila</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>sample@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>8461-6279/ 8232-1452/ 8232-1454</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            
         <!--    @if(session('status'))
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">{{ session('status')['header'] }}</h4>
              <p>{{ session('status')['message'] }}</p>
            </div>
            @endif -->
           
            <form class="php-email-form" action="{{ route('inquiry.store') }}" method="post" id="inquiry-form">
              @csrf
              <input type="hidden" name="page" value="contact">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="number" class="form-control" name="contact_number" placeholder="Contact Number" required>
                </div>
              </div>

                <div class="form-group mt-3">
                <input type="email" class="form-control" name="email_address" placeholder="Your Email" required>
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
</section>




</main>

@include('web._shared.clients')
@include('web._shared.footer')

@endsection