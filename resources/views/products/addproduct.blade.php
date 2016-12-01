
@extends('layouts.storeapp')

@section('content')



<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Add Products</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
                <a href="{{ url('/users') }}"> Products</a>
            </li>
            <li class="active">
                Add Products
            </li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5> Add Products </h5>    
        </div>
        <div class="ibox-content">
            <div class="uploadsucess"></div>




            <form method="POST" id="addproduct" class="form-horizontal" action="{{ url('saveproduct')}}">
                <div class="form-group"><label class="col-lg-2 control-label">Product Id</label>

                    <div class="col-lg-8">   <input  type="text" name="unique_id"  placeholder="002456" value="<?php echo (1000 + $id->id ); ?>" readonly="" class="form-control"> <span
                            class="help-block m-b-none">Generated automatically</span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                    <div class="col-lg-8">   {!! Form::text('name', null, array('placeholder' => 'Item name','class' => 'form-control','data-parsley-trigger'=>'keyup','data-parsley-pattern'=>'^[a-zA-Z0-9 ]*$','data-parsley-minlength'=>'3','required' => '')) !!} <span
                            class="help-block m-b-none"></span>
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Type</label>

                <div class="col-lg-8">  
                    <input type="radio" value="0" name="type"  onchange="Getdpttype(this);" required checked="checked"> General 
                    <input type="radio" value="1" name="type"  onchange="Getdpttype(this);"> Departments
                    <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group dpts hide"><label class="col-lg-2 control-label">Departments</label>
				
					<div class="col-lg-8">  
					   <select class="form-control m-b type " id="departments_id" name="departments_id" onchange="departmnts(this)">
						 
						  @foreach ($dept as $key => $user)
						  <option value="{{$user->id}}">{{$user->name}}</option>
						  @endforeach
						</select> <span
							class="help-block m-b-none"></span>
					</div>
            </div>
			<div class="form-group sdpt hide"><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
					<div class="tree sss">

  
<!--ul class="category">
  @foreach($categories as $subCate)
    <li class="<?php if(count($subCate->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $subCate->id }}">{{ $subCate->categoryname }}</a>
	 
    <ul>
	@foreach($subCate->subCategory as $firstNestedSub)
        <li class="<?php if(count($firstNestedSub->subCategory)==0) echo'active';?>" ><a  onClick="getCategory(this)" data-id="{{ $firstNestedSub->id }}"> {{ $firstNestedSub->categoryname }}</a>
		 
		 <ul>
		@foreach($firstNestedSub->subCategory as $secondNestedSub)
		 <li  class="<?php if(count($secondNestedSub->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $secondNestedSub->id }}"> {{ $secondNestedSub->categoryname }}</a>
		 <ul>
		  @foreach($secondNestedSub->subCategory as $thirdNestedSub)
		 <li  ><a  onClick="getCategory(this)" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}</a>
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
            </div>
			<div class="form-group nodpt hide"><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
							<div class="tree ">

 <?php
 if(count($categoriesnon)>0){?>

<ul class="category">
  @foreach($categoriesnon as $subCate)
    <li class="<?php if(count($subCate->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $subCate->id }}">{{ $subCate->categoryname }}</a>
	 
    <ul>
	@foreach($subCate->subCategory as $firstNestedSub)
        <li class="<?php if(count($firstNestedSub->subCategory)==0) echo'active';?>" ><a  onClick="getCategory(this)" data-id="{{ $firstNestedSub->id }}"> {{ $firstNestedSub->categoryname }}</a>
		 
		 <ul>
		@foreach($firstNestedSub->subCategory as $secondNestedSub)
		 <li  class="<?php if(count($secondNestedSub->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $secondNestedSub->id }}"> {{ $secondNestedSub->categoryname }}3</a>
		 <ul>
		  @foreach($secondNestedSub->subCategory as $thirdNestedSub)
		 <li  ><a onClick="getCategory(this)" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}4</a>
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
<?php
 }else{
	 echo "No Categories Found";
 }
 ?>
</div>			
					</div>
            </div><div class="form-group" style="text-align:center"><label class="col-lg-2 control-label" ></label><div class="col-lg-2"><input type="text" id="category" name="category_id" required style='display:none'></div></div>
                <div class="form-group"><label class="col-lg-2 control-label" >Price</label>

                    <div class="col-lg-8">
                        {!! Form::text('price', null, array('placeholder' => '50.01','class' => 'form-control','required' => '' , 'data-parsley-type' => 'number','data-parsley-trigger' => 'keyup',"min"=>"50.01" ,'data-parsley-pattern'=>"^\d{0,6}(\.\d{1,2})?$")) !!}

                    </div>
                </div> <div class="form-group"><label class="col-lg-2 control-label" >Quantity</label>
  

                    <div class="col-lg-8">
                        {!! Form::text('quantity', null, array('placeholder' => 'Quantity','class' => 'form-control','required' => '','data-parsley-type' => 'digits','data-parsley-trigger' => 'keyup','maxlength'=>"11")) !!}

                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Description</label>

                    <div class="col-lg-8">  
                        <textarea cols="25" class="form-control" rows="4" name="description" data-parsley-trigger="keyup"  data-parsley-maxlength="200" required></textarea><span
                            class="help-block m-b-none">
                    </div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Image</label>

                    <div class="col-lg-4">  
                        <input type="file" name="image" accept="image/*"><span
                            class="help-block m-b-none"></span>

                    </div>
                    <div class="col-lg-4">  
                        <div class="imageshow"></div>

                    </div>
                </div>


                

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-8">
                        <button type="submit" class="btn btn-primary" onClick="AddProduct()">Submit</button>

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
                <h4 class="modal-title" id="H3">Confirmation</h4>
            </div>
            <div class="modal-body">
                Categories can be added upto level 4
            </div>
            <div class="deletesucess" style="width:50%;margin-left:10px;text-align:center"></div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
               
            </div>
        </div>
    </div>
</div>

@endsection