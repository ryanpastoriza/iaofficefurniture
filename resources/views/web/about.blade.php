@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')

    <section class="">
		<div class="container">

			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

		        <div class="col-5 p-2">
					<img src="{{ URL::to('/') }}/img/about-us.jpg" class="card-img-top" alt="...">
		        </div>

		        <div class="col-7 p-4 d-flex flex-column">

		        	
					  <h1 class="mt-3" style="font-size: 28px; font-weight: 700;">I&A Office Furniture Shop</h1>
					    <small class="mt-2" style="font-size: 15px; color: #7f7f7f;">
					   I&A is an online furniture business that carries a wide array of quality office furniture consisting of tables, chairs, storage systems and other office accessories. It is also engaged in the installation of high quality office furniture system, office renovation and modular partitions. 
					    </small>

					    <small  class="mt-3" style="font-size: 15px; color: #7f7f7f;">
					    	I&A caters to its clients’ interior needs such as office blinds and carpets. With its high sense of professionalism nurtured through its brief stint in the business, the company’s clients from the different sectors of small, medium and large companies and organizations are assured of satisfaction in the supply and delivery of its products and services.
					    </small>

					 
					
		        </div>

			</div>

			

		</div>
	</section>

<section class="approach">
	<div class="container">

		<div class="row">
			<div class="col d-flex justify-content-center">
				<div class="section-title">
				  <h2>Our Approach</h2>
				  <!-- <p></p> -->
				</div>
      		</div>
		</div>

		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

	        <div class="col-3 on-demand-item">

	        	<div class="card" style="padding: 30px;">
				  <img src="{{ URL::to('/') }}/img/about-us.jpg" class="card-img-top" alt="...">
				  <div class="card-body d-flex flex-column text-center">
				     <h4 class="title mt-3">Integrity</h4>
              <p class="description">We design solutions, rather than just fulfilling requirements. This requires research, engagement with the task at hand and innovative thinking.</p>
				  </div>
				</div>

	        </div>

			<div class="col-3">

	        	<div class="card" style="padding: 30px;">
				  <img src="{{ URL::to('/') }}/img/about-us.jpg" class="card-img-top" alt="...">
				  <div class="card-body d-flex flex-column text-center">
				  <h4 class="title mt-3">Commitment</h4>
              <p class="description">Like our products, we perform at the highest level possible. Our superior performance not only keeps our customer’s happy, but it enriches our lives too.</p>
				  </div>
				</div>

	        </div>

	        <div class="col-3">

	        	<div class="card" style="padding: 30px;">
				  <img src="{{ URL::to('/') }}/img/about-us.jpg" class="card-img-top" alt="...">
				  <div class="card-body d-flex flex-column text-center">
				   <h4 class="title mt-3">Reliability</h4>
              <p class="description">To render durability - proven products that are suited to industrial applications: manufacturing, residential, commercial and others.</p>
				  </div>
				</div>
				
	        </div>

	         <div class="col-3 d-flex">

	        	<div class="card flex-grow" style="padding: 30px;">
				  <img src="{{ URL::to('/') }}/img/about-us.jpg" class="card-img-top" alt="...">
				  <div class="card-body d-flex flex-column text-center">
				   <h4 class="title mt-3">Dependability</h4>
              <p class="description">We work hard to create and build long term relationships with our customers, our suppliers, and our staffs.</p>
				  </div>
				</div>
				
	        </div>
		</div>

	</div>
</section>


	<section class="our-services" style="background-color: #fff;">
	<div class="container">
		<div class="row">
	      	<!-- <div class="col-lg-2 d-flex align-items-stretch"></div> -->
	      	<div class="col-lg-12 d-flex align-items-stretch">
		        <div class="icon-boxes d-flex flex-column justify-content-center">
		        	<div class="row d-flex flex-wrap justify-content-evenly">
		                <div class="col-xl-1 d-flex align-items-stretch">
		                 
		                </div>
		                <div class="col-xl-5">
		                  <div class="icon-box mt-4 mt-xl-0">
		                    <!-- <i class="bx bx-color-fill"></i> -->
		                    <h4>Mission</h4>
		                    <p>To address the furniture needs of its clients with quality products and efficient service. To help boost the country’s employment program by hiring skilled workers. To help propel the economy by revenues derived from its business.</p>
		                  </div>
		                </div>
		                <div class="col-xl-5 d-flex align-items-stretch">
		                  <div class="icon-box mt-4 mt-xl-0">
		                   <!--  <i class="bx bx-trip"></i> -->
		                    <h4>Vision</h4>
		                    <p>To be the number one leading provider of quality yet affordable office furniture sets in the Philippines.</p>
		                  </div>
		                </div>
		                <div class="col-xl-1">
		                 
		                </div>
		          	</div>
		        </div>
	      	</div>
	      	<!-- <div class="col-lg-2 d-flex align-items-stretch"></div> -->
		</div>
	</div>
</section>
</main>

@include('web._shared.clients')
@include('web._shared.footer')

@endsection