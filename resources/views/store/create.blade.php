



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
            <h5> Store User </h5>    
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
            <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                <div class="col-lg-8">   {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div> 
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
            <div class="form-group"><label class="col-lg-2 control-label">Password</label>

                <div class="col-lg-8">   {!! Form::password('password', null, array('placeholder' => 'password','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Confirm Password</label>

                <div class="col-lg-8">   {!! Form::password('confirm-password', null, array('placeholder' => 'Confirm Password','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Type</label>

                <div class="col-lg-8">  <select class="form-control m-b " name="type" ><option ></option>
                        <option value="0" >User</option>
                        <option value="1" >Store</option>
                    </select> <span
                        class="help-block m-b-none"></span>
                </div>
            </div>

            <div class="form-group"><label class="col-lg-2 control-label">Role</label>

                <div class="col-lg-8">
                    <input type="hidden" value="1" name="store_id">
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}</div>
            </div>


            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-8">
                    <button type="btn btn-md btn-primary" class="btn btn-primary" >Submit</button>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>


@endsection