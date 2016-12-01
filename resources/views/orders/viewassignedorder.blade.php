@extends('layouts.storeapp')

@section('content')



<div ng-app="apps" ng-controller="store" ng-init="Getsingleorder('<?php echo $id;?>')">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Order ID# @{{getsingleorder.unique_id}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
			
            
            <li class="active">
                <strong>Order Detail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" >



    <div class="row">
	   <form id="updatestatus">
        <div class="col-md-9">

            <div class="ibox">
                <div class="ibox-title">
                    <span class="pull-right">(<strong>@{{getitemlist.length}}</strong>) items</span>
                    <h5>Items in customer cart</h5>
                </div>
                <div class="ibox-content" ng-repeat="product in getitemlist">


                    <div class="table-responsive">
                        <table class="table shoping-cart-table">

                            <tbody>
                            <tr >
                                <td width="90">
                                    <div class="cart-product-imitation" ng-show="product.image!=''">
									<img src="@{{baseurl}}/@{{product.image}}" width="80" height="80"/>
                                    </div>
									<div class="cart-product-imitation" ng-show="product.image==''">
									<img  src="{{ asset('img/product_img.jpg')}}" width="80" height="80"/>
                                    </div>
                                </td>
                                <td class="desc">
                                    <h3>
                                        <a href="#" class="text-navy">
                                            @{{product.name}}
                                        </a>
                                    </h3>
                                    <p class="small">
                                       @{{product.description}}
                                    </p>
                                    <dl class="small m-b-none">
                                        <dt>Nutritional Information</dt>
                                        <dd>A description list is perfect for defining terms.</dd>
                                    </dl>

                                    <div class="m-t-sm">
                                        
                                        <!--a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a-->
                                    </div>
                                </td>

                                
                                <td width="65">
                                    <input type="text" class="form-control" placeholder="@{{product.quantity}}" value="@{{product.quantity}}" disabled>
                              
                                </td>
                                <td>
                                    <h4>
                                       @{{product.productprice}}
                                    </h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
               
                <div class="ibox-content">

                   
                    <a  onclick="history.go(-1);"><button class="btn btn-white"><i class="fa fa-arrow-left"></i> Back to Orders</button></a>

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
				

                            <div class=""><select class="form-control m-b" name="status_id" required data-parsley-min="1"  data-parsley-min-message="Please Select Status">
							
							   <?php foreach($status as $row){?>
                                <option value="<?php echo $row->id;?>" <?php if($currentstatus==$row->id) echo  'selected="selected"';?>><?php echo $row->status;?></option>
							   <?php } 
							   
							   ?>
                               
                                
                            </select>
                            </div>
                       
				<hr>
					<h5>Assign Order</h5>
					
                            <div class=""><select class="form-control m-b" name="assigned_to">
                                <?php foreach($storeuser as $row){?>
                                <option value="<?php echo $row->id;?>" <?php if($assigned_to==$row->id) echo  'selected="selected"';?>><?php echo $row->firstname;?></option>
							   <?php } ?>
                                
                            </select>
                            </div>
				<div class="topspace "><button type="button" class="btn btn-primary btn-lg " onclick="SavenewOrderstatus()">Update</button></div>
                    </div>
					
					
                </div>
				
            </div>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Customer Contact </h5>
                </div>
                <div class="ibox-content ">

                <h3><strong>Name:</strong>  @{{getsingleorder.firstname}}  @{{getsingleorder.lastname}} </h3>

                    <h3><i class="fa fa-phone"></i>  @{{getsingleorder.mobile}}</h3>
                            <span class="small">
                                
                            </span>
							
                    <p></p>
					<hr>
                            <span class="">
                               <a href="#" class="btn btn-primary btn-md"><i class="fa fa-comments"></i>  Compose Text</a>
                            </span>


                </div>
            </div>

            <div class="ibox">
                <div class="ibox-content">

                    <p class="font-bold">
                        Notes
                    </p>

                    
                   
                    
					<div class="mail-text h-200">

                    <div summernote class="summernote"  ng-model="main.summernoteText">
                        
                        dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                        
                        <br/>
                        <br/>

                    </div>
                    <div class="clearfix"></div>
                </div>
				 <div class="mail-body  tooltip-demo">
                    <a ui-sref="#" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-floppy-o"></i> Save</a>
                    <a ui-sref="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                   
                </div>

                </div>
            </div>

        </div>
		</form>
    </div>




</div></div>

@endsection