@extends('web/_layout.app')
@section('content')

<section id="hero" class="d-flex align-items-center">
<div class="container mt-5">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-8">
		  <h1>Endless possibilities. Design Crafted with Excellence</h1>
		  <h2>We provide the most comfortable and convenient working spaces. We deliver the best design to look your home & offices stylish and attractive.</h2>
		  <a href="{{ route('shop') }}" class="btn-get-started mt-3">
		  	<span>Shop Now</span>
		  	<i class="bi bi-arrow-right"></i>
		  </a>
		</div>
  	</div>

</div>
</section>

<main id="main" class="mt-4">
<div class="container gx-md-5 py-5">

	<div class="row mb-4">
		<!-- our services -->
		<div class="col-12 our-services p-3">
			<div class="icon-boxes d-flex flex-column justify-content-center">
	        	<div class="row d-flex flex-wrap justify-content-evenly row-cols-1 row-cols-md-3">
	                <div class="col d-flex align-items-stretch mt-2">
	                  <div class="icon-box">
	                    <i class="bx bx-layer-minus"></i>
	                    <h4>Ready made item customizing</h4>
	                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
	                  </div>
	                </div>
	                <div class="col d-flex align-items-stretch mt-2">
	                  <div class="icon-box">
	                    <i class="bx bx-color-fill"></i>
	                    <h4>Free layout design</h4>
	                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
	                  </div>
	                </div>
	                <div class="col d-flex align-items-stretch mt-2">
	                  <div class="icon-box">
	                    <i class="bx bx-trip"></i>
	                    <h4>Free ocular visit</h4>
	                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
	                  </div>
	                </div>
	          	</div>
	        </div>
		</div>
	</div>

	<!-- categories -->
	<div class="row mb-4">
		
		<div class="col-12 mb-3">
			<div class="header-title mb-2">
				<h1>Our Categories</h1>
			</div>
		</div>

		@include('web._shared.main_categories', $categories)
	</div>

	<hr />

	<!-- subcategories -->
	<div class="row mb-4">

		<div class="col-12 mt-3 mb-3">
			<div class="header-title mb-2">
				<h2>Check out more</h2>
			</div>
		</div>

		@include('web._shared.sub_categories', $subcategories)

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

	<hr />

	<div class="row p-3 mb-4">
<!-- 		<div class="col-1"></div> -->
		<div class="col-sm-12 col-md-5 offset-md-1 d-flex flex-column justify-content-center">
		  	<div style="font-size: 19px; font-weight: 500; letter-spacing: 1px;">About Us</div>
		  	<div style="font-size: 40px; font-weight: 500; letter-spacing: .5px;">I&A Office Furniture</div>
		  	<div style="font-size: 15px; color: #555; letter-spacing: 1px;">
		  		<!-- is an online furniture business that  -->
		 		We carry a wide array of quality office furniture consisting of tables, chairs, storage systems and other office accessories. It is also engaged in the installation of high quality office furniture system, office renovation and modular partitions.. .
			</div>
		  <a href="" class="btn-get-started mt-3 rounded-0" style="width: fit-content;"> Know more <i class="bi bi-arrow-right"></i> </a>
		</div>
		<div class="col-sm-12 mt-4 mt-md-0 col-md-5">
			<img src="{{ URL::to('/') }}/img/about-us.jpg" alt="" style="object-fit: cover; width: 100%;">
		</div>
		<!-- <div class="col-1"></div> -->
	</div>

	<hr />

	<div class="row mb-4">

		<div class="col-12 mt-3 mb-3">
			<div class="header-title mb-2">
				<h2>Featured Products</h2>
			</div>
		</div>

		
		@include('web._shared.featured')
		
	</div>

</div>

</main>

@include('web._shared.footer', $categories)

@endsection