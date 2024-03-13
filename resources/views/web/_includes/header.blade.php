 <header id="header" class="fixed-top">

    <div class="container d-flex justify-content-start justify-content-sm-start align-items-center gap-3">

      <a href="index.html" class="logo">
        <img class="d-none d-md-flex " src="{{ URL::to('/') }}/img/logo-ianda.png" alt="">
        <img class="d-flex d-md-none" src="{{ URL::to('/') }}/img/icon-ianda.webp" alt="">
      </a>

      <nav id="navbar" class="navbar order-last order-lg-0 justify-content-center">
        <ul>
          <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}"> Home</a></li>
          <li><a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
          <!-- <li><a class="nav-link" href="">Gallery</a></li> -->
          <li><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact</a></li>
          <li><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about-us') }}"> About</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav"></i>
      </nav>

       <form id="search-form" class="d-flex justify-content-end nav-search-form" role="search" action="{{ route('product.search', '') }}" method="GET">
          <div class="input-group">
            <input type="search" name="search" autocomplete="off"class="form-control" placeholder="Search office furniture" aria-label="Search">
            <button class="btn btn-search" type="submit">
                  <i class="bi bi-search"></i>
            </button>
          </div>
       </form>

      <!--   <div class="offcanvas offcanvas-top" tabindex="-1" id="mobileSearch" aria-labelledby="mobileSearchLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="">Search office furniture</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div>
               <form class="d-flex justify-content-center nav-search-form-mobile" role="search">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control rounded-0" aria-label="Search">
                    <button class="btn btn-search" type="submit">
                         <i class="bi bi-search"></i>
                    </button>
                  </div>
               </form>
            </div>
          </div>
        </div>
       
        <div class="d-block d-sm-none d-flex justify-content-center ">
          <button class="btn btn-search-mobile" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSearch" aria-controls="mobileSearch">
                <i class="bi bi-search"></i>
          </button>
        </div> -->

    </div>

    <aside class="bd-sidebar">
      <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="">Pages</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          
          <!-- <div class="container-fluid">
            <div class="row">
              <div class="col-12"> -->
                <nav class="navbar">
                <ul class="nav flex-column">
                  <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                  <li><a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
                  <li><a class="nav-link" href="">Gallery</a></li>
                  <li><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact</a></li>
                  <li><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about-us') }}">About</a></li>
                </ul>
                </nav>
            <!--   </div>
            </div>
          </div> -->
            
          
        </div>
      </div>
    </aside>
  </header>
