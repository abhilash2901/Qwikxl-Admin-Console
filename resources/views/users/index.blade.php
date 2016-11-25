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
<div class="wrapper wrapper-content animated fadeInRight ecommerce" ng-app="app" ng-controller='search'>
    <div class="ibox-content m-b-sm border-bottom" >
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group" >
                    <label class="control-label" for="product_name">Type</label>
					
					<select  class="form-control" name="type" id="type" ng-model="system" >
					    <option value="" >All</option>
						<option value="System" >System</option> 
						<option value="Store" >Store</option>
                     </select>
                       </div>
            </div>
            <div class="col-sm-2" ng-show="system =='Store'">
                <div class="form-group">
                    <label class="control-label" for="price">Store Name</label>
                   
					<select  class="form-control" name="type" id="type" ng-model="storename" >
					<?php 
					foreach($store as $row){?>
					    <option value="<?php echo $row->id;?>" ><?php echo $row->name;?></option> 
						<?php 
					}
					?>
                     </select>
                </div>
            </div>
			<div class="col-sm-2" >
                <div class="form-group">
                    <label class="control-label" for="price">Role Name</label>
                    <input type="text" id="namee" name="namee" value="" class="form-control" ng-model="rolename">
					<select  class="form-control" name="type" id="type" ng-model="rolename" style='display:none'>
					<?php 
					foreach($role as $row){?>
					    <option value="<?php echo $row->name;?>" ><?php echo $row->name;?></option> 
						<?php 
					}
					?>
                     </select>
                </div>
            </div>
			
            
			
			
			
			
                
            <!--div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="quantity">Category</label>
                    <input type="text" id="category" ng-model="categorys" placeholder="Category" class="form-control" ng-change="changeCategory();">
                </div>
            </div-->

        </div>
       
    </div>



<div class="row">
<div class="col-lg-12">
    <div class="ibox " ng-init="listUsers()">
        	
        <div class="ibox-content">
		  @permission('users-create')
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add Users</a>
			@endpermission
             
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
                    
                    <tr dir-paginate="users in listingusers |filter:system | filter:storename| filter:rolename | itemsPerPage:5 ">
                        <td>@{{ $index +1 }}</td>
                        <td>@{{ users.firstname }} @{{ users.lastname }}</td>
                        <td>@{{  users.email }}</td>
                        <td ng-show="users.rolesname!=''" >
                           
                            <label class="label label-success">@{{ users.displayname }}</label>
                            
                        </td>
                        <td>
						     <div style="float: left;margin-right: 3px;">
							 
							 @permission('users-edit')
                               <a class="btn btn-primary btn-sm" href="{{ url('usersedit')}}/@{{users.id}}">Edit</a>
							   @endpermission
                              </div>
                              <div ng-show="users.rolesname!=''"  ng-init="types=<?php echo Session::get('roletype');?>"> 
							  <!--?php 
							  $class=''
								$roless= Session::get('roletype');
								 if( $roless=='admin' ){
									 $class ='hide';
								 } 
								 ?-->
							  <div ng-show="users.rolesname !='admin' && types =='admin'" >
                               
							     
                                @permission('users-delete')
								<a  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Deleteuser"  onClick="Takeid(this)" data-id="@{{users.id}}">
								Delete</a>
								@endpermission
								
								
								
								</div></div>
								 <div ng-show="users.rolesname!=''">
								
									 @permission('users-delete')
									<a  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Deleteuser"  onClick="Takeid(this)" data-id="@{{users.id}}">
								Delete</a>
								    @endpermission
									</div>
								
                        </td>
                    </tr>
                   


                </tbody>
            </table>
            <dir-pagination-controls 
			boundary-links="true" 
			direction-links="true" >
			</dir-pagination-controls>

        </div>
    </div> </div>
</div></div>

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