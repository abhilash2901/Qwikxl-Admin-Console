@extends('layouts.storeapp')
 
@section('content')
	
	

	
	<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Store</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li >
                User 
            </li>
			 <li class="active">
                <strong>Store</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
	<div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Store users </h5>            
            </div>		
            <div class="ibox-content">
                       <a href="{{ route('users.create') }}" class="btn btn-primary">Add users</a>
                <table class="table table-bordered topspace">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> Name </th>
                      
						<th>Email</th>
						<th>Roles</th>
						
                       
						<th class="">Action</th>
						
						
						
                    </tr>
                    </thead>
                    
	
	
	
	</tbody>
	</table>
	

            </div>
        </div>
       
    </div>
</div>
	
	
	
	
	
@endsection