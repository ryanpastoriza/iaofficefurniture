<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="I and A furniture shop">
	<meta name="author" content="furnitures">
	<meta name="keywords" content="furniture, office furniture, tables, chairs">

<!-- 	<link rel="preconnect" href="https://fonts.gstatic.com"> -->
<!-- 	<link rel="shortcut icon" href="" /> -->
<link rel="icon" href="{{ URL::to('/') }}/img/icon-ianda.webp">

	<link rel="canonical" href="" />

	<title>{{ $title }}</title>
	@include('web._includes.styles')
</head>

<body>
<div class="wrapper">
	@include('web._includes.topbar')
	@include('web._includes.header')
	@yield('content')
</div>
@include('web._includes.scripts')
</body>

</html>