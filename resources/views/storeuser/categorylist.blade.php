

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
<div class="row">
    <div class="col-lg-12">
	<div class="ibox">
            <div class="ibox-title">
                <h5>Category </h5>            
            </div>		
            <div class="ibox-content">
                       <a href="{{ url('category')}}" class="btn btn-primary">Add Category</a>
                <table class="footable table table-stripped toggle-arrow-tiny">
                    <thead>
                    <tr>
                        
                        <th> Name </th>
                      
						<th>Description</th>
						
						
                       
						<th class="">Action</th>
						
						
						
                    </tr>
                    </thead>
                            <tbody>
					  
                @foreach ($categories as $subCate)
                   
                    <tr>
                        <td>{{ $subCate->categoryname }}</td>
                        <td>{{ $subCate->description }}</td>
                       
                        <td>	
						@permission('edit-category')  
						<a class="btn btn-primary" href="{{ url('/editcategory/ ')}}{{$subCate->id}}">Edit</a>
						@endpermission
						@permission('delete-category')  
						<a class="btn btn-danger " onClick="TakeId(this)" data-id="{{ $subCate->id }}" data-toggle="modal" data-target="#DeleteModal">Delete</a>@endpermission</td>
						
						@foreach($subCate->subCategory as $firstNestedSub)
                            <tr>
                                <td>--{{ $firstNestedSub->categoryname }}</td>
                                <td>{{ $firstNestedSub->description }}</td>
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}{{$firstNestedSub->id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="{{ $firstNestedSub->id }}">Delete</a>
								 @endpermission
								 </td>
                                @foreach($firstNestedSub->subCategory as $secondNestedSub)
                            <tr>
                                <td>---{{ $secondNestedSub->categoryname }}</td>
                                <td>{{ $secondNestedSub->description }}</td>
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}{{$secondNestedSub->id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="{{ $secondNestedSub->id }}">Delete</a>
								 @endpermission
								 </td>
                                    @foreach($secondNestedSub->subCategory as $thirdNestedSub)
                            <tr>
                                <td>----{{ $secondNestedSub->categoryname }}</td>
                                <td>{{ $thirdNestedSub->description }}</td>
                                <td>
                                 @permission('edit-category')  								
								<a class="btn btn-primary " href="{{ url('/editcategory/ ')}}{{$thirdNestedSub->id}}">Edit</a>
								@endpermission
						        @permission('delete-category') 
								<a style="margin-left: 3px;" class="btn btn-danger" onClick="TakeId(this)"  data-toggle="modal" data-target="#DeleteModal" data-id="{{ $thirdNestedSub->id }}">Delete</a>
								 @endpermission
								 </td>
                                	
                            </tr>
                        @endforeach

								
                            </tr>
                        @endforeach	
                            </tr>
                        @endforeach
                    </tr>
					
                @endforeach
 </tbody>
	</table>
	

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








