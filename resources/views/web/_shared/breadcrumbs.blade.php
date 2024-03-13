<section class="breadcrumbs">
  <div class="container">
   <div class="d-flex justify-content-between align-items-center">
      <!-- <h2>{{ $breadcrumbs['title'] }}</h2> -->
      <ol class="d-none d-sm-flex">
        @foreach ( $breadcrumbs['items'] as $breadcrumb )
        <li class="{{ $breadcrumb['class'] }}"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
        @endforeach
        <li><strong style="font-weight: 500; letter-spacing: 0.5px;">{{ $breadcrumbs['name'] }}</strong></li>
      </ol>
    </div>
  </div>
</section>