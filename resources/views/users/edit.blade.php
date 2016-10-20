

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
	
	{!! Form::model($user, ['method' => 'PATCH','class'=>'form-horizontal','route' => ['users.update', $user->id]]) !!}
	
                      
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

                            <div class="col-lg-8">{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
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

                            <div class="col-lg-8">  <!--select class="form-control m-b type" name="type" onchange="gettype(this);"><option <?php if ($user->type=='')echo"selected";?>></option>
                                    <option value="0"  <?php if ($user->type=='0')echo"selected";?>>System</option>
                                    <option value="1" <?php if ($user->type=='1')echo"selected";?>>Store</option>
                                </select--> 
								<input type="radio" value="0" name="type"  <?php if($user->type=='0') echo "checked='checked'"; ?> onchange="gettype(this);"> System 
				            <input type="radio" value="1" name="type" <?php if($user->type=='1') echo "checked='checked'"; ?> onchange="gettype(this);"> Store<span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						 
						
						<div class="form-group"><label class="col-lg-2 control-label" >Role</label>
                               <input type="hidden"	value="<?php echo $user->store_id;?>" id="edit_store_id">
							   <input type="hidden"	value="<?php echo $users[0]->role_id;?>" id="role_id">	
                            <div class="col-lg-8">
							
							{!! Form::select('roles', $roles,$userRole, array('class' => 'form-control','id'=>'roles')) !!}
                               
                	
                            </div>
                        </div>
						<div class="form-group stores <?php if ($user->type=='1') echo"show";else echo"hide";?>"><label class="col-lg-2 control-label">Store</label>

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
