 <header id="header" class="fixed-top">
    <div class="container d-flex justify-content-between justify-content-sm-between align-items-center">

      <!-- <h1 class="logo"><a href="index.html">IAFurniture</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="logo"><img src="{{ URL::to('/') }}/img/logo-ianda.png"alt=""></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
          <li><a class="nav-link {{ request()->is('office-furniture-shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
          <!-- <li class="dropdown"><a href="#"><span>Products</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact</a></li>
          <li><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ route('about-us') }}">About</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav"></i>
      </nav>

       <form class="d-none d-sm-block d-flex justify-content-center nav-search-form" role="search" action="{{ route('product.search') }}" method="GET">
          <div class="input-group">
            <input type="search" name="s" class="form-control rounded-0" placeholder="Search office furniture" aria-label="Search">
            <button class="btn btn-search" type="submit">
                  <i class="bi bi-search"></i>
            </button>
          </div>
       </form>

       <aside class="bd-sidebar">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div>
              Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
            </div>
          </div>
        </div>
        </aside>

        <div class="offcanvas offcanvas-top" tabindex="-1" id="mobileSearch" aria-labelledby="mobileSearchLabel">
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
        </div>

    </div>
  </header>
