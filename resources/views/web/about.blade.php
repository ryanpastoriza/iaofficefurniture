@extends('web/_layout.app')
@section('content')

<main id="main">
<div class="container gx-md-5 py-5">

	<div class="row mb-4">
<!-- 		<div class="col-1"></div> -->
		<div class="col-12 col-sm-12 col-md-5 d-flex flex-column justify-content-center">
		  	<!-- <div style="font-size: 19px; font-weight: 500; letter-spacing: 1px;">About Us</div> -->
		  	<div style="font-size: 40px; font-weight: 500; letter-spacing: 1px;">I&A Office Furniture</div>
		  	<div style="font-size: 15px; color: #555; letter-spacing: 1px;">
		  		<!-- is an online furniture business that  -->
		 		We carry a wide array of quality office furniture consisting of tables, chairs, storage systems and other office accessories. It is also engaged in the installation of high quality office furniture system, office renovation and modular partitions.<br /><br />
		 		I&A caters to its clients’ interior needs such as office blinds and carpets. With its high sense of professionalism nurtured through its brief stint in the business, the company’s clients from the different sectors of small, medium and large companies and organizations are assured of satisfaction in the supply and delivery of its products and services.
			</div>
		  <!-- <a href="" class="btn-get-started mt-3 rounded-0" style="width: fit-content;"> Know more <i class="bi bi-arrow-right"></i> </a> -->
		</div>

		<div class="col-12 col-sm-12 col-md-6 offset-md-1">
			<img src="{{ URL::to('/') }}/img/about-us.jpg" alt="" style="object-fit: cover;">
		</div>
		<!-- <div class="col-1"></div> -->
	</div>

	<hr />

	<!-- <section class="approach">
	<div class="container"> -->

	<!-- 	<div class="row">
			<div class="col d-flex justify-content-center">
				<div class="section-title">

				</div>
      		</div>
		</div> -->

	<div class="row gx-3 approach">

		<div class="col-12 mt-3 mb-3">
			<div class="header-title mb-2">
				<h2>Our Approach</h2>
			</div>
		</div>

        <div class="col-3">

        	<div class="card h-100">
			  <div class="d-flex flex-column text-center p-3">
			  	<i class="fas fa-shield h-25" style="font-size: 28px; color: #1977cc; "></i>
			    <h4 class="title mt-3 h-25">Integrity</h4>
          		<p class="description h-50">We design solutions, rather than just fulfilling requirements. This requires research, engagement with the task at hand and innovative thinking.</p>
			  </div>
			</div>

        </div>

		<div class="col-3">

        	<div class="card h-100">
			  <div class="d-flex flex-column text-center p-3">
			  <i class="fas fa-lock" style="font-size: 28px; color: #1977cc; "></i>
			  <h4 class="title mt-3">Commitment</h4>
          <p class="description">Like our products, we perform at the highest level possible. Our superior performance not only keeps our customer’s happy, but it enriches our lives too.</p>
			  </div>
			</div>

        </div>

        <div class="col-3">

        	<div class="card h-100">
			 
			  <div class="d-flex flex-column text-center p-3">
			  	<i class="fas fa-link" style="font-size: 28px; color: #1977cc; "></i>
			   <h4 class="title mt-3">Reliability</h4>
          <p class="description">To render durability - proven products that are suited to industrial applications: manufacturing, residential, commercial and others.</p>
			  </div>
			</div>
			
        </div>

         <div class="col-3">

        	<div class="card h-100">
		
			  <div class="d-flex flex-column text-center p-3">
			  	<i class="fas fa-user-check" style="font-size: 28px; color: #1977cc; "></i>
			   <h4 class="title mt-3">Dependability</h4>
          <p class="description">We work hard to create and build long term relationships with our customers, our suppliers, and our staffs.</p>
			  </div>
			</div>
			
        </div>
	</div>

<!-- 	</div>
</section> -->


</main>


@include('web._shared.footer', $categories)

@endsection