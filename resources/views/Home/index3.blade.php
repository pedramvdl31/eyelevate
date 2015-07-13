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


<!-- Main (Home) section -->
<section class="section" id="head">
	<div class="container">

		<div class="row">
			<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">	

				<!-- Site Title, your name, HELLO msg, etc. -->
				<h2 class="subtitle"  style="color:#black">Eyelevate</h2>

				<!-- Short introductory (optional) -->
				<!-- #778899 -->
				<!-- #FFE800 -->
				<!-- #5A5A5A -->
				<!-- rgb(86, 62, 125); -->
				<h3 class="tagline" style="#5A5A5A">
					Potentially, the best place to tell people why they are here.<br>
					So, this is a demo page built to showcase the beauty of the template.
				</h3>
				
			  <div class="col-md-offset-2 col-lg-8">
			    <div class="input-group">
			      <input type="text" class="form-control" placeholder="Search for...">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">Go!</button>
			      </span>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
	
			</div> <!-- /col -->
		</div> <!-- /row -->
	
	</div>
</section>

@stop