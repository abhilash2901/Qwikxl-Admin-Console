@extends('layouts.app')

@section('content')



	 
	
	<div class="row wrapper border-bottom white-bg page-heading">


    <div class="col-sm-4">
        <h2>Edit Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="active">
                Edit Profile   
            </li>

        </ol>
    </div>

</div>

<div class="row">

     <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Profile</h5>    <br>  <br>
					 <a data-toggle="modal" data-target="#myModalp" class="btn btn-primary">Change Password</a>
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
	<div class="profilesucess"></div>
	{!! Form::model($user, ['method' => 'POST','class'=>'form-horizontal profile']) !!}
	
                        
						<div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                            <div class="col-lg-8">    {!! Form::text('firstname', null, array('placeholder' => 'First Name','class' => 'form-control','required'=>'','data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                            <div class="col-lg-8">    {!! Form::text('lastname', null, array('placeholder' => 'Last Name','class' => 'form-control','required'=>'','data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} <span
                                    class="help-block m-b-none"></span>
                            </div>
                        </div>
						<!--div class="form-group"><label class="col-lg-2 control-label">Type</label>
						 <div class="col-lg-8">  <select class="form-control m-b " name="type" ><option <?php if($user->type=='') echo "selected"; ?>></option>
                                    <option value="0" <?php if($user->type=='0') echo "selected"; ?>>User</option>
                                    <option value="1" <?php if($user->type=='1') echo "selected"; ?>>Store</option>
                                </select> <span
                                    class="help-block m-b-none"></span>
                            </div> </div-->
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-8">
							<input type="email" class="form-control" name="email" placeholder= 'Email' value="<?php echo $user->email;?>" required>
				
							</div>
                        </div>
                         <div class="form-group"><label class="col-lg-2 control-label" >Contact no</label>
                            <input type="hidden" value="{{$user->type}}" name="type">
                            <div class="col-lg-8">
                	   {!! Form::text('contactnumber', null, array('placeholder' => '(123) 123-1234','class' => 'form-control','data-parsley-trigger'=>'keyup','data-parsley-pattern'=>'^(\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$', 'required'=>'')) !!} 
                	   <span class="help-block">(999) 999-9999</span>
                            </div>
                        </div> 
                                          
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
							<button type="button" class="btn btn-primary" onClick="profile()";>Submit</button>
                             
                            </div>
                        </div>
                   	{!! Form::close() !!}



</div>
</div>

	 <!-- Modal -->
  <div class="modal fade" id="myModalp" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
       <div class="modal-body">
    <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-style: hidden solid none;">
                    <h5>Change Password</h5>

                    
                </div>
                <div class="ibox-content" style="margin-bottom: -53px;">
				 <div class="changepasres"></div>
                    <form class="form-horizontal " id="changepass">
                       
						<!--div class="form-group"><label class="col-lg-2 control-label">Current Password</label>

                            <div class="col-lg-8"><input type="password" placeholder="Password"  id="psdd" name="currentpass" class="form-control" required="">
                            </div>
                        </div-->
					<div class="form-group"><label class="col-sm-2 control-label">Change Password</label>

                            <div class="col-lg-8"><input type="password" placeholder="Password" id="cpassed" name="changepass" class="form-control" data-parsley-minlength="1"  data-parsley-required-message="Please enter your new password." data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" data-parsley-pattern-message="Your password must contain Minimum 8 characters at least  (1) lowercase letter (1) uppercase letter 1 Number and 1 Special Character:." data-parsley-required>
							<input type="hidden" placeholder="Password"  name="id" class="form-control" value="<?php echo $user->id;?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Confirm Password</label>

                            <div class="col-lg-8"><input type="password" placeholder="Password" class="form-control"  data-parsley-equalto="#cpassed" data-parsley-equalto-message="Password confirmation must match the Password." required="">
                            </div>
							
                        </div>
						
                       
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
                                <button class="btn btn-md btn-primary" type="button" onClick="Changepass()">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
        
      </div>
      
    </div>
  </div>


@endsection
