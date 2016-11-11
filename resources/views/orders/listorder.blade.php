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
                Orders 
            </li>
            <li class="active">
                <strong>Orders</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce" ng-app="apps" ng-controller="store">
    <div class="ibox-content m-b-sm border-bottom" >
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group" >
                    <label class="control-label" for="order_id">Customer</label>
                    <input type="text" id="order_id" name="order_id" value="" placeholder="Order ID" class="form-control" ng-model="orderid">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="price">Order Id</label>
                    <input type="text" id="price" name="price" value="" placeholder="Order Id" class="form-control" ng-model="unique">
                </div>
            </div>
            <div class="col-sm-3" >
                <div class="form-group">
                    <label class="control-label" for="status">Order Status</label>
                    <select name="status" id="status" class="form-control" ng-model="status" >
					  
                        <option ng-repeat="status in getstatus" value="@{{status.status}}" >@{{status.status}}</option>
                       
                    </select>
                </div>
            </div>
			<div class="col-sm-3" >
                <div class="form-group">
                    <label class="control-label" for="status">Transaction Status</label>
                    <select name="status" id="status" class="form-control" ng-model="status" >
					  
                        <option  value="succeeded" >succeeded</option>
						<option  value="paid" >paid</option>
						<option  value="pending" >pending</option>
						<option  value="in_transit" >in_transit</option>
						<option  value="canceled" >canceled</option>
						<option  value="failed" >failed</option>
                       
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="date_added">Date </label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_addede" class="form-control" ng-model="from" type="text">
                            </div>
                        </div>
                    </div> <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="date_added">Date </label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_addede" class="form-control" ng-model="to"  type="text">
                            </div>
                        </div>
                    </div>
					

        </div>
        <div class="text-right">
            <button type="button" class="btn btn-w-m btn-primary" >
                Search
            </button>
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            	
            <div class="ibox-content" >
                
                <table class="table table-bordered topspace" ng-init="listingOrder()">
                    <thead>
                        <tr>
                            <th>#</th>
							 <th>Order ID</th>
							 <th>Customer</th>
							
                            

                           
                            
							<th>Quantity</th>
							<th>Price</th><th>Date</th>
							<th> Status </th>


                            <th class="">Action</th>



                        </tr>
                    </thead>
                    <tbody>
					  <tr ng-show="getOrders.length==0" colspan="4"><td>No Orders</td></tr>
					  <tr dir-paginate="order in getOrders | filter: dateRangeFilter('createddate', from, to) |itemsPerPage:10 | filter:orderid | filter:status  ">
					  <td>@{{$index + 1}}</td>
					      
						  
						  <td>@{{order.unique_id}}</td>
						  <td>@{{order.firstname}} @{{order.lastname}}</td>
						  <td>@{{order.quantity}}</td>
						  <td>@{{order.price}}</td><td>@{{order.createddate}}</td>
						  
						  <td>@{{order.status}}</td>
						  <td>  
								
								 <a class="btn btn-primary" href="{{ url('/editorder/ ')}}@{{order.order_id}}" >Edit</a>
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)" data-id="@{{order.order_id}}" data-toggle="modal" data-target="#DeleteModal" >Delete</a></td>
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
</div></div>


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