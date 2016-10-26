@extends('layouts.app')

@section('content')








<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>User Roles</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li >
                User Roles
            </li>
            <li class="active">
                <strong>Roles</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

    </div>
</div>
<div class="row">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Roles </h5>            
        </div>		
        <div class="ibox-content">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add roles</a>
            <table class="table table-bordered topspace">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Descriptions</th>


                        <th class="">Action</th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            @permission('role-edit')    

                            <a href="{{ route('roles.edit',$role->id) }}"> <button class="btn-warning btn btn-sm"><i class="fa fa-wrench"></i> Edit</button></a>
                            @endpermission
                            @permission('role-delete')
                            <?php
                            if ($role->name != 'admin') {
                                ?>
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline','onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <?php
                            }
                            ?>			
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $roles->render() !!}

        </div>
    </div>


</div>





@endsection