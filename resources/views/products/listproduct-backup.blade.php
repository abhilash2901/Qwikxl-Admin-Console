@extends('layouts.storeapp')


@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Product List </h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li >
                Product List 
            </li>
            <li class="active">
                <strong>Product List </strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">

    </div>
</div>
<div class="row">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5> Product List  </h5>            
        </div>		
        <div class="ibox-content">
            <a href="{{ url('addproduct') }}" class="btn btn-primary">Add Product</a>
            <table class="table table-bordered topspace">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Name </th>

                        <th>Category</th>
                        <th>Department</th>
                        <th>Price</th>


                        <th class="">Action</th>



                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->categoryname }}</td>
                        <td>
                            {{ $user->departments }}   
                        </td>
                        <td>
                            {{ $user->price }}   
                        </td>
                        <td><a class="btn btn-primary " href="{{ url('/editproduct/ ')}}{{$user->id}}" >Edit</a><a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)" data-id="{{$user->id}}" data-toggle="modal" data-target="#DeleteModal" >Delete</a></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>


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