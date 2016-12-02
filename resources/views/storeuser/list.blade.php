@extends('layouts.storeapp')
 
@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Store Information</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>

            <li class="active">
                <strong>Store Information</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div ng-app="apps" ng-controller="store" ng-init="liststoreuser()">
<div class="wrapper wrapper-content animated fadeInRight" >
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Information

                    </h5>

                </div>
               
                <div class="ibox-content" >
                    <div class="">
                       <div class="changepasres" tabindex='1'></div>
                        <form class="form-horizontal" id="store"  method="POST" action="{{ url('editstoredata')}}">
                        <div class="form-group"><label class="col-sm-2 control-label">Store ID</label>

                            <div class="col-sm-8"><input  type="text"   id="uneaque_id"  placeholder="002456"  readonly="" class="form-control" value="@{{detailsstores.uneaque_id}}"> <span
                                    class="help-block m-b-none">Generated automatically</span>
                            </div>
                        </div>
                        <!--div class="form-group"><label class="col-sm-2 control-label">Store Type</label>

    <div class="col-sm-4"><select class="form-control m-b" name="account">
                                    <option selected="selected">Select Store Type</option>
        <option>Single Store</option>
        <option>Chain Store</option>
        
    </select>
    </div>
</div-->
                        <div class="form-group"><label class="col-sm-2 control-label">Store name</label>

                            <div class="col-sm-8"><input type="text" id="sname"  name ="name" class="form-control" value="@{{detailsstores.name}}"data-parsley-trigger="keyup"  data-parsley-minlength="3" required></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store Number</label>

                            <div class="col-sm-8"><input type="text" class="form-control" name="corporateidentifier" value="@{{detailsstores.corporateidentifier}}" id="snumber" data-parsley-type="digits" data-parsley-trigger="keyup" data-parsley-minlength="3" required> <span
                                    class="help-block m-b-none">Corporate Store identifier #</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-8"><input type="text" class="form-control" name="address" id="saddress" value="@{{detailsstores.address}}" required> 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Address2</label>

                            <div class="col-sm-8"><input type="text" class="form-control" name="address2" id="saddress2" value="@{{detailsstores.address2}}" > 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="country" class="form-control m-b country"  style="width:275px;" tabindex="4" required>
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $key => $users)
                                                    <option value="{{ $users -> id}}">{{ $users -> name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							 <div class="form-group"><label class="col-sm-2 control-label">State</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="state" class="form-control m-b state" style="width:275px;" tabindex="4" required>
                                                    <option value="">Select State</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group" ><label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="city" class="form-control m-b city" style="width:275px;" tabindex="4">
                                                    <option value="">Select City</option>

                                                </select>



                                                <div class="field_wrapper" align="right" style="position: relative">                        
                                                    <a href="javascript:void(0);" class="add_button" title="Add City"  style="position: absolute; top: 7px; right: -15px;">
                                                        <span class="fa fa-plus-circle fie" aria-hidden="true"></span></a>

                                                    <!--                                                  <fieldset class="answer">
                                                                                                        <label for="coupon_field"></label>
                                                                                                        <input type="text" name="city" id="coupon_field" style="width:275px; height:30px" />
                                                                                                    </fieldset>
                                                                                                          <fieldset class="question">
                                                                                                        <label for="coupon_question"></label>
                                                                                                        <input class="coupon_question" type="checkbox" name="coupon_question" value="1" />
                                                                                                        <span class="item-text">Add City</span>
                                                                                                    </fieldset>-->        
                                                </div> 

                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            
                        <div class="form-group"><label class="col-sm-2 control-label">Zip</label>
                            <div class="col-md-4"><input name="zip" id="zip" type="text" placeholder="30350" data-parsley-trigger="keyup" data-parsley-minlength="3" data-parsley-type="digits" required=""
                                                         class="form-control" value="@{{detailsstores.zip}}" ></div>
                        </div>
						   <div class="form-group"><label class="col-sm-2 control-label">Latitude</label>
                            <div class="col-md-4"><input name="latitude" id="latitude" type="text" 
                                                         class="form-control" value="@{{detailsstores.latitude}}" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Longitude</label>
                            <div class="col-md-4"><input name="longitude" id="longitude"   type="text" 
                                                         class="form-control" value="@{{detailsstores.longitude}}" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" 
    data-parsley-type="number"></div>
                        </div>  
						<div class="form-group"><label class="col-sm-2 control-label">Store Opening Time</label>
                            <div class="col-md-4"><div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" name="opening_time" value="@{{detailsstores.opening_time}}" readonly>
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            </div></div>
                        </div><div class="form-group"><label class="col-sm-2 control-label">Store Closing Time</label>
                            <div class="col-md-4"><div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" name="closing_time" value="@{{detailsstores.closing_time}}" readonly>
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                            </div></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="4" data-parsley-type="digits" required placeholder="" name="phone" id="phone" value="@{{detailsstores.phone}}" >
                                <!--span class="help-block">(999) 999-9999</span-->
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-8"><input type="email" placeholder="store@email.com" class="form-control" name="mail" id="mail" value="@{{detailsstores.mail}}" required></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store website</label>

                            <div class="col-sm-8"><input type="text" placeholder="www.redstore.com" class="form-control" name="website" id="website" data-parsley-validation-threshold="1" data-parsley-type="url" value="@{{detailsstores.website}}"></div>
                        </div>
						<input type="hidden" name="id" id="ids"  value="@{{detailsstores.id}}">



                        <div class="hr-line-dashed"></div>
							 <div class="form-group"><label class="col-sm-2 control-label">Upload logo</label>
                                <div class="col-sm-6">
                                    <div class="fileinput fileinput-new" data-provides="fileinput" >
                                        <input type="file"  name="image" accept="image/*">
                                    </div>
                                </div> 
                            </div>
							<div class="imageshows" style="text-align:center;margin-bottom:10px">
							</div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-2">
                                
                                <button class="btn btn-primary" type="submit" onClick="Editstore()">Save</button>
								
                    
							
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>



        </div>



        <div class="col-lg-7">
            @permission('storeuser-list')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Store users </h5>


                </div>
                <div class="usersres"></div>
                    <div class="ibox-content" ng-init="storeusersid('<?php echo Session::get('id')?>')">
				
				
                    <a ui-sref="settings.add_users" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" >Add users  </a>
                    
					<table class="table table-bordered topspace" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                
                                <th>Email</th>
                                <th>Role</th>
                                <th class="">Action</th>



                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr dir-paginate="lists in detailsusers | itemsPerPage:5">
                                <td>@{{$index +1}}</td>
                                <td>@{{ lists.firstname }} </td>
                                <td>@{{ lists.lastname }}</td>
                               
                                <td>@{{lists.email }}</td>
                                <td>@{{lists.display_name }}</td>
                                <td>
								
								

                                    <a data-popup-open="popup-1" href="#"> <button class="btn-warning btn btn-sm" data-id="@{{lists.id}}" onClick="edituser(this);"><i class="fa fa-wrench"></i> Edit</button></a>
                                   
									<button class="btn-danger btn btn-sm" data-id="@{{lists.id}}" ng-hide="storeuserid ==lists.id" onClick="deleteuser(this);"><i class="fa fa-trash-o"></i> Delete</button>
                                   
                                </td>
                            </tr>
							
							<tr ng-show="detailsusers.length==0">
							<td colspan="6">No Users</td>
							</tr>
                          
                        </tbody>
                    </table>
                       <dir-pagination-controls 
			boundary-links="true" 
			direction-links="true" >
			</dir-pagination-controls>
                </div>
            </div>
             @endpermission 

        </div>
		
       <div class="ibox float-e-margins" >
           <div class="tabs-container"  >
		    <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href=".sumesh1" aria-expanded="true">Store Departments</a></li>
					<li class=""><a data-toggle="tab" href=".sumesh2" aria-expanded="false">Banner</a></li>
			</ul>
			<div class="tab-content">
           <div id="sumesh1" class="tab-pane active sumesh1">
           
            <div class="panel-body">
							
							<br>
						       <div class="adddpts" tabindex="1"></div>
								<div class="">
									<form role="form" class="form-horizontal ng-pristine ng-valid" id="adddpts" method="POST" action="{{ url('adddepts')}}">
										<div class="form-group">
											<label class="col-sm-2 control-label">Department name</label>
											<div class="col-sm-6">
												<input class="form-control" type="text" required name="name">
												<input class="form-control stores_id" type="hidden"  name="store_id" value="<?php echo Session::get('store_userid')?>">
											</div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Upload image</label>
											<div class="col-sm-6">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													
													<input type="file"  name="image" accept="image/*">
										
								
												</div>
											</div> 
										</div>
										
										<div class="form-group">
											<div class="col-sm-8">
											   <button type="submit" class="btn btn-primary pull-right" ng-click="Adddpt()">Add New </button>
												
											</div>
										</div>
																
									</form>
									
								</div>
								
								
						
							
							
							
							<br>
							
							<div class="ibox-title">
								<h5>Edit or Remove Departments</h5>
								
							</div>
							<div class="ibox-content" style="display: block;" >
                                
								<table class="table" ng-init="listdepartments('<?php echo Session::get('store_userid')?>');">
									<thead>
									<tr>
										<th>#</th>
										<th>Image</th>
										<th>Departments</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<tr ng-show="listdepartments.length==0" colspan="4"><td>No Departments</td></tr>
									<tr dir-paginate="list in listdepartments | itemsPerPage:7">
										<td>@{{$index + 1}}</td>
										<td> 
							             <span ng-show="list.image"><img src="@{{list.image}}" width="50" height="50"></span></td> <!-- Image -->
										<td>@{{list.name}}</td>
										<td>
											<a href="#" data-id="@{{list.id}}" onClick="editdepartments(this);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myDepartments">Edit </a>
											 @permission('delete-departments')<a data-toggle="modal" class="btn btn-danger btn-sm" data-target="#Deletedpt" onclick="GetDptid(this)" data-id="@{{list.id}}">Delete
                   </a>@endpermission
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
		
		
		<div id="sumesh2" class="tab-pane sumesh2">
						<div class="panel-body">
							
							<br>
						       <div class="uploadsucess" tabindex="1"></div>
								<div class="">
									<form role="form" class="form-horizontal ng-pristine ng-valid" id="addbanner" method="POST" action="{{ url('savebanner')}}">
										<div class="form-group">
											<label class="col-sm-2 control-label">Add Name</label>
											<div class="col-sm-6">
												<input class="form-control" type="text" required name="title">
												<input class="form-control stores_id" type="hidden"  name="store_id" value="<?php echo Session::get('store_userid')?>">
											</div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Upload Banner</label>
											<div class="col-sm-6">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													
													<input type="file" required name="image" accept="image/*">
										
								
												</div>
											</div> 
										</div>
										
										<div class="form-group">
											<div class="col-sm-8">
											   <button type="submit" class="btn btn-primary pull-right" ng-disabled="isDisabled" ng-click="AddBanner()">Add New Banner</button>
												
											</div>
										</div>
																
									</form>
									
								</div>
								
								
						
							
							
							
							<br>
							
							<div class="ibox-title">
								<h5>Edit or Remove Banner</h5>
							</div>
							<div class="ibox-content" style="display: block;" >
                                
								<table class="table" ng-init="listbanner('<?php echo Session::get('store_userid')?>');">
									<thead>
									<tr>
										<th>#</th>
										<th>Banner</th>
										<th>Title</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<tr ng-show="listbanner.length==0" colspan="4"><td>No Banners</td></tr>
									<tr dir-paginate="list in listbanner | itemsPerPage:7">
										<td>@{{$index + 1}}</td>
										<td> 
							             <img src="@{{list.image}}" width="50" height="50"></td> <!-- Image -->
										<td>@{{list.title}}</td>
										<td>
											<a href="#" data-id="@{{list.id}}" onClick="editbanner(this);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myBanner">Edit </a>
											  <a  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Deleteroles"  onClick="Takeids(this)" data-id="@{{list.id}}">
        Delete</a></td>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Create user</h5>


                        </div>
                        <div class="ibox-content">
                            <div class="usersucess"></div>
                            <form class="form-horizontal create_user">

                                <div class="form-group"><label class="col-lg-2 control-label">User Id</label>

                                    <div class="col-lg-8"><input type="text" name="unique_id" value="<?php echo ( rand() + $users->id ); ?>" readonly placeholder="User Id" class="form-control" > <span
                                            class="help-block m-b-none">User Id is generated automatically</span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">User role</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="role_id" required>
                                           <?php
                                            foreach ($roles as $role) {
                                                ?>
                                                <option value="<?php echo $role->id; ?>"><?php echo $role->display_name; ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                                    <div class="col-lg-8"><input type="text" placeholder="first name" name ="firstname" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                                    <div class="col-lg-8"><input type="text" placeholder="last name" name ="lastname" class="form-control" required> 
                                    <input type="hidden"  name="store_id"  class="form-control" required id="store_ids" value="@{{detailsstores.id}}" class="store_id" ></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                    <div class="col-lg-8"><input type="email" placeholder="email" name ="email" class="form-control" id="ghghgh" required> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label"> Confirm Email</label>

                                    <div class="col-lg-8"><input type="email" placeholder="email" class="form-control" data-parsley-equalto="#ghghgh" data-parsley-equalto-message="Email confirmation must match the Email." required=""> 
                                        <input type="hidden" placeholder="email" class="form-control" value="1" name="type"> 
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8">
                                        <button class="btn btn-md btn-primary" type="button" onClick="Create()">Create User</button>
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



<a  class="btn btn-primary edit" data-toggle="modal" data-target="#myModal2" style="display:none">edit users  </a>

<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit user</h5>


                    </div>
                    <div class="ibox-content">
                        <div class="editsucess"></div>
                        <form class="form-horizontal edituser">

                            <div class="form-group"><label class="col-lg-2 control-label">User Id</label>

                                <div class="col-lg-8"><input type="text" name="unique_id" id="uneaque_ids" readonly placeholder="User Id" class="form-control" > <span
                                        class="help-block m-b-none">User Id is generated automatically</span>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">User role</label>

                                <div class="col-sm-4"><select class="form-control m-b" name="role_id" required id="role_id">
                                        <?php
                                        foreach ($roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->id; ?>"><?php echo $role->display_name; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                                <div class="col-lg-8"><input type="text" placeholder="first name" name ="firstname" class="form-control" required id="firstname">
                                    <input type="hidden" placeholder="first name" name ="id" class="form-control"  required id="id_edit">
									
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                                <div class="col-lg-8"><input type="text" placeholder="last name" name ="lastname" id="lastname" class="form-control" required> 
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-8"><input type="email" placeholder="email" id="email" name ="email" class="form-control" id="ghghgh" required> 
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <button class="btn btn-md btn-primary" type="button" onClick="editCreated()">Create User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModaladdstore" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit user</h5>


                    </div>
                    <div class="ibox-content">
                        Please add Store Details
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
	</div>
<div class="modal fade" id="Deletedpt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H3">Delete this record?</h4>
      </div>
      <div class="modal-body">
	   The departments related category,product deleted.<br>
	   This operation can't be undo.<br>
       Are you sure to delete this record?
      </div>
	  <input type="hidden" id="get_dptid">
	  <div class="deletedpt" style="width:55%;margin-left:10px;text-align:center"></div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onClick="Deletedpt()">Delete</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myBanner" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit banner</h5>


                    </div>
                    <div class="ibox-content">
                        <div class="uploadsucesss"></div>
                        
                        
                        
                        
                        <form class="form-horizontal editbanner" id="editbanner" method="POST" action="{{ url('bannerupdate')}}">                      
                            <div class="form-group"><label class="col-lg-2 control-label">Tittle</label>
                                <div class="col-lg-8">
                                    <input type="text"  name ="title" class="form-control"  required id="title">
                                    <input type="hidden"  name ="id" class="form-control" required id="panid">
                                   		
                                </div>
                            </div>
                            
                            <div class="form-group"><label class="col-lg-2 control-label">Image</label>

                                <div class="col-lg-8" id="imaged">
                                    
                                     <div class="imageshow"></div>
                                       </div>
          
                            </div> 
                         
                                  
                            <div class="form-group"><label class="col-sm-2 control-label">Upload Banner</label>
                                <div class="col-lg-4">  
                                    <input type="file" name="image"  accept="image/*">
                                    <span class="help-block m-b-none"></span>

                                </div>
          
                            </div> 
                      
                                     
                                     
                                     
                             


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                  
                       <button type="submit" class="btn btn-primary pull-left" Onclick="bannerCreated()">Edit Banner</button>
                                </div>
                            </div>
                     </form> 
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div><div class="modal fade" id="myDepartments" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Departments</h5>


                    </div>
                    <div class="ibox-content">
                        <div class="uploaddpt"></div>
                        
                        
                        
                        
                        <form class="form-horizontal" id="editdpts" method="POST" action="{{ url('dptsupdate')}}">                      
                            <div class="form-group"><label class="col-lg-2 control-label">Tittle</label>
                                <div class="col-lg-8">
                                    <input type="text"  name ="name" class="form-control"  required id="dptname">
                                    <input type="hidden"  name ="id" class="form-control" required id="dptssid">
<input class="form-control stores_id" type="hidden"  name="store_id" value="<?php echo Session::get('store_userid')?>">
									
                                </div>
                            </div>
                            
                            <div class="form-group"><label class="col-lg-2 control-label">Image</label>

                                <div class="col-lg-8" id="">
                                    
                                     <div class="imageshowdpt"></div>
                                       </div>
          
                            </div> 
                         
                                  
                            <div class="form-group"><label class="col-sm-2 control-label">Upload Image</label>
                                <div class="col-lg-4">  
                                    <input type="file" name="image" accept="image/*">
                                    <span class="help-block m-b-none"></span>

                                </div>
          
                            </div> 
                      
                                     
                                     
                                     
                             


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                  
                       <button type="submit" class="btn btn-primary pull-left" Onclick="dptCreated()">Edit </button>
                                </div>
                            </div>
                     </form> 
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>
		<div class="modal fade" id="Deleteroles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H3">Delete this record?</h4>
      </div>

   <input type="hidden" id="get_id"><input type="hidden" id="token"  value="<?php echo csrf_token(); ?>">
  <div class="modal-body">
                Are you sure to delete this record?
            </div>
			<div class="deleteroles" style="width:50%;margin-left:10px;text-align:center"></div>
      <div class="modal-footer">
   
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
  
        <button class="btn btn-danger" onClick="deletebanner()">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection