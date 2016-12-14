<?php
if(Session::get('login_type')==1){
	$a='storeapp';
	
}else{
	$a='app';
}
?>
@extends('layouts.'.$a.'')

@section('content')

<div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
            <form class="form-inline m-t" role="form">
                @if (Auth::guest())
           
             <p>Login in. To see it in action.</p>
				<a href="{{ url('/login')}}">Login</a>
          @else				
			
		    @endif
            </form>
        </div>
    </div>


@endsection


