@extends('layouts.app')

@section('content')



<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit User</h2>
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
            <h5>Edit Profile</h5>    
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

            {!! Form::model($user, ['method' => 'POST','class'=>'form-horizontal']) !!}


            <div class="form-group"><label class="col-lg-2 control-label">Firstname</label>

                <div class="col-lg-8">    {!! Form::text('firstname', null, array('placeholder' => 'Firstname','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Lastname</label>

                <div class="col-lg-8">    {!! Form::text('lastname', null, array('placeholder' => 'Lastname','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Type</label>
                <div class="col-lg-8">  <select class="form-control m-b " name="type" ><option <?php if ($user->type == '') echo "selected"; ?>></option>
                        <option value="0" <?php if ($user->type == '0') echo "selected"; ?>>User</option>
                        <option value="1" <?php if ($user->type == '1') echo "selected"; ?>>Store</option>
                    </select> <span
                        class="help-block m-b-none"></span>
                </div> </div>

            <div class="form-group"> <label class="col-lg-2 control-label">Email</label>

                <div class="col-lg-8">{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label" >Contact no</label>

                <div class="col-lg-8">
                    <label>   {!! Form::text('contactnumber', null, array('placeholder' => 'contactnumber','class' => 'form-control','data-parsley-trigger'=>'keyup','data-parsley-minlength'=>'4', 'data-parsley-type'=>'digits','required'=>'')) !!} </label>

                </div>
            </div> 

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-8">
                    <button type="btn btn-md btn-primary" class="btn btn-primary" onClick=" alert('sucess')";>Submit</button>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>


@endsection
