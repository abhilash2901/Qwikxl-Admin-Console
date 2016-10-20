

@extends('layouts.app')

@section('content')



<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Create Role</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
                <a href="{{ url('/roles') }}"> Roles</a>
            </li>
            <li class="active">
                Create Role
            </li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Create Role</h5>    
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
            {!! Form::open(array('route' => 'roles.store','class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="form-group"><label class="col-lg-2 control-label">Type</label>

                <div class="col-lg-8">  
                    <input type="radio" value="0" name="type"  onchange="Permissiontype(this)"> System 
                    <input type="radio" value="1" name="type"  onchange="Permissiontype(this)"> Store
                    <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                <div class="col-lg-8">   {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>


            <div class="form-group"><label class="col-lg-2 control-label" >Description</label>

                <div class="col-lg-8">{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            <div class="form-group  hide" id="system"><label class="col-lg-2 control-label" >Permission</label>

                <div class="col-lg-8"> @foreach($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->display_name }}</label>
                    <br/>
                    @endforeach
                </div>
            </div>
			<div class="form-group  hide" id="storess"><label class="col-lg-2 control-label" >Permission</label>

                <div class="col-lg-8"> @foreach($permissionstore as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->display_name }}</label>
                    <br/>
                    @endforeach
                </div>
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








