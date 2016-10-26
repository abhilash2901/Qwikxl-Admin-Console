<?php
if(Session::get('login_type')==1){
	$a='storeapp';
	
}else{
	$a='app';
}
?>
@extends('layouts.'.$a.'')

 
@section('content')
	<h1>You don't have permission.</h1>
@endsection