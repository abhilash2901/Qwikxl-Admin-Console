@extends('layouts.storeapp')
 
@section('content')
	<script>
	$(document).ready(function() {
	   $('[type="file"]').ezdz({
            text: 'Drop files here. (Drag and drop csv and excel stock files here.)',
			reject: function(file, errors) {
                if (errors.mimeType) {
                    alert(file.name + ' must be an csv or xls.');
                }

                
            }
        });
	});
	</script>
<div class="row wrapper border-bottom white-bg page-heading">
 <div class="col-lg-10">
  <h2>Add Inventory</h2>
  <ol class="breadcrumb">
   <li>
    <a ui-sref="orders.new_orders">Home</a>
   </li>
   <li>
    Inventory
   </li>
   <li class="active">
    <strong>Add inventory</strong>
   </li>
  </ol>
 </div>
 <div class="col-lg-2">
 </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
 <div class="row">
  <div class="col-lg-12">
   <div class="ibox float-e-margins">
    <div class="ibox-title">
     <h5>File Upload</h5>
                       <br>
    <div style="text-align:right;"><a href="{{ url('download/product.csv') }}" style=" padding: 10px;"><span class="glyphicon glyphicon-arrow-down"></span> CSV</a><a href="{{ url('download/product.xls') }}" style=" padding: 10px;"><span class="glyphicon glyphicon-arrow-down"></span> XLS</a><a style=" padding: 10px;" href="{{ url('download/product.xlsx') }}"><span class="glyphicon glyphicon-arrow-down"></span> XLSX</a></div>
    </div>
    <div class="ibox-content">
	<div class="uploadsucess" tabindex="1"></div>
	<form id="form" method="POST" class="form-horizontal  topspace"  action="{{ url('dumpproduct')}}">
	<div class="" style="margin-left: 278px;">
	 <div class="form-group"><label class="col-lg-2 control-label" style="padding-top: 0px;">Type</label>
<input type="hidden" id="category" name="category_id">
		                         <input type="hidden"  name="store_id" value="">
									<div class="col-lg-8">  
										<input type="radio" value="0" name="type"  onchange="Getdpttype(this);" required > General 
										<input type="radio" value="1" name="type"  onchange="Getdpttype(this);"> Departments
										<span
											class="help-block m-b-none"></span>
									</div>
                                </div>
								<div class="form-group dpts hide "><label class="col-lg-2 control-label">Departments</label>

									<div class="col-lg-8">  
										<select class="form-control m-b type " id="departments_id" name="department_id" required onchange="departmnt(this)">


										</select> <span
											class="help-block m-b-none"></span>
									</div>
								</div>
								<div class="form-group sdpt "><label class="col-lg-2 control-label" style="padding-top: 0px;">Category</label>

									<div class="col-lg-8">  
												<div class="tree sss tree-no-margin-top">

 <input type='checkbox' value='0'  onClick='getCategory(this)' data-id='0' > Base Category

<!--ul class="category">
  @foreach($categories as $subCate)
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
   
    
</ul-->
</div>		
                                        										

									</div>
								</div><div class="form-group nodpt hide"><label class="col-lg-2 control-label" style="padding-top: 0px;">Category</label>

									<div class="col-lg-8">  
												<div class="tree tree-no-margin-top">

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
<?php
 }else{
	 echo "No Categories Found";
 }
 ?>
</div>			
									</div>
								</div>
								
                               {{ csrf_field() }}
                       </div>       
	
     <div class="text-left"> <a ui-sref="inventory.inventory_product_detail">
       
	   <!--button class="btn-warning btn btn-md"><i class="fa fa-upload"></i> Upload file</button--></a></div>
        
	   
	  
     <div class="dz-message m-t-lg m-b-lg ">
	   <input type="file" name="import_file" id="drag_file" required accept=".ods,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
      
      </div>
    
     <div class="m text-center topspace">
      
      <a ui-sref="inventory.inventory_product_detail"> <input type="submit" class="btn-primary btn btn-lg saveimport" onClick="SaveImport()" value="Save" ></a>
      </form>
	  						<div>   
    
</div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
	
	<a class="popup hide" id="popup" data-toggle="modal" data-target="#SelectModal" >b</a>
	<div class="modal fade" id="SelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Select  </h5>


                        </div>
                        <div class="ibox-content">
                            <div class="usersucess"></div>
                            <form class="form-horizontal create_product" >
                                 
                                <div class="form-group"><label class="col-lg-2 control-label">Type</label>

									<div class="col-lg-8">  
										<input type="radio" value="0" name="type"  onchange="Getdpttype(this);" required> General 
										<input type="radio" value="1" name="type"  onchange="Getdpttype(this);"> Departments
										<span
											class="help-block m-b-none"></span>
									</div>
                                </div>
								<div class="form-group dpts hide "><label class="col-lg-2 control-label">Departments</label>

									<div class="col-lg-8">  
										<select class="form-control m-b type " id="departments_id" name="department_id" required >


										</select> <span
											class="help-block m-b-none"></span>
									</div>
								</div>
								<div class="form-group sdpt hide"><label class="col-lg-2 control-label">Category</label>

									<div class="col-lg-8">  
										<div class="tree ">


											<ul class="category">
												@foreach ($categories as $category)
												<li><a  onClick="getCategory(this)" data-id="{{ $category->id }}">{{ $category->categoryname }}</a>

													<ul>
														@foreach ($category->children as $children)
														<li  ><a  onClick="getCategory(this)" data-id="{{ $children->id }}"> {{ $children->categoryname }}</a></li>

														@endforeach
													</ul>
												</li>
												@endforeach

												</li>
											</ul>
										</div>		

									</div>
								</div><div class="form-group nodpt hide"><label class="col-lg-2 control-label">Category</label>

									<div class="col-lg-8">  
										<div class="tree ">


											<ul class="category">

												@foreach ($categoriesnon as $category)
												<li><a  onClick="getCategory(this)" data-id="{{ $category->id }}">{{ $category->categoryname }}</a>

													<ul>
														@foreach ($category->children as $children)
														<li  ><a  onClick="getCategory(this)" data-id="{{ $children->id }}"> {{ $children->categoryname }}</a></li>

														@endforeach
													</ul>
												</li>
												@endforeach


											</ul>
										</div>			
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