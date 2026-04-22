<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">	
				<li class="header">Dashboard & Apps</li>
				<li class="{{request()->routeIs('user.dashboard') ? 'active' : ''}}">
					<a href="{{route('user.dashboard')}}">
						<i class="fa fa-line-chart"><span class="path1"></span><span class="path2"></span></i>
						<span>Dashboard</span>
						<span class="pull-right-container">
							<i class="ti-angle-right"></i>
						</span>
					</a>
				</li>
				<li class="{{request()->routeIs('user.transactions.index') ? 'active' : ''}}">
					<a href="{{route('user.transactions.index')}}">
						<i class="fa fa-shopping-cart"><span class="path1"></span><span class="path2"></span></i>
						<span>Transaksi</span>
						<span class="pull-right-container">
							<i class="ti-angle-right"></i>
						</span>
					</a>
				</li>
			  </ul>
		  </div>
		</div>
    </section>
	{{-- <div class="sidebar-footer d-flex justify-content-center">
		<a href="{{ route('logout') }}" class="link" data-bs-toggle="tooltip" title="Logout">
			<span class="icon-Lock-overturning">
				<span class="path1"></span>
				<span class="path2"></span>
			</span>
		</a>
	</div> --}}
	<div class="sidebar-footer d-flex justify-content-center">
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
			@csrf
			<button type="submit" class="link" data-bs-toggle="tooltip" title="Logout" style="background: none; border: none; height: 50px;">
				<span class="glyphicon glyphicon-log-out" style="color: #343a40">
					<span class="path1"></span>
					<span class="path2"></span>
				</span>
			</button>
		</form>
	</div>
</aside>