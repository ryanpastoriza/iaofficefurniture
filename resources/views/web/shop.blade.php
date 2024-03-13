@extends('web/_layout.app')
@section('content')

<main id="main">

  <div class="container gx-md-5 py-5">

    <div class="row">
      <div class="col-12 col-sm-12 col-md-5 col-lg-3">

        <div class="widget-sidebar">
        
          <h5 class="widget-title mt-2" style="letter-spacing: 0.5px;">Product Categories</h5>
          <div class="widget-category mt-3">

            <div class="accordion accordion-flush" id="product-categories">

            @foreach ($categories as $category)

              @if( count($category->subcategory) > 0  )
              <div class="accordion-item">

                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $category->slug }}" aria-expanded="false" aria-controls="flush-collapseOne"></button>
                  <a class="" href="{{ route('shop.category', $category->slug) }}">{{ Str::title($category->name) }} </a>
                </h2>

                <div id="{{ $category->slug }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#product-categories">
                  <div class="accordion-body">
                    
                    <ul class="list-unstyled">
                       @foreach ($category->subcategory as $subcategory)
                      <li class="">
                        <a href="{{ route('shop.category', $category->slug .'/'. $subcategory->slug) }}"> {{ Str::title($subcategory->name) }} </a>
                      </li>
                      @endforeach
                    </ul>

                  </div>
                </div>

              </div>
              @else
              <div class="accordion-item">

                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" disabled></button>
                  <a class="" href="{{ route('shop.category', $category->slug) }}">{{ Str::title($category->name) }} </a>
                </h2>

                <div id="{{ $category->slug }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#product-categories">
                  <div class="accordion-body">
                    
                    <ul class="list-unstyled">
                       @foreach ($category->subcategory as $subcategory)
                      <li class="">
                        <a href="{{ route('shop.category', $category->slug .'/'. $subcategory->slug) }}"> {{ Str::title($subcategory->name) }} </a>
                      </li>
                      @endforeach
                    </ul>

                  </div>
                </div>

              </div>

              @endif
              

            @endforeach
            </div>
             

          </div>

        </div>

        <hr />

      </div>
      <div class="col-12 col-sm-12 col-md-7 col-lg-9">

        @include('web._shared.products', $products)

      </div>  
      
    </div>

  </div>

</main>

@include('web._shared.footer', $categories)
@endsection