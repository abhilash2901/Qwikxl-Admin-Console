



@extends('layouts.app')
 
@section('content')

	
	
	<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Create User</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
               <a href="{{ url('/users') }}"> Users</a>
            </li>
            <li class="active">
                Create User 
            </li>
        </ol>
    </div>
    
</div>
<div class="row">
     <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Create User </h5>    
                </div>
                <div class="ibox-content">
                   
                       @if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	
		{!! Form::open(array('route' => 'users.store','class'=>'form-horizontal','method'=>'POST')) !!}
	
                        
						<div class="form-group"><label class="col-lg-2 control-label">Firstname</label>

                            <div class="col-lg-8">   {!! Form::text('firstname', null, array('placeholder' => 'firstname','class' => 'form-control')) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Lastname</label>

                            <div class="col-lg-8">   {!! Form::text('lastname', null, array('placeholder' => 'lastname','class' => 'form-control')) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						
						<div class="form-group"><label class="col-lg-2 control-label">Contactnumber</label>

                            <div class="col-lg-8">   {!! Form::text('contactnumber', null, array('placeholder' => 'contactnumber','class' => 'form-control')) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-8">   {!! Form::text('email', null, array('placeholder' => 'email','class' => 'form-control')) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
					<div class="form-group"><label class="col-lg-2 control-label" >Password</label>

                            <div class="col-lg-8">
                	{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                	
                            </div>
                        </div> <div class="form-group"><label class="col-lg-2 control-label" >Confirm Password</label>

                            <div class="col-lg-8">
                	 {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                	
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Type</label>

                            <div class="col-lg-8">  
							<input type="radio" value="0" name="type"  onchange="gettype(this);"> System 
				            <input type="radio" value="1" name="type" onchange="gettype(this);"> Store
							 <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
                 
                        <div class="form-group"><label class="col-lg-2 control-label">Role</label>

                            <div class="col-lg-8">
							
							 <select class="form-control m-b " name="roles" id="roles">
                                </select>
							</div>
                        </div>
                         <div class="form-group stores hide"><label class="col-lg-2 control-label">Store</label>
                            <input type="hidden" name="store_id" id="getstore_id">
                            <div class="col-lg-8">  
							   <select class="form-control m-b type "  name="store_id" id="store_id" onChange="Getstore(this)">
							      
                                </select> <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
                                          
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
							<button type="btn btn-md btn-primary" class="btn btn-primary">Submit</button>
                             
                            </div>
                        </div>
                   	{!! Form::close() !!}
                </div>
            </div>
    </div>
</div>
	

@endsection