@extends('layouts.storeapp')
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
            {!! Form::model($user, ['method' => 'POST','class'=>'form-horizontal profile','route' => ['store.update', $user->id]]) !!}
            <div class="form-group"><label class="col-lg-2 control-label">Firstname</label>

                <div class="col-lg-8">    {!! Form::text('firstname', null, array('placeholder' => 'Firstname','class' => 'form-control','required'=>'','data-parsley-trigger'=>"keyup",'data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} 
				<span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Lastname</label>

                <div class="col-lg-8">    {!! Form::text('lastname', null, array('placeholder' => 'Lastname','class' => 'form-control','required'=>'','data-parsley-pattern'=>"^[a-zA-Z ]+$")) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>

            <input type="hidden" name="id" value="{{$user->id}}">
  <input type="hidden" name="type" value="{{$user->type}}">
            <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                <div class="col-lg-8">{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required'=>'')) !!}
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label" >Contact no</label>

                <div class="col-lg-8">
                    {!! Form::text('contactnumber', null, array('placeholder' => 'contactnumber','class' => 'form-control','data-parsley-trigger'=>'keyup', 'data-parsley-type'=>'digits','required'=>'')) !!} 

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
                        <div class="ibox-title">
                            <h5>Change Password</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="changepasres"></div>
                            <form class="form-horizontal " id="changepass">

                                <div class="form-group"><label class="col-lg-2 control-label">Current Password</label>

                                    <div class="col-lg-8"><input type="password" placeholder="Password"  id="psdd" name="currentpass" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Change Password</label>

                                    <div class="col-lg-8"><input type="password" placeholder="Password" id="cpassed" name="changepass" class="form-control" required="">
                                        <input type="hidden" placeholder="Password"  name="id" class="form-control" value="<?php echo $user->id; ?>">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Confirm Password</label>

                                    <div class="col-lg-8"><input type="password" placeholder="Password" class="form-control" data-parsley-equalto="#cpassed" data-parsley-equalto-message="Password confirmation must match the Password." required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8">
                                        <button class="btn btn-md btn-primary" type="button" onClick="Changepass()">submit</button>
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
