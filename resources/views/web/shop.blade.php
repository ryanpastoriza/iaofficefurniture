@extends('web/_layout.app')
@section('content')

<main id="main" style="margin-top: 90px;">

@include('web._shared.breadcrumbs')

@include('web._shared.parent_categories', $categories)

@include('web._shared.sub_categories', $categories)

@include('web._shared.featured', $featuredProducts)

<!-- <section style="border-top: 1px solid #f1f1f1; border-bottom: 1px solid #f1f1f1;">
  <div class="container">

  	<div class="row g-3">
		<div class="col d-flex justify-content-start flex-column mb-3">
			<div class="section-title">Products You May Like</div>
			<div class="section-subtitle">Enjoy our unlimited products at affordable price! Below are our popular products.</div>
  		</div>
	</div>


    <div class="row">

          <div class="col-2 mb-4">
           
            <div class="product-item">
              	
              	<div class="pi-img">
              		<img src="{{ URL::to('/') }}/img/mid-back-mesh-chair.jpg">
              	</div>

				<div class="pi-info">
					<div class="pi-code">CH230A</div>
					<div class="pi-name">Stackable Visitor Chair</div>
					<div class="pi-price">&#8369; 10, 904.00</div>
				</div>

            </div>
          
          </div>

            <div class="col-2 mb-4">
           
          <div class="product-item">
              	
              	<div class="pi-img">
              		<img src="http://iafurniture.test/storage/uploads/products/1/high-back-mesh-chair.jpg">
              	</div>
              	
				<div class="pi-info">
					<div class="pi-code">CH230A</div>
					<div class="pi-name">Stackable Visitor Chair</div>
					<div class="pi-price">&#8369; 10, 904.00</div>
				</div>

            </div>
          
          </div>

          <div class="col-2 mb-4">

          	    <div class="product-item">
              	
              	<div class="pi-img">
              		<img src="http://iafurniture.test/storage/uploads/products/2/file-storage-cabinet.jpg">
              	</div>
              	
				<div class="pi-info">
					<div class="pi-code">CH230A</div>
					<div class="pi-name">Stackable Visitor Chair</div>
					<div class="pi-price">&#8369; 10, 904.00</div>
				</div>

            </div>
          
          </div>
    </div>

  </div>
</section> -->

</main>

@include('web._shared.clients')
@include('web._shared.footer')



@endsection