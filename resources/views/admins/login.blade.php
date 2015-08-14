@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/admins/login.css') !!}
@stop
@section('scripts')
@stop

@section('content')



<div class="container">
  <div class="row-fluid">
      <strong><h2 class="text-center" style="margin-top:100px">Admin Login</h2></strong>
      @if(isset($wrong))
            <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:100px">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               Wrong username or password
            </div>
      @endif
      @include('flash::message')
  </div>
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      
      <section class="login-form" style="margin-top:0px;">
          {!! Form::open(array('action' => 'AdminsController@postLogin','id'=>'reg-form', 'class'=>'','role'=>"form")) !!}
            <div class="form-group">
              <input type="text" name="email" placeholder="Username" required class="form-control input-lg"  />
            </div>
            <div class="form-group">
             <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
            </div>
            <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
            <div>
              <a href="#">Create account</a> or <a href="#">reset password</a>
            </div>

           {!! Form::close() !!}
      </section>  
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
@stop