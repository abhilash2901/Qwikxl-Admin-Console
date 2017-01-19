@extends('layouts.storeapp')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} Orders</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                Orders
            </li>
            <li class="active">
                <strong>Fulfillment Center</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight fadeInRight eorders" ng-app="apps" ng-controller="store">
<div class="ibox-content m-b-sm border-bottom">
	<h3>Order Search</h3>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="order_id">Order ID</label>
                    <input type="text" id="order_id"  name="order_id" ng-model="orderid"  placeholder="Order id" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Customer Phone Number</label>
                    <input type="text" ng-model="customerphone" placeholder="customer phone #" class="form-control">
                </div>
            </div>
            
        </div>
       
		<div class="text-right ">
       <button type="button" class="btn btn-w-m btn-primary ">Search</button>
	   </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 class="text-navy">@{{getfullfilmentOrders.length}} Orders </h5>
                   
                </div>
                <div class="ibox-content">

                    

                    <div class="table-responsive">
                        <table class="footable table table-hover issue-tracker " ng-init="listingfulfilmentOrder()">
						<thead>
                        <tr>

                            <th>Status</th>
                            <th data-hide="phone">Order ID</th>
                            <th data-hide="phone">Assigned to</th>
                            <th data-hide="phone">Assigned Date/Time </th>
                            <th data-hide="phone,tablet" >Completed Date/Time </th>
                             <th class="text-right">Action</th>

                        </tr>
                        </thead>
                            <tbody>
                            <tr ng-show="getfullfilmentOrders.length==0"><td colspan="5">No Orders</td></tr>
                        <tr dir-paginate=" new in getfullfilmentOrders | filter:orderid | filter:customerphone | itemsPerPage:10">
                                <td>
								 <span class="label label-danger" ng-show="new.o=='Cancelled'">Cancelled</span>
                                    <span class="label label-warning" ng-show="new.o=='Completed'">Completed</span>
									<span class="label label-primary" ng-show="new.o=='In progress'">In progress</span>
                                </td>
                                <td>
                                    
                                       @{{new.unique_id}}
                                    

                                   
                                </td>
                                <td>
                                     @{{new.assigned_touser}}
                                </td>
                                <td>
                                    @{{new.osh_created}}
                                </td>
                                <td>
                                     @{{new.date_time}}
                                </td>
                                <td class="text-right">
                                    
                                    <a href="{{ url('/viewfulfillmentorder/ ')}}@{{new.order_id}}" > <button class="btn-white btn btn-sm">View Order</button></a>
                                    
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
    </div>


</div>
@endsection