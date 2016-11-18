@extends('layouts.storeapp')

@section('content')




<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li >
                Customer 
            </li>
            <li class="active">
                <strong>Customer</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Customer  </h5>            
            </div>		
            <div class="ibox-content" ng-app="apps" ng-controller="store">
                
                <table class="table table-bordered topspace" ng-init="customerList()">
                    <thead>
                        <tr>
                            <th>#</th>
							 <th>Name</th>
                            

                           
                            <th>Email</th>
							<th>mobile</th>
							<th> Address </th>


                            <th class="">Action</th>



                        </tr>
                    </thead>
                    <tbody>
					  <tr dir-paginate="order in customerlist | itemsPerPage:10">
					  <td>@{{$index + 1}}</td>
					      
						  <td>@{{order.firstname}}</td>
						  <td>@{{order.email}}</td>
						  <td>@{{order.mobile}}</td>
						  <td>@{{order.address}}</td>
						  <td>  
								<a class="btn btn-primary " href="" >Edit</a>
								 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)" data-id="@{{order.id}}" data-toggle="modal" data-target="#DeleteModal" >Delete</a></td>
                           </td>
					  </tr>
                       
                    </tbody>
                </table>
                 <dir-pagination-controls 
			boundary-links="true" 
			direction-links="true" >
			</dir-pagination-controls>

            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="H3">Delete this record?</h4>
            </div>
            <div class="modal-body">
                Are you sure to delete this record?
            </div>
            <div class="deletesucess" style="width:50%;margin-left:10px;text-align:center"></div>
            <div class="modal-footer">
                <input type="hidden" id="addCategory_id">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onClick="DeleteOrder()">Delete</button>
            </div>
        </div>
    </div>
</div>


@endsection