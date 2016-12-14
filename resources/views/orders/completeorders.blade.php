@extends('layouts.storeapp')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Orders</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            
            <li class="">
                Orders
            </li>
			<li class="active">
                <strong>Completed Orders</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight eorders"  ng-app="apps" ng-controller="store">


    <div class="ibox-content m-b-sm border-bottom">
	<h3>Order Search</h3>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="order_id">Order ID</label>
                    <input type="text" id="order_id" ng-model="orderid" name="order_id" value="" placeholder="Order id" class="form-control">
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
                    <h5 class="text-navy">@{{getassingedOrders.length}} (total number of  orders) Completed  Orders </h5>
                   
                </div>
                <div class="ibox-content">
				 

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15" ng-init="listingcompletedOrder('3','4')">
                        <thead>
						
                        <tr>

                            
                            <th>Order ID</th>
                            <th data-hide="phone">Customer Phone #</th>
                            <th data-hide="phone">Amount</th>
                            <th data-hide="phone">Order Date & Time</th>
                            <th data-hide="phone,tablet" >Completed Date & Time</th>
                            <th data-hide="phone">Status</th>
                            <th class="text-right">Action</th>

                        </tr>
                        </thead>
                        <tbody>
						
						<tr ng-show="getassingedOrders.length==0"><td colspan="5">No Orders</td></tr>
                        <tr dir-paginate=" new in getassingedOrders | filter:orderid | filter:customerphone | itemsPerPage:10">
                            <td>
                                @{{new.unique_id}}
                            </td>
                            <td>
                              
								 @{{new.mobile}}
                            </td>
                            <td>
                                @{{new.price}}
                            </td>
                            <td>
                              @{{new.createddate}}
                            </td><td>
                              @{{new.date_time}}
                            </td>
                            <td>
                             <span class="label label-warning" ng-show="new.o=='Completed'">Completed</span>
							 
							 <span class="label label-danger" ng-show="new.o=='Cancelled'">Cancelled</span>
                            </td>
                           
                            <td class="text-right">
                                <div class="btn-group">
								   {{ Form::open(array('url' => 'viewassignedorder','class' => 'pull-left')) }}<input type="hidden" name="id" value="@{{new.order_id}}"> <input type="submit" class="btn btn-primary btn-sm" value="View Order"></form>
								
                                   <!--a href="{{ url('/viewassignedorder/ ')}}@{{new.order_id}}" > <button class="btn-white btn btn-sm">View Order</button></a-->
                                    
                                </div>
                            </td>
                        </tr>
                       
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
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
@endsection