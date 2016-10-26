

@extends('layouts.app')

@section('content')


{!! Form::model($user, ['method' => 'PATCH','class'=>'form-horizontal','route' => ['users.pass', $user->id]]) !!}

<div class="form-group"><label class="col-lg-2 control-label" >Password</label>
    <div class="col-lg-8">
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
    </div>
</div> <div class="form-group"><label class="col-lg-2 control-label" >Confirm Password</label>
    <div class="col-lg-8">
        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
    </div>
</div>



<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
        <button type="btn btn-md btn-primary" class="btn btn-primary">Submit</button>

    </div>
</div>
{!! Form::close() !!}


@endsection
