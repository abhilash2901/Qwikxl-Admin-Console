

@extends('layouts.app')
 
@section('content')

	
	
	<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit User</h2>
     
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
               <a href="{{ url('/users') }}"> Users</a>
            </li>
            <li class="active">
              Edit New User
            </li>
        </ol>
    </div>
    
</div>
<div class="row">
     <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit users</h5>    
                </div>
                <div class="ibox-content">
                             
		<div class="usersucess">
			
		</div>
	
	{!! Form::model($user, ['method' => 'PATCH','class'=>'form-horizontal create_user','route' => ['users.update', $user->id]]) !!}
	
                      
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

                            <div class="col-lg-8">   {!! Form::text('contactnumber', null, array('placeholder' => 'Contact Number','class' => 'form-control',"data-parsley-validation-threshold"=>"1" ,"data-parsley-trigger"=>"keyup" ,
    'data-parsley-type'=>"digits",'data-parsley-minlength'=>'4')) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						
                        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-8">
							 <input type="email" class="form-control" name="email" placeholder= 'Email' value="<?php echo $user->email;?>" required>
							</div>
                        </div>
                         <div class="form-group"><label class="col-lg-2 control-label" >Password</label>

                            <div class="col-lg-8">
                	{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','id' => 'cpassed',"data-parsley-validation-threshold"=>"1",'data-parsley-minlength'=>"1" , 'data-parsley-required-message'=>"Please enter your new password.", 'data-parsley-pattern'=>"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" ,'data-parsley-pattern-message'=>"Your password must contain Minimum 8 characters at least  (1) lowercase letter (1) uppercase letter 1 Number and 1 Special Character:." )) !!}
                	
                            </div>
                        </div> <div class="form-group"><label class="col-lg-2 control-label" >Confirm Password</label>

                            <div class="col-lg-8">
                	 {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','data-parsley-equalto'=>"#cpassed", "data-parsley-equalto-message"=>"The two password fields didn't match." )) !!}
                	
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Type</label>

                            <div class="col-lg-2">  <!--select class="form-control m-b type" name="type" onchange="gettype(this);"><option <?php if ($user->type=='')echo"selected";?>></option>
                                    <option value="0"  <?php if ($user->type=='0')echo"selected";?>>System</option>
                                    <option value="1" <?php if ($user->type=='1')echo"selected";?>>Store</option>
                                </select--> 
								<input type="radio" value="0" required name="type"  <?php if($user->type=='0') echo "checked='checked'"; ?> onchange="gettype(this);"> System 
				            <input type="radio" value="1" name="type" <?php if($user->type=='1') echo "checked='checked'"; ?> onchange="gettype(this);"> Store<span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						 
						
						<div class="form-group"><label class="col-lg-2 control-label" >Role</label>
                               <input type="hidden"	value="<?php echo $user->store_id;?>" id="edit_store_id">
							   <input type="hidden"	value="<?php if(isset($users[0]->role_id)){echo $users[0]->role_id;}?>" id="role_id">	
                            <div class="col-lg-8">
							
							{!! Form::select('roles', $roles,$userRole, array('class' => 'form-control','id'=>'roles')) !!}
                               
                	
                            </div>
                        </div>
						<div class="form-group stores "><label class="col-lg-2 control-label">Store</label>

                            <div class="col-lg-8">  
							   <select class="form-control m-b type " name="store_id" id="store_id" >
							  
							   @foreach ($store as $stores)
							     <option value="{{$stores->id}}">{{$stores->name}}</option>
							     @endforeach  
                                </select> <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
                                          
                        <div class="form-group">
						<input type="hidden" value="{{$user->id}}" name='id'>
                            <div class="col-lg-offset-2 col-lg-8">
							<button type="button" class="btn btn-primary" onClick="EditUserDetail()">Submit</button>
                             
                            </div>
                        </div>
                   	{!! Form::close() !!}
                </div>
            </div>
    </div>
</div>
	

@endsection
