
@extends('layouts.storeapp')

@section('content')



<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit Products</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
                <a href="{{ url('/users') }}"> Products</a>
            </li>
            <li class="active">
                Edit Products
            </li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5> Edit Products </h5>    
        </div>
        <div class="ibox-content">
            <div class="uploadsucess"></div>




            <form method="POST" id="addproduct" class="form-horizontal" action="{{ url('updateproduct')}}" >
                <div class="form-group"><label class="col-lg-2 control-label">Product Id</label>

                    <div class="col-lg-8">   <input  type="text" name="unique_id"  placeholder="002456" value="{{$data->unique_id}}" readonly="" class="form-control"> <span
                            class="help-block m-b-none">Generated automatically</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                    <div class="col-lg-8">
                        <input  type="text" name="name"  placeholder="name" value="{{$data->name}}" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z0-9 ]*$" data-parsley-minlength="3"  required class="form-control">							
                        <span
                            class="help-block m-b-none"></span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Type</label>

                    <div class="col-lg-8">  
                        <input type="radio" value="0" name="type" <?php if ($data->dpt_type == '1') echo "checked"; ?> onchange="Getdpttype(this);" required> General 
                        <input type="radio" value="1" name="type" <?php if ($data->dpt_type == '0') echo "checked"; ?> onchange="Getdpttype(this);"> Departments
                        <span
                            class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group sdpt hide"><label class="col-lg-2 control-label">Departments</label>
                    <input type="hidden" id="dpt_id" value="<?php echo $data->departments_id;?>">
                    <div class="col-lg-8">  
                        <select class="form-control m-b type departments_productid" id="departments_id" name="department_id" onchange="departmnts(this)" required>
                            @foreach ($dept as $key => $user)
                            <option value="{{$user->id}}" <?php if ($data->departments_id == $user->id){echo "selected";}  ?>>{{$user->name}}</option>
                            @endforeach
                        </select> <span
                            class="help-block m-b-none"></span>
                    </div>
                </div>
               <div class="form-group dpts <?php if($data->dpt_type=='1')echo "hide";?>"><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
					<div class="tree sss">

 <!--ul class="category">
  @foreach($categories as $subCate)
    <li class="<?php if(count($subCate->subCategory)==0 || $subCate->id ==$data->categories_id) echo'active';?>"><a  class="<?php if($subCate->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $subCate->id }}">{{ $subCate->categoryname }}</a>
	 
    <ul style="display:block">
	@foreach($subCate->subCategory as $firstNestedSub)
        <li class="<?php if(count($firstNestedSub->subCategory)==0 || $firstNestedSub->id ==$data->categories_id) echo'active';?>" ><a class="<?php if($firstNestedSub->id == $data->categories_id) echo "red";?>"  onClick="getCategory(this)" data-id="{{ $firstNestedSub->id }}"> {{ $firstNestedSub->categoryname }}</a>
		 
		 <ul style="display:block">
		@foreach($firstNestedSub->subCategory as $secondNestedSub)
		 <li  class="<?php if(count($secondNestedSub->subCategory)==0 || $secondNestedSub->id ==$data->categories_id) echo'active';?>"><a class="<?php if($secondNestedSub->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $secondNestedSub->id }}"> {{ $secondNestedSub->categoryname }}</a>
		 <ul style="display:block">
		  @foreach($secondNestedSub->subCategory as $thirdNestedSub)
		 <li  class="<?php if( $thirdNestedSub->id ==$data->categories_id) echo'active';?>" ><a class="<?php if($thirdNestedSub->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}</a>
		 </li>
		 
		 @endforeach
		 </ul>
		 </li>
		@endforeach
		</ul>
		</li>
       
		 @endforeach
    </ul>
    </li>
	 @endforeach
   
    
</ul-->
</div>
					
					</div>
            </div><div class="form-group nodpt <?php if($data->dpt_type=='0')echo "hide";?>""><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
					<div class="tree">
 
<ul class="category">
  @foreach($categoriesnon as $subCate)
    <li class="<?php if(count($subCate->subCategory)==0 || $subCate->id ==$data->categories_id) echo'active';?>"><a  class="<?php if($subCate->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $subCate->id }}">{{ $subCate->categoryname }}</a>
	 
    <ul style="display:block">
	@foreach($subCate->subCategory as $firstNestedSub)
        <li class="<?php if(count($firstNestedSub->subCategory)==0 || $firstNestedSub->id ==$data->categories_id) echo'active';?>" ><a class="<?php if($firstNestedSub->id == $data->categories_id) echo "red";?>"  onClick="getCategory(this)" data-id="{{ $firstNestedSub->id }}"> {{ $firstNestedSub->categoryname }}</a>
		 
		 <ul style="display:block">
		@foreach($firstNestedSub->subCategory as $secondNestedSub)
		 <li  class="<?php if(count($secondNestedSub->subCategory)==0 || $secondNestedSub->id ==$data->categories_id) echo'active';?>"><a class="<?php if($secondNestedSub->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $secondNestedSub->id }}"> {{ $secondNestedSub->categoryname }}</a>
		 <ul style="display:block">
		  @foreach($secondNestedSub->subCategory as $thirdNestedSub)
		 <li  class="<?php if( $thirdNestedSub->id ==$data->categories_id) echo'active';?>" ><a class="<?php if($thirdNestedSub->id == $data->categories_id) echo "red";?>" onClick="getCategory(this)" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}</a>
		 </li>
		 
		 @endforeach
		 </ul>
		 </li>
		@endforeach
		</ul>
		</li>
       
		 @endforeach
    </ul>
    </li>
	 @endforeach
   
    
</ul>
</div>
					
					</div>
            </div>
			
                <div class="form-group"><label class="col-lg-2 control-label" >Price</label>

                    <div class="col-lg-8">
                        <input  type="text" name="price"  placeholder="Price" value="{{$data->price}}" required class="form-control">							

                    </div>
                </div> <div class="form-group"><label class="col-lg-2 control-label" >Quantity</label>

                    <div class="col-lg-8">
                        <input  type="text" name="quantity"  placeholder="Quantity" value="{{$data->quantity}}" required class="form-control">							

                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Description</label>

                    <div class="col-lg-8">  
                        <textarea cols="25" class="form-control" rows="4" name="description" data-parsley-trigger="keyup"  data-parsley-maxlength="200" required>{{$data->description}}</textarea><span
                            class="help-block m-b-none">
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Image</label>

                    <div class="col-lg-4">  
                        <input type="file" name="image"><span
                            class="help-block m-b-none"></span>

                    </div>
                    <div class="col-lg-4">  
                        <?php
                        if ($data->image) {
                            ?>

                            <div class="imageshow"><img src="<?php echo URL::to('/'); ?>/<?php echo $data->image; ?>" width="69%" height="100px"><a style="margin-left:10px;" data-toggle="modal" data-target="#DeleteModal"><i class="glyphicon glyphicon-trash"></i></a></div>
                            <?php
                        }
                        ?>

                    </div>
                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
					<input type="hidden" id="producttype" value="product">

                    <input type="hidden" id="category" name="category_id" value="<?php echo $data->categories_id; ?>">

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-8">
                            <button type="submit" class="btn btn-primary" onClick="EditProduct()">Submit</button>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="H3">Delete this Image?</h4>
            </div>
            <div class="modal-body">
                Are you sure to delete this Image?
            </div>
            <div class="deletesucess" style="width:50%;margin-left:10px;text-align:center"></div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-id="<?php echo $data->id; ?>" onClick="RemovePic(this)">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection