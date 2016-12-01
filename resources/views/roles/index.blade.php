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
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="price">Role Name</label>
                    <input type="text" id="namee" name="namee" value="" class="form-control" ng-model="rolename">
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
<div class="row" >
    <div class="col-lg-12">
    <div class="ibox " ng-init="listRoles()">
        		
        <div class="ibox-content">
		   @permission('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Roles</a>
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
                   
                    <tr dir-paginate="roles in listingroles  | filter:rolename |filter:system | itemsPerPage:5" >
                        <td>@{{ $index + 1 }}</td>
                        <td>@{{ roles.display_name }}</td>
                        <td>@{{ roles.description }}</td>
                        <td>
						<div style="float: left;margin-right: 3px;">
                            @permission('role-edit')    

                            <a href="{{ url('rolesedit')}}/@{{roles.id}}" > <button class="btn-warning btn btn-sm"><i class="fa fa-wrench"></i> Edit</button></a>
                            @endpermission
							</div>
                            @permission('role-delete')
                            
								<div ng-show="roles.name !='admin' && roles.display_name !='Store Admin'&& roles.display_name !='Store User'">
                               
								<a  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Deleterole"  onClick="Takeid(this)" data-id="@{{ roles.id }}">
								Delete</a>
								</div>
                                		
                            @endpermission
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
</div></div>





@endsection