

@extends('layouts.storeapp')

@section('content')

<style type="text/css">


</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Create Category</h2>
        <ol class="breadcrumb">
            <li>
                <a ui-sref="orders.new_orders">Home</a>
            </li>
            <li class="">
                <a href="{{ url('/roles') }}"> Category</a>
            </li>
            <li class="active">
                Create Category
            </li>
        </ol>
    </div>

</div>
<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Create Category</h5>    
        </div>
		<div class="dptsucess"></div>
        <div class="ibox-content">

           
            {!! Form::open(array('class'=>'form-horizontal','method'=>'POST','id'=>'Catogoryadd')) !!}

     
            <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                <div class="col-lg-8">   {!! Form::text('categoryname', null, array('placeholder' => 'Name','class' => 'form-control','required' => '')) !!} <span
                        class="help-block m-b-none"></span>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-2 control-label">Type</label>

                <div class="col-lg-8">  
                    <input type="radio" value="0" name="type"  onchange="Getdpttype(this);" required> General 
                    <input type="radio" value="1" name="type"  onchange="Getdpttype(this);"> Departments
                    <span
                        class="help-block m-b-none"></span>
                </div>
            </div>

            <div class="form-group dpts hide"><label class="col-lg-2 control-label">Departments</label>
				
					<div class="col-lg-8">  
					   <select class="form-control m-b type " id="departments_id" name="departments_id" onchange="departmnt(this)">
						  @foreach ($dept as $key => $user)
						  <option value="{{$user->id}}">{{$user->name}}</option>
						  @endforeach
						</select> <span
							class="help-block m-b-none"></span>
					</div>
            </div><div class="form-group sdpt hide"><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
					<input type='checkbox' value='0' onClick='getCategory(this)' data-id='0' > Base Category
					<div class="tree sss">

  
<!--ul class="category">
  @foreach($allSubCategories as $subCate)
    <li class="<?php if(count($subCate->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $subCate->id }}">{{ $subCate->categoryname }}</a>
	 
    <ul>
	@foreach($subCate->subCategory as $firstNestedSub)
        <li class="<?php if(count($firstNestedSub->subCategory)==0) echo'active';?>" ><a  onClick="getCategory(this)" data-id="{{ $firstNestedSub->id }}"> {{ $firstNestedSub->categoryname }}</a>
		 
		 <ul>
		@foreach($firstNestedSub->subCategory as $secondNestedSub)
		 <li  class="<?php if(count($secondNestedSub->subCategory)==0) echo'active';?>"><a  onClick="getCategory(this)" data-id="{{ $secondNestedSub->id }}"> {{ $secondNestedSub->categoryname }}</a>
		 <ul>
		  @foreach($secondNestedSub->subCategory as $thirdNestedSub)
		 <li  ><a  data-toggle="modal" data-target="#DeleteModal" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}</a>
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
            </div><div class="form-group nodpt hide"><label class="col-lg-2 control-label">Category</label>
				
					<div class="col-lg-8">  
							<div class="tree ">

 <input type='checkbox' value='0'  onClick='getCategory(this)' data-id='0' > Base Category

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
		 <li  ><a data-toggle="modal" data-target="#DeleteModal" data-id="{{ $thirdNestedSub->id }}"> {{ $thirdNestedSub->categoryname }}4</a>
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
			<div class="form-group "><label class="col-lg-2 control-label">Description</label>
				
					<div class="col-lg-8">  
					   <textarea cols="25" class="form-control" rows="4" name="description"></textarea><span
							class="help-block m-b-none"></span>
					</div>
            </div>
				
<!--table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    {{--@foreach ($category->children as $children)--}}
                    <tr>
                        <td>-{{ $category->categoryname }}</td>
                        <td></td>
                        <td></td>
                        <td></td>@foreach ($category->children as $children)
                            <tr>
                                <td>--{{ $children->categoryname }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tr>
                </tbody>
                    {{--@endforeach--}}
                @endforeach
            </table-->
		


					
           <input type="hidden" id="category" name="parent_id">
		   <input type="hidden"  name="store_id" value="">
            

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-8">
                    <button type="button" class="btn btn-primary" onClick="Catogoryadd()">Submit</button>

                </div>
            </div>
            {!! Form::close() !!}
				

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








