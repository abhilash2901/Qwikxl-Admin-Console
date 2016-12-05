<?php //var_dump(\Session::all()); ?>
@extends('layouts.app')

@section('content')
@if (Auth::guest())
	
				
			
		
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">IN+</h1>
        </div>
        <h3>Welcome to IN+</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
        </p>
        <p>Login in. To see it in action.</p>
       
        <form class="m-t"  role="form" method="POST"  method="POST" action="{{ url('/login') }}">
		   {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Username" name="email" value="{{ old('email') }}">
				 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
				 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
            </div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-primary block full-width m-b"  type="submit">
                Login
            </button>
                     <a ui-sref="forgot_password"><small>Forgot password?</small></a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div> 
@else
	<script type="text/javascript">
    window.location = base_url+"/notfound";//here double curly bracket
</script>
@endif
@endsection


<!--<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">IN+</h1>
        </div>
        <h3>Welcome to IN+</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
        </p>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" action="#">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a ui-sref="forgot_password"><small>Forgot password?</small></a>
            
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>-->