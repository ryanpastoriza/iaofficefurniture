<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="I and A furniture shop">
	<meta name="author" content="furnitures">
	<meta name="keywords" content="furniture, office furniture, tables, chairs">

	<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
	<link rel="shortcut icon" href="" />

	<link rel="canonical" href="" />

	<title>{{ $title }}</title>

	<!-- styles -->
	@include('admin/_includes.styles')

</head>

<body>

	<div class="wrapper">

		<!-- sidebar -->
		 @include('admin/_includes.sidebar')

		<div class="main">

			<!-- top-nav -->
			 @include('admin/_includes.top-nav')

			<main class="content" id="app">
				@yield('content')
			</main>

			<!-- <footer class="footer"></footer> -->
		</div>

	</div>

	<!-- scripts -->
	@include('admin/_includes.scripts')

</body>

</html>