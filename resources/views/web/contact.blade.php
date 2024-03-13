@extends('web/_layout.app')
@section('content')

<main id="main">

<div class="container gx-md-5 py-5">

  <div class="row mb-4">
      <!-- <div class="col-12"> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.949865612878!2d121.03811077590565!3d14.71542652425352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0e4ca9f3623%3A0xb82c259b774c551d!2sAlfina%20Building!5e0!3m2!1sen!2sph!4v1709878828584!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <!-- </div> -->
  </div>

  <hr />
  
  <div class="row mb-4">

    <div class="col-12 mt-3 mb-3">
      <div class="header-title mb-2">
        <h2>Get In Touch With Us</h2>
      </div>
    </div>

    
    @include('web._shared.inquiry_form')
    
  </div>

</div>


</main>

@include('web._shared.footer', $categories)

@endsection

  