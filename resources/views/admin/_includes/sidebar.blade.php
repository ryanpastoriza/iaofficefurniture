<nav id="sidebar" class="sidebar js-sidebar">

	<div class="sidebar-content js-simplebar">

		<a class="sidebar-brand" href="index.html">
		  <span class="align-middle">Admin Control</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Pages
			</li>

			<li class="sidebar-item {{ isset($segment) && $segment == 'dashboard' ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('dashboard') }}">
			      <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			    </a>
			</li>

			<li class="sidebar-item {{ isset($segment) && $segment == 'inquiry' ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('inquiry') }}">
			      <i class="align-middle" data-feather="inbox"></i> <span class="align-middle">Inquiry</span>
			    </a>
			</li>			

			<li class="sidebar-header">
				Product
			</li>

			<li class="sidebar-item {{ isset($segment) && $segment == 'product' ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('product') }}">
			     	<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Products</span>
			    </a>
			</li>

			<li class="sidebar-item {{ isset($segment) && $segment == 'category' ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('category') }}">
			      <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Categories</span>
			    </a>
			</li>


			<li class="sidebar-header">
				Setup
			</li>

			<li class="sidebar-item {{ isset($segment) && $segment == 'company' ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('company') }}">
			      <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Company</span>
			    </a>
			</li>

		</ul>

	</div>
</nav>