<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="I&amp;A Office Furniture Shop">
	<meta name="author" content="I&amp;A Office Furniture Shop">
	<meta name="keywords" content="furniture, office furniture, tables, chairs, partitions">
	<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
	<meta name="robots" content="index, follow">
	<link rel="icon" href="{{ URL::to('/') }}/img/icon-ianda.webp" alt="I&A Office Furniture Icon">

	<link rel="canonical" href="https://iaofficefurniture.com"/>

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