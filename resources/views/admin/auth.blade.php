<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Sign In</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<img class="mb-4" src="{{ URL::to('/') }}/img/logo-ianda.png" alt="" width="300">
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									@if ($message = Session::get('error'))
				        <div class="bd-callout bd-callout-danger text-center">
				          <h5 class="text-danger">Invalid Username or Password!</h5>
				          <p>{{ $message }}</p>
				        </div>
				        @endif
									 <form method="post" action="{{ route('user.login') }}">
									 	@csrf
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your username" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" required/>
											<small>
									            <a href="index.html">Forgot password?</a>
									          </small>
										</div>
										
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>