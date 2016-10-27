

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
                Category 
            </li>
			 <li class="active">
                <strong>Category</strong>
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
                    <label class="control-label" for="product_name">Type</label><br>
					<input type="radio" value="general" name="type"    onchange="GetdpttypeSearch(this);" ng-model="type"> General 
                    <input type="radio" value="1" name="type"  onchange="GetdpttypeSearch(this);" ng-model="type"> Departments</div>
            </div>
            
            <div class="col-sm-4 dpts hide" >
                <div class="form-group">
                    <label class="control-label" for="status">Department</label>
                    <select  id="departments_id" name="departments_id" class="form-control" ng-model="department">
                       <option >Select option</option>
					   
                       
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="quantity">Category</label>
                    <input type="text" id="quantity" name="quantity" value="" placeholder="Category" class="form-control" ng-model="category">
                </div>
            </div>

        </div>
        <div class="text-right">
            <button type="button" class="btn btn-w-m btn-primary" >
                Search
            </button>
        </div>
    </div>
<div class="row"  >
    <div class="col-lg-12">
	<div class="ibox">
            <div class="ibox-title">
                <h5>Category </h5>            
            </div>		
            <div class="ibox-content">
			
			<style>
				.inbox-table{
					width: 100%;
					min-width: 685px !imporant;
					min-height: 100px;
					overflow-x: auto !imporant;
					clear: both;
					padding: 0 15px;
					margin-bottom: 15px;
				}
				.inbox-table-head, .inbox-table-row{
					width: 100%;
					min-width: 685px !imporant;
					border-top: 1px solid #ddd;
					clear: both;
					display: block;
					
					
				}
				.inbox-table-head{
					font-size: 13px;
					font-weight: bold;
				}
				.s_col_1{
					width: 24%;
					min-width: 170px !imporant;
					padding: 8px 15px;
					display: inline-block;
				}
			</style>
				
			<div class="row">
				<div class="inbox-table">
					
					<!-- Table head >> -->
					<div class="inbox-table-head" ng-init="listcategory()">
						<div class="">
							<div class="s_col_1">
								Name
							</div>
							<div class="s_col_1">
								Departments/General
							</div>
							<div class="s_col_1">
								Description
							</div>
							<div class="s_col_1">
								Action
							</div>
						</div>
					</div>
					<!-- Table head << -->
					
					<!-- Table body >> -->
					<!--div class="inbox-table-row">
						<div class="">
							<div class="s_col_1">
								1
							</div>
							<div class="s_col_1">
								2
							</div>
							<div class="s_col_1">
								3
							</div>
							<div class="s_col_1">
								<a class="btn btn-primary" href="">Edit</a>			  
								<a class="btn btn-danger " >Delete</a>
							</div>
						</div>
					</div>
					<!-- Table body << -->
					<!-- Table body >> -->
					<!--div class="inbox-table-row">
						<div class="">
							<div class="s_col_1">
								1
							</div>
							<div class="s_col_1">
								2
							</div>
							<div class="s_col_1">
								3
							</div>
							<div class="s_col_1">
								<a class="btn btn-primary" href="">Edit</a>			  
								<a class="btn btn-danger " >Delete</a>
							</div>
						</div>
					</div-->
					<!-- Table body << -->
					
					<!-- Table body << -->
					<!-- Table body >> -->
					<div class="inbox-table-row" ng-show="listcategory.length==0" style="border-bottom:1px solid #ddd">
						<div class="">
						<div class="s_col_1">
							No Categories
						</div></div>
					</div>
					<div class="inbox-table-row" ng-repeat="subCate in listcategory | filter:department | filter:type| filter:category">
						<div class="" >
							<div class="s_col_1">
								@{{ subCate.categoryname }}
							</div>
							<div class="s_col_1">
								@{{ subCate.dptname }}
							</div>
							<div class="s_col_1">
								@{{ subCate.description }}
							</div>
							<div class="s_col_1">
								@permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{firstNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ firstNestedSub.id }}">Delete</a>
								 @endpermission
							</div>
							
							
							
							<div class="inbox-table-row" ng-repeat="firstNestedSub in subCate.subCategory">
						<div class="">
							<div class="s_col_1">
								--@{{ firstNestedSub.categoryname }}
							</div>
							<div class="s_col_1">
								@{{ firstNestedSub.dptname }} 
							</div>
							<div class="s_col_1">
								@{{ firstNestedSub.description }}
							</div>
							<div class="s_col_1">
								  @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{firstNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ firstNestedSub.id }}">Delete</a>
								 @endpermission
							</div>
							
							
							
							<!-- Table body >> -->
					<div class="inbox-table-row" ng-repeat="secondNestedSub in firstNestedSub.subCategory">
						<div class="">
							<div class="s_col_1">
								----@{{ secondNestedSub.categoryname }}
							</div>
							<div class="s_col_1">
								@{{ secondNestedSub.dptname }}
							</div>
							<div class="s_col_1">
								@{{ secondNestedSub.description }}
							</div>
							<div class="s_col_1">
								@permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{secondNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ secondNestedSub.id }}">Delete</a>
								 @endpermission
							</div>
							
							
							<div class="inbox-table-row" ng-repeat="thirdNestedSub in secondNestedSub.subCategory">
						<div class="">
							<div class="s_col_1">
								----@{{ thirdNestedSub.categoryname }}
							</div>
							<div class="s_col_1">
								@{{ thirdNestedSub.dptname }}
							</div>
							<div class="s_col_1">
								@{{ thirdNestedSub.description }}
							</div>
							<div class="s_col_1">
								@permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{thirdNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ thirdNestedSub.id }}">Delete</a>
								 @endpermission
							</div>
						</div>
					</div>
							
							
							
							
							
							
							
							
						</div>
					</div>
					<!-- Table body << -->
							
							
							
						</div>
					</div>
							
							
						</div>
					</div>
					<!-- Table body << -->
					
				
				</div>
			</div>
			
			
			
			         @permission('add-category')
                       <!--a href="{{ url('category')}}" class="btn btn-primary">Add Category</a-->
					   @endpermission
                <!--table class="footable table table-stripped toggle-arrow-tiny" ng-init="listcategory()">
                    <thead>
                    <tr>
                        
                        <th> Name </th>
						<th> Departments/General </th>
						
                      
						<th>Description</th>
						
						
                       
						<th class="">Action</th>
						
						
						
                    </tr>
                    </thead>
                            <tbody>
					  
               
                   
                    <tr ng-repeat="subCate in listcategory | filter:department | filter:type| filter:category">
                        <td>@{{ subCate.categoryname }} </td>
						<td>@{{ subCate.dptname }} </td>
					
                        <td>@{{ subCate.description }}</td>
                       
                        <td>	
						@permission('edit-category')  
						<a class="btn btn-primary" href="{{ url('/editcategory/ ')}}@{{subCate.id}}">Edit</a>
						@endpermission
						@permission('delete-category')  
						<a class="btn btn-danger " onClick="TakeId(this)" data-id="@{{ subCate.id }}" data-toggle="modal" data-target="#DeleteModal">Delete</a>@endpermission</td>
						
						
                            <tr ng-repeat="firstNestedSub in subCate.subCategory">
                                <td>--@{{ firstNestedSub.categoryname }}</td>
								
                                <td>@{{ firstNestedSub.dptname }}</td> 
								<td>@{{ firstNestedSub.description }}</td> 
								
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{firstNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ firstNestedSub.id }}">Delete</a>
								 @endpermission
								 </td>
                                
                            <tr ng-repeat="secondNestedSub in firstNestedSub.subCategory">
                                <td>---@{{ secondNestedSub.categoryname }}</td>
                               
								<td>@{{ secondNestedSub.dptname }}</td>
								<td>@{{ secondNestedSub.description }}</td>
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{secondNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ secondNestedSub.id }}">Delete</a>
								 @endpermission
								 </td>
                                   
                            <tr ng-repeat="thirdNestedSub in secondNestedSub.subCategory">
                                <td>----@{{ thirdNestedSub.categoryname }}</td>
                               
								<td>@{{ thirdNestedSub.description }}</td>
								<td>@{{ thirdNestedSub.dptname }}</td>
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}@{{thirdNestedSub.id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="@{{ thirdNestedSub.id }}">Delete</a>
								 @endpermission
								 </td>
                                	
                            </tr>
                        

								
                            </tr >
                       
                            </tr >
                        
                    </tr>
					
                
 </tbody>
	</table-->
	

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
        <button type="button" class="btn btn-danger" onClick="DeleteCategory()">Delete</button>
      </div>
    </div>
  </div>
</div>
	
	
	
@endsection








