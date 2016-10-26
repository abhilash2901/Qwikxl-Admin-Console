<?php
if(Session::get('login_type')==1){
	$a='storeapp';
	
}else{
	$a='app';
}
?>
@extends('layouts.'.$a.'')

@section('content')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">IN+</h1>
        </div>
        <h3>404 </h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
        </p>
        
        
       <p>@if (Auth::guest())
           
             <p>Login in. To see it in action.</p>
				<a href="{{ url('/')}}">Login</a>
          @else				
			
		    @endif
			
			</p>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div> 


@endsection


