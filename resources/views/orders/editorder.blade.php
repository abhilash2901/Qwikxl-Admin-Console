@extends('layouts.storeapp')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Order Details</h2>
       
    </div>
    
</div>




                    
         



<div class="row topspace page-wrapper" ng-app="apps" ng-controller="store" ng-init="Getsingleorder('<?php echo $id;?>')">



	<div class="col-lg-8">
		<div class="ibox">
                        <div class="ibox-content">
							
						
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <h2>#@{{getsingleorder.transaction_id}} (Order Number)</h2>
                                    </div>
									
									<br>
									
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><span class="label label-primary">@{{statuss.status}}</span></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Created by:</dt> <dd>@{{getsingleorder.firstname}} @{{getsingleorder.lastname}} </dd>
                                        <dt>Order Date:</dt> <dd> @{{getsingleorder.createddate | date :" MMMM d, y"}}<!--?php echo date('M d,Y  h:i:sa',strtotime( $result[0]->cdate));?-->
										</dd>
										<dt>Purchased From:</dt> <dd>   @{{getsingleorder.name}}</dd>
										<dt>Payment type:</dt> <dd>  Cash on Delivery</dd>

                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal">

                                        <dt>Last Updated:</dt> <dd> @{{getsingleorder.createddate}}</dd>
                                        <dt>Created:</dt> <dd>  @{{getsingleorder.createddate}}</dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Progress:</dt>
                                        <dd>
                                            <div class="progress progress-striped active m-b-sm">
                                                <div style="width: 85%;" class="progress-bar"></div>
                                            </div>
                                            <small>Order completed in <strong>85%</strong>. Remaining .....</small>
                                        </dd>
                                    </dl>
                                </div>
                            </div> -->
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Shipping Address</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Billing aadress</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">

									<ul class="list-unstyled m-t-md">
										<li>
											 @{{getsingleorder.firstname}}  @{{getsingleorder.lastname}} 
										</li>
										<li>
											 @{{getsingleorder.country}} 
										</li>
										
										<br>
										<li>
											<span class="fa fa-envelope m-r-xs"></span>
											<label>Email:</label>
											 @{{getsingleorder.email}} 
										</li>
										<li>
											<span class="fa fa-home m-r-xs"></span>
											<label>Address:</label>
											 @{{getsingleorder.address}} 
										</li>
										<li>
											<span class="fa fa-phone m-r-xs"></span>
											<label>Contact:</label>
											 @{{getsingleorder.mobile}} 
										</li>
									</ul>
                                    <div class="title-action">
										<a href="#" data-toggle="modal" data-target="#edit" class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a>
									</div>

                                </div>
                                <div class="tab-pane" id="tab-2">
									 <ul class="list-unstyled m-t-md">
										<li>
											 @{{getsingleorder.firstname}}  @{{getsingleorder.lastname}} 
										</li>
										<li>
											 @{{getsingleorder.country}} 
										</li>
										
										<br>
										<li>
											<span class="fa fa-envelope m-r-xs"></span>
											<label>Email:</label>
											 @{{getsingleorder.email}} 
										</li>
										<li>
											<span class="fa fa-home m-r-xs"></span>
											<label>Address:</label>
											 @{{getsingleorder.address}} 
										</li>
										<li>
											<span class="fa fa-phone m-r-xs"></span>
											<label>Contact:</label>
											 @{{getsingleorder.mobile}} 
										</li>
									</ul>
									<div class="title-action">
										<a href="#" data-toggle="modal" data-target="#edit"  class="btn btn-white"><i class="fa fa-pencil"></i> Edit </a>
									</div>
                                </div>
                                </div>

                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
		</div>
					
		<div class="ibox">			
							<div class="ibox-title">
								<h5>Products</h5>
							</div>
							<div class="ibox-content" style="display: block;">

								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Item</th>
											<th>Cost</th>
											<th>Qty</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
									
									
										<tr dir-paginate="row in getitemlist |  itemsPerPage:10">
											<td>@{{$index + 1}}</td>
											<td> 
												@{{row.name}}
											</td>
											<td>
												$ @{{row.price}}
											</td>
											<td>@{{row.quantity }}</td>
											<td>
												$ @{{ row.price *row.quantity}} 
											</td>
										</tr>
										
									
									</tbody>
								</table>
								 <dir-pagination-controls 
			boundary-links="true" 
			direction-links="true" >
			</dir-pagination-controls>
								<table class="table invoice-total">
									<tbody>
									<tr>
										<td><strong>Sub Total :</strong></td>
										<td>$ @{{total}}</td>
									</tr>
									<!--tr>
										<td><strong>TAX :</strong></td>
										<td>$235.98</td>
									</tr-->
									<tr>
										<td><strong>TOTAL :</strong></td>
										<td>$ @{{total}}</td>
									</tr>
									</tbody>
								</table>

							</div>
			</div>

			<br>
			
		</div>
		
		
		
		
		
		
		<div class="col-lg-4">
			<div class="widget lazur-bg p-xl">
								<div class="m-b-md">
									<h2 class="font-bold no-margins">
										Account Information
									</h2>
								</div>
                                <h2>
                                     @{{getsingleorder.firstname}}  @{{getsingleorder.lastname}} 
                                </h2>
								<ul class="list-unstyled m-t-md">
									<li>
										<span class="fa fa-envelope m-r-xs"></span>
										<label>Email:</label>
										 @{{getsingleorder.email}}
									</li>
									<li>
										<span class="fa fa-home m-r-xs"></span>
										<label>Address:</label>
										 @{{getsingleorder.address}}
									</li>
									<li>
										<span class="fa fa-phone m-r-xs"></span>
										<label>Contact:</label>
										 @{{getsingleorder.mobile}}
									</li>
								</ul>

			</div>
			
			<div class="ibox">
				<div class="ibox-title">
                    <h5><i class="fa fa-road"></i> Shiping Information</h5>
                </div>
						
				<div class="ibox-content ">
					<div class="m-b-md">
                           
                            
                            <h3 class="font-bold no-margins">
                                
                            </h3>
							
							<dl class="dl-horizontal">

                                <dt>Shipping Method:</dt> <dd>Standard Shipping</dd>
                                <dt>Fare:</dt> <dd> $ 5</dd>

                            </dl>
                            
							
							
                        </div>
				</div>
			</div>
			
			<div class="ibox">
                        <div class="ibox-title">
                            <h5>Change order Status</h5>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="updatestatus">
                                <div class="custmstatus"></div>
                                <div class="form-group"><label class="col-lg-3 control-label">Status</label>
                                     <input type="hidden" value="<?php echo $id;?>" name="order_id">
									 <input type="hidden" id="token"  value="<?php echo csrf_token(); ?>">
                                    <div class="col-lg-6">
										<select class="form-control m-b" name="status_id" required>
										@foreach ($status as  $key =>$row)
											<option value="{{$row->id}}">{{$row->status}}</option>
											
											
										 @endforeach
											
										</select>
                                    </div>
                                </div>
								
                                <div class="form-group"><label class="col-lg-3 control-label">Description</label>

                                    <div class="col-lg-6">
										<textarea class="form-control " name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-sm btn-success" type="button" onClick="SaveOrderstatus()">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
				</div>
			

		</div>

<div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Detail</h5>


                    </div>
                    <div class="ibox-content">
                        <div class="custm"></div>
                        
                        
                        
                        
                        <form class="form-horizontal editbanner" id="custm" method="POST" >                      
                            <div class="form-group"><label class="col-lg-2 control-label">Address</label>
                                <div class="col-lg-8">
                                    
                                    <input type="hidden"  name="id" class="form-control"  value=" @{{getsingleorder.customer_id}}">
                                   <input type="hidden"  name="product_id" class="form-control"  value="<?php echo $id;?>">
                                   <textarea class="form-control " name="address" required>@{{getsingleorder.address}}</textarea>

                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Contact No</label>
                                <div class="col-lg-8">
                                    <input type="text"  name="mobile" class="form-control"  required id="title"  value=" @{{getsingleorder.mobile}}">
                                   

                                </div>
                            </div>
                            
                      
                                     
                                     
                                     
                             


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                  
                       <button type="button" class="btn btn-primary pull-left" ng-click="Editcustm()">Edit </button>
                                </div>
                            </div>
                     </form> 
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>

    </div>

	









@endsection