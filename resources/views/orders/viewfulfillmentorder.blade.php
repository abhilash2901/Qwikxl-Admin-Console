@extends('layouts.storeapp')

@section('content')



<div ng-app="apps" ng-controller="store" ng-init="Getsingleorder('<?php echo $id;?>')">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Order ID # @{{getsingleorder.unique_id}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            
            <li class="active">
                <strong>Fulfillment Cart</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">



    <div class="row">
	<form id="updatestatus">
        <div class="col-md-9">

            <div class="ibox">
                <div class="ibox-title">
				
                    <span class="pull-right">(<strong>@{{getitemlist.length}}</strong>) items</span>
                    <h5>Items in customer cart</h5>
                </div>
                <div class="ibox-content">


                    <div class="table-responsive">
                        <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Image</th>
                        <th>Description</th>
						<th>Product Number</th>
						
                        <th>Department</th>
						
						<th>Stock Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="product in getitemlist">
                        <td><input required data-parsley-errors-messages-disabled name="@{{$index +1}}" type="checkbox"><br></td>
                        <td> <div ng-show="product.image!=''">
									<img src="@{{baseurl}}/@{{product.image}}" width="80" height="80"/>
                                    </div>
									<div ng-show="product.image==''">
									<img  src="{{ asset('img/product_img.jpg')}}" width="80" height="80"/>
                                    </div></td>
                        <td> @{{product.description}}</td>
                        <td>@{{product.unique_id}}</td>
						
						<td>@{{product.dptname}}</td>
						
						<td>@{{product.quantity}}</td>
                    </tr>
                   
                   
                    </tbody>
                </table>
                    </div>
					
              <a href="{{ url('fullfillmentorders')}}" class="btn btn-white"><i class="fa fa-arrow-left"></i> Back to Orders</a>
                </div>
               
                
               
                
                <div class="ibox-content">

                   
                   

                </div>
            </div>

        </div>
        <div class="col-md-3">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Cart Summary</h5>
                </div>
                <div class="ibox-content">
                            <span>
                                Total
                            </span>
                    <h2 class="font-bold">
                         @{{total}}
                    </h2>

                    <hr/>
                            <span class="text-muted small">
                                
                            </span>
                    <div class="m-t-sm">
					<h5>Change Order Status</h5>
                       <div class="custmstatus"></div>
				           <input type="hidden" name="order_id" value="<?php echo $id;?>">

                            <div class=""><select <?php if($currentstatus=='3') echo 'disabled=""';?>class="form-control m-b" name="status_id" required data-parsley-min="1"  data-parsley-min-message="Please Select Status">
							
							   <?php foreach($status as $row){?>
                                <option value="<?php echo $row->id;?>" <?php if($currentstatus==$row->id) echo  'selected="selected"';?> ><?php echo $row->status;?></option>
							   <?php } 
							   
							   ?>
                               
                                
                            </select>
							<span class="small">order can not be marked completed untill all items are checked off</span>
                            </div>
                       <input type="hidden" value="<?php echo $assigned_to;?>" name="assigned_to">
				<hr>
					<h5>Assign Order</h5>
					
                            <div class=""><select class="form-control m-b d" disabled="" >
                                <?php foreach($storeuser as $row){?>
                                <option value="<?php echo $row->id;?>" <?php if($assigned_to==$row->id) echo  'selected="selected"';?>><?php echo $row->firstname;?></option>
							   <?php } ?>
                                
                            </select>
                            </div>
				<div class="topspace "><button type="button" class="btn btn-primary btn-md " onclick="SavenewOrderstatus()"><i class="fa fa-floppy-o"></i> Update</button></a>  </div>
                    </div>
					
					
                </div>
				
            </div>


        </div>
		</form>
    </div>




</div></div>

@endsection