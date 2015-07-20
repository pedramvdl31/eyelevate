<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin</title>

<link rel="shortcut icon" href="assets/images/gt_favicon.png">
  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- Custom styles -->
  <link rel="stylesheet" href="assets/css/master.css">

  <!-- Fonts -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
  @yield('styles')

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<nav class="navbar navbar-default" id="master-navigation">
  <div class="container-fluid">
    <div class="navbar-header">

    </div>
  </div>
</nav>

 <div class="container-fluid background-color">

@yield('content')


</div>

<!-- Load js libs only when the page is loaded. -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="packages/Magister3/assets/js/modernizr.custom.72241.js"></script>
<!-- Custom template scripts -->
<script src="packages/Magister3/assets/js/magister.js"></script>

@yield('scripts')

</body>
</html>
<style>
.background-color{
  background-color: rgb(241, 241, 241);
}
.navbar{
    margin-bottom: 0 !important;
}
</style>