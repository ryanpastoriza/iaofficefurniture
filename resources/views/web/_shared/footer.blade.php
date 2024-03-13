<!-- 
<div class="mt-5" style="background: #e8e8e8;">
	<div class="container">
		<div class="row" style="height: 100px;"></div>
	</div>
</div> -->

  <footer id="footer" class="mt-5">

    <div class="footer-top">
      <div class="container">
        <div class="row">

        	<div class="col-lg-2 col-md-6 footer-contact">
	            <div class="mb-2"><img class="d-none d-md-flex " src="{{ URL::to('/') }}/img/icon-ianda.webp" alt="" style="width: 100px;"></div>
	          </div>

            <div class="col-lg-2 col-md-6 footer-links">
	            <h4>Useful Links</h4>
	            <ul>
	              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shop') }}">Shop</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('contact-us') }}">Contact</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('about-us') }}">About</a></li>
	            </ul>
        	</div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Categories</h4>
            <ul>
            @foreach( $categories as $category )
              <li>
              	<i class="bx bx-chevron-right"></i> 
              	<a href="{{ route('shop.category', $category->slug) }}">{{ Str::title($category->name) }}</a>
              </li>
            @endforeach  
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <span style="font-weight: 500;">I&amp;A Office Furniture</span>.
        </div>
      <!--   <div class="credits">
          
        </div> -->
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
       <!--  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
      </div>
    </div>
  </footer>

<!-- <div class="py-5 background-light footer">

	<div class="container">

		<div class="row">
			
		    <div class="col-4 col-lg-2">
		        <h5 class="link-light">Quick Links</h5>
		        <ul class="list-unstyled small mt-4">
		          <li class="mb-2"><a class="text-white" href="{{ route('home') }}">Home</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('shop') }}">Shop</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('contact-us') }}">Contact Us</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('about-us') }}">About Us</a></li>
		        </ul>
		    </div>

		     <div class="col-4 col-lg-2">
		        <h5 class="link-light">Categories</h5>
		        <ul class="list-unstyled small mt-4">
		          <li class="mb-2"><a class="text-white" href="{{ route('home') }}">Home</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('shop') }}">Shop</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('contact-us') }}">Contact Us</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('about-us') }}">About Us</a></li>
		        </ul>
		    </div>

		     <div class="col-lg-3 col-md-6 footer-links">
	            <h4>Our Services</h4>
	            <ul>
	              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
	              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
	            </ul>
	          </div>

		     <div class="col-4 col-lg-2">
		        <h5 class="link-light">About Us</h5>
		        <ul class="list-unstyled small mt-4">
		          <li class="mb-2"><a class="text-white" href="{{ route('home') }}">Home</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('shop') }}">Shop</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('contact-us') }}">Contact Us</a></li>
		          <li class="mb-2"><a class="text-white" href="{{ route('about-us') }}">About Us</a></li>
		        </ul>
		    </div>

		</div>


	

	</div>
</div> -->
<!-- <footer class="background-primary footer">
	<div class="container">

		<div class="row">
			<div class="row d-flex justify-content-evenly mt-2">

			  <div class="col mt-3">
			   <p class="text-white" style="font-size: 13px;"> Copyright © 2023 I&amp;A Office Furniture </p>
			  </div>

			  <div class="col text-end mt-3">
			    <a href="" style="text-decoration: none;">
			    <i class="icon-facebook"></i>
			  </a>
			  <a href="" style="text-decoration: none;" class="ms-2">
			    <i class="icon-instagram"></i>
			  </a>
			  <a href="" style="text-decoration: none;" class="ms-2">
			    <i class="icon-twitter"></i>
			  </a>
			  </div>
			</div>  
		</div>
</footer> -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>