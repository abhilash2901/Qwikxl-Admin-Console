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
		   @permission('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add roles</a>
			@endpermission
            <table class="table table-bordered topspace">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>


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
                            if ($role->name != 'admin' && $role->display_name != 'Store Admin') {
                                ?>
                               
								<a  class="btn btn-danger" data-toggle="modal" data-target="#Deleterole"  onClick="Takeid(this)" data-id="<?php echo $role->id;?>">
								Delete</a>
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

<div class="modal fade" id="Deleterole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H3">Delete this record?</h4>
      </div>
      <div class="modal-body">
	  The role related user deleted.<br>
	   This operation can't be undo.<br>
       Are you sure to delete this record?
      </div>
	  <input type="hidden" id="get_id"><input type="hidden" id="token"  value="<?php echo csrf_token(); ?>">
	  <div class="deleterole" style="width:55%;margin-left:10px;text-align:center"></div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		
        <button class="btn btn-danger" onClick="Deleterole()">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>





@endsection