@extends('layouts.app')
 
@section('content')
	
	

	
	<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
           
			 <li class="active">
                <strong>Stores</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        
    </div>
</div>
<div class="row">
    
	<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5> Stores </h5>            
            </div>		
            <div class="ibox-content">
                       <a href="{{ route('users.create') }}" class="btn btn-primary">Add users</a>
                <table class="table table-bordered topspace">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> Name </th>
                      
						<th>Address</th>
						<th>city</th>
						
                       
						<th class="">Action</th>
						
						
						
                    </tr>
                    </thead>
                    <tbody>
					<?php $i =0;
					?>@foreach ($roles as $key => $user)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $user->name }}</td>
		<td>{{ $user->address }}</td>
		<td>{{ $user->city }}</td>
		
		<td>
			<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
                
                

		</td>
	</tr>
	@endforeach
	
	
	</tbody>
	</table>
	

            </div>
        </div>
       
 
</div>
	
	
	
	
	
@endsection