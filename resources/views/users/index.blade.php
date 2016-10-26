@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li >
                User 
            </li>
            <li class="active">
                <strong>Users</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

    </div>
</div>
<div class="row">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5> users </h5>            
        </div>		
        <div class="ibox-content">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add users</a>
            <table class="table table-bordered topspace">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Name </th>

                        <th>Email</th>
                        <th>Roles</th>


                        <th class="">Action</th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->roles))
                            @foreach($user->roles as $v)
                            <label class="label label-success">{{ $v->display_name }}</label>
                            @endforeach
                            @endif
                        </td>
                        <td>
                          
                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                            @if(!empty($user->roles))
                                @foreach($user->roles as $v)
							     <?php 
								$role= Session::get('roletype');
								 if( $role=='admin' && $v->name !='admin' ){?>
                                
								<a  class="btn btn-danger" data-toggle="modal" data-target="#Deleteuser"  onClick="Takeid(this)" data-id="<?php echo $user->id;?>">
								Delete</a>
								<?php 
								 } 
								 ?>
								
								@endforeach
                                @endif
								@if(count($user->roles)==0)
									<a  class="btn btn-danger" data-toggle="modal" data-target="#Deleteuser"  onClick="Takeid(this)" data-id="<?php echo $user->id;?>">
								Delete</a>
								@endif
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            {!! $data->render() !!}

        </div>
    </div>
</div>

<div class="modal fade" id="Deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H3">Delete this record?</h4>
      </div>
      <div class="modal-body">
	  
       Are you sure to delete this record?
      </div>
	  <input type="hidden" id="get_id">
	  <div class="deleterole" style="width:55%;margin-left:10px;text-align:center"></div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		
        <button type="button" class="btn btn-danger" onClick="Deleteduser()">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection