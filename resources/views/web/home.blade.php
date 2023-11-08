@extends('web/_layout.app')
@section('content')

 <!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
<div class="container">
<h1>Endless possibilities with design Crafted with Excellence</h1>
  <h2>I&A is an online furniture business that carries a wide array of quality office furniture consisting of tables, chairs, storage systems and other office accessories.</h2>
  <a href="" class="btn-get-started scrollto mt-3 rounded-0">Shop Now </a>
</div>
</section><!-- End Hero -->

<main id="main">

<section class="pb-0">
	<div class="container">

		<div class="row g-3">
			<div class="col d-flex justify-content-center align-items-center flex-column mb-3">
				<div class="section-title">I&amp;A Office Furniture Shop</div>
				<div class="section-subtitle text-center">
					<div>Comfortable and Convenient, Stylish and Attractive. Crafted with Excellence.</div> 
				</div>
      		</div>
		</div>

		
	</div>
</section>

<section class="our-services">
	<div class="container">
		<div class="row">
	      	
	      	<div class="col-lg-12 d-flex align-items-stretch">
		        <div class="icon-boxes d-flex flex-column justify-content-center">
		        	<div class="row d-flex flex-wrap justify-content-evenly">
		                <div class="col-xl-4 d-flex align-items-stretch">
		                  <div class="icon-box mt-4 mt-xl-0">
		                    <i class="bx bx-layer-minus"></i>
		                    <h4>Ready made item customizing</h4>
		                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
		                  </div>
		                </div>
		                <div class="col-xl-4 d-flex align-items-stretch">
		                  <div class="icon-box mt-4 mt-xl-0">
		                    <i class="bx bx-color-fill"></i>
		                    <h4>Free layout design</h4>
		                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
		                  </div>
		                </div>
		                <div class="col-xl-4 d-flex align-items-stretch">
		                  <div class="icon-box mt-4 mt-xl-0">
		                    <i class="bx bx-trip"></i>
		                    <h4>Free ocular visit</h4>
		                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
		                  </div>
		                </div>
		          	</div>
		        </div>
	      	</div>

		</div>
	</div>
</section>

@include('web._shared.parent_categories', $categories)

@include('web._shared.featured', $featuredProducts)


<section style="background-color: #f1f1f1;">
	<div class="container">

		<div class="row g-3">
	      	<div class="col d-flex justify-content-start flex-column mb-3">
		        <div class="section-title">On Demand Products</div>
		        <div class="section-subtitle">We deliver the best design to look your home & offices stylish and attractive</div>
	         </div>
	    </div>

		<div class="row g-3">

			<div class="col-12 col-sm-12 col-md-6 col-lg-3">

	        	<div class="card border-0 align-items-center p-3">
	        	  <div class="d-flex justify-content-center">
				   <img src="{{ URL::to('/') }}/img/workstation-1.jpg" style="height:300px; width: 100%; object-fit: contain;">
				  </div>
				  <div class="card-body d-flex flex-column text-center">
				    <p class="card-text">Workstation 1</p>
				    <small>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</small>
				  </div>
				</div>

	        </div>

	        <div class="col-12 col-sm-12 col-md-6 col-lg-3">

	        	<div class="card border-0 align-items-center p-3">
	        	  <div class="d-flex justify-content-center">
				   <img src="{{ URL::to('/') }}/img/workstation-2.jpg" style="height:300px; width: 100%; object-fit: contain;">
				  </div>
				  <div class="card-body d-flex flex-column text-center">
				    <p class="card-text">Workstation 2</p>
				    <small>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</small>
				  </div>
				</div>

	        </div>

	        <div class="col-12 col-sm-12 col-md-6 col-lg-3">

	        	<div class="card border-0 align-items-center p-3">
	        	  <div class="d-flex justify-content-center">
				   <img src="{{ URL::to('/') }}/img/workstation-3.jpg" style="height:300px; width: 100%; object-fit: contain;">
				  </div>
				  <div class="card-body d-flex flex-column text-center">
				    <p class="card-text">Workstation 3</p>
				    <small>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</small>
				  </div>
				</div>

	        </div>

	        <div class="col-12 col-sm-12 col-md-6 col-lg-3">

	        	<div class="card border-0 align-items-center p-3">
	        	  <div class="d-flex justify-content-center">
				   <img src="{{ URL::to('/') }}/img/workstation-4.jpg" style="height:300px; width: 100%;  object-fit: contain;">
				  </div>
				  <div class="card-body d-flex flex-column text-center">
				    <p class="card-text">Workstation 4</p>
				    <small>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</small>
				  </div>
				</div>

	        </div>
				
		</div>

	</div>
</section>


</main>

@include('web._shared.clients')
@include('web._shared.footer')

@endsection