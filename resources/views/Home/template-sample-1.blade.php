@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<nav class="mainmenu">
	<div class="container">
		<div class="dropdown">
			<button type="button" class="navbar-toggle" data-toggle="dropdown"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<!-- <a data-toggle="dropdown" href="#">Dropdown trigger</a> -->
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li><a href="#head" class="active">Hello</a></li>
				<li><a href="#about">About me</a></li>
				<li><a href="#themes">Themes</a></li>
				<li><a href="#contact">Get in touch</a></li>
			</ul>
		</div>
	</div>
</nav>


<div class="section-left col-md-8">
	
	<!-- Main (Home) section -->
	<section class="section" id="head">
		<div class="container">

			<div class="row">
				<div class="">	

					<!-- Site Title, your name, HELLO msg, etc. -->
					<h1 class="title">Eyelevate</h1>
					<h2 class="subtitle">Free html5 template by GetTemplate</h2>

					<!-- Short introductory (optional) -->
					<h3 class="tagline">
						Potentially, the best place to tell people why they are here.<br>
						So, this is a demo page built to showcase the beauty of the template.
					</h3>

					<!-- Nice place to describe your site in a sentence or two -->
					<p><a href="/download/" class="btn btn-default btn-lg">Download template now</a></p>

				</div> <!-- /col -->
			</div> <!-- /row -->

		</div>
	</section>

</div>

<div class="section-right col-md-4">
	<!-- Main (Home) section -->
	<section class="section-right-h" id="head-right">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						
						<!-- Site Title, your name, HELLO msg, etc. -->
						<h1 class="title">Magister</h1>
						<h2 class="subtitle">Free html5 template by GetTemplate</h2>
						<!-- Nice place to describe your site in a sentence or two -->
						<p><a href="/download/" class="btn btn-default btn-lg">Download template now</a></p>
					</div>
				</div>
			</div> <!-- /row -->

	</section>


</div>

@stop