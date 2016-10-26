@extends('layouts.storeapp')


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Store Inventory</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li>
                Inventory
            </li>
            <li class="active">
                <strong>View inventory</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce" ng-app="apps" ng-controller="store">
    <div class="ibox-content m-b-sm border-bottom" >
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group" >
                    <label class="control-label" for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name" class="form-control" ng-model="letter">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="price">Unique Id</label>
                    <input type="text" id="price" name="price" value="" placeholder="Stock ID" class="form-control" ng-model="unique">
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <label class="control-label" for="status">Department</label>
                    <select name="status" id="status" class="form-control" ng-model="department">
                        <option value="0" >All Departments</option>
                        @foreach ($dept as $key => $user)
                        <option value="{{$user-> id}}" >{{$user->name}}</option>
                        @endforeach
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

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15"  ng-init="listproducts()">
                        <thead>
                            <tr>

                                <th data-toggle="true">Product Name</th>
                                <th data-hide="phone">Unique ID</th>
                                <th data-hide="all">Description</th>
                                <th data-hide="phone">Price</th>
                                <th data-hide="phone,tablet">Quantity</th>
                                <th data-hide="phone">Department/General</th>
                                <th data-hide="phone">Category</th>

                                <th class="text-right" data-sort-ignore="true">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-show="listproducts.length == 0"><td colspan="8"> No Products</td></tr>
                            <tr dir-paginate="product in listproducts| itemsPerPage:5 | filter:letter | filter:unique| filter:category | filter:department ">

                                <td>@{{product.name}}</td>
                                <td>@{{product.unique_id}}</td>
                                <td>@{{product.description}}</td> 
                                <td>@{{product.price}}</td>
                                <td>@{{product.quantity}}</td>
                                <td>@{{product.departments}}</td> 
                                <td>@{{product.categoryname}}</td>
                                <td class="text-right">
								@permission('edit-product')    
								<a class="btn btn-primary " href="{{ url('/editproduct/ ')}}@{{product.id}}" >Edit</a>
								@endpermission
								@permission('delete-product')   
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)" data-id="@{{product.id}}" data-toggle="modal" data-target="#DeleteModal" >Delete</a></td>
                                @endpermission
							</tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
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
                <button type="button" class="btn btn-danger" onClick="DeleteProduct()">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection