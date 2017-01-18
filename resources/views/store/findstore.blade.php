@extends('layouts.app')

@section('content')

<div ng-app="app" ng-controller="search">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Find Store</h2>

        </div>

    </div>
    <div class="row topspace">


        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Store Search </h3>
                            <div class="input-group col-md-12 ">
                                <input placeholder="Search" type="text"  class="form-control" id="search-inputs" ng-model="serach_term" autocomplete="off"/> <span
                                    class="input-group-btn" style="display:none"> <a ui-sref="search.results"><button type="button" class="btn btn-primary" >Go
                                        </button ></a> </span>
                            </div>
                            <!--h4 class="text-center">Or</h4>
                            <div class="input-group"><input type="text"  ng-model="serach_term1" placeholder="Store ID Number" id="search-input2" autocomplete="off" class="form-control"><span
                                    class="input-group-btn"> <a ui-sref="search.results"><button type="button" class="btn btn-primary">Go
                                        </button></a> </span>
                            </div-->





                        </div>
                        <div class="col-sm-6"><h4>Select Store</h4>
                            <div class="input-group col-md-12 ">
                                <input placeholder="Search" type="text"  class="form-control" id="search-input" ng-model="serach_terms" /> 						   <span
                                    class="input-group-btn" style="display:none"> <a ui-sref="search.results"><button type="button" class="btn btn-primary">Go
                                        </button></a> </span>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content ng-cloak" ng-init="liststore()">


                        <h2 class="ng-cloak">
                            @{{(liststores | filter: serach_term | filter: serach_term1 | filter:serach_terms ).length}} results found for: <span class="text-navy ng-cloak">“@{{serach_term}} @{{serach_term1}} @{{serach_terms}} ”</span>
                        </h2>
                        <!--small>Request time (0.23 seconds)</small-->

                        <div ng-show="liststores.length == 0"> No Stores</div>
                        <div ng-repeat="list in liststores | filter: serach_term | filter: serach_term1 | filter:serach_terms ">
                            <div class="hr-line-dashed"></div>
                            <div class="search-result">
                                <h3><a ng-click="Selectestore(list.id)" class="ng-cloak">@{{list.name}} | Store ID : @{{list.unique_id}} </a></h3>
                                <p class="ng-cloak">Store Coporate Number: @{{list.corporateidentifier}}</p>


                                <dl>
                                    <dt >Store Address</dt>
                                    <dd class="ng-cloak">@{{list.address}}</dd>
                                    <dt>Phone</dt>
                                    <dd class="ng-cloak">@{{list.phone}}</dd>
                                </dl>
								<a class="btn btn-white"  data-toggle="modal" data-target="#Deletestore" onclick="Takestore(this)" data-id="@{{list.id}}" >Delete </a>
                            </div>
							
                        </div>

                        <div class="hr-line-dashed"></div>
                        <!--div class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-white" type="button"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-white">1</button>
                                <button class="btn btn-white  active">2</button>
                                <button class="btn btn-white">3</button>
                                <button class="btn btn-white">4</button>
                                <button class="btn btn-white">5</button>
                                <button class="btn btn-white">6</button>
                                <button class="btn btn-white">7</button>
                                <button class="btn btn-white" type="button"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Deletestore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H3">Delete this record?</h4>
      </div>
      <div class="modal-body">
	   The store related departments,user,category,product deleted.<br>
	   This operation can't be undo.<br>
       Are you sure to delete this record?
      </div>
	  <div class="deletesucess" style="width:55%;margin-left:10px;text-align:center"></div>
      <div class="modal-footer">
	  <input type="hidden" id="get_storesid">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onClick="DeleteStore()">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection