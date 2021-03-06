



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
			
	
                   
                       
		<div class="usersucess">
			
		</div>
	
	
		{!! Form::open(array('route' => 'users.store','class'=>'form-horizontal create_user','method'=>'POST')) !!}
	
                        
						<div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                            <div class="col-lg-8">   {!! Form::text('firstname', null, array('placeholder' => 'First Name','class' => 'form-control','required'=>'','data-parsley-trigger'=>"keyup",'data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                            <div class="col-lg-8">   {!! Form::text('lastname', null, array('placeholder' => 'Last Name','class' => 'form-control','required'=>'','data-parsley-trigger'=>"keyup",'data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						
						<div class="form-group"><label class="col-lg-2 control-label">Contact Number</label>

                            <div class="col-lg-8">   {!! Form::text('contactnumber', null, array('placeholder' => '(123) 123-1234','class' => 'form-control',"data-parsley-validation-threshold"=>"1" ,"data-parsley-trigger"=>"keyup" ,
    'data-parsley-pattern'=>'^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$')) !!} <span class="help-block">(999) 999-9999</span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-8">  <input type="email" class="form-control" name="email" placeholder= 'Email' required> <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
					<div class="form-group"><label class="col-lg-2 control-label" >Password</label>

                            <div class="col-lg-8">
                	{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','id' => 'cpassed','data-parsley-minlength'=>"1" , 'data-parsley-required-message'=>"Please enter your new password.", 'data-parsley-pattern'=>"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" ,'data-parsley-pattern-message'=>"Your password must contain Minimum 8 characters at least  (1) lowercase letter (1) uppercase letter 1 Number and 1 Special Character:." ,'data-parsley-required')) !!}
                	
                            </div>
                        </div> <div class="form-group"><label class="col-lg-2 control-label" >Confirm Password</label>

                            <div class="col-lg-8">
                	 {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','required'=>'','data-parsley-equalto'=>"#cpassed", "data-parsley-equalto-message"=>"The two password fields didn't match." )) !!}
                	
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Type</label>

                            <div class="col-lg-2">  
							<input type="radio" required value="0" name="type" checked="checked"  onchange="gettype(this);"> System 
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
							<button type="button" class="btn btn-primary" onClick="SaveUserDetail()">Submit</button>
                             
                            </div>
                        </div>
                   	{!! Form::close() !!}
                </div>
            </div>
    </div>
</div>
	

@endsection