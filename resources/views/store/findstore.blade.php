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
                            <div class="input-group">
                                <input placeholder="Search" type="text"  class="form-control" id="search-input" ng-model="serach_term" autocomplete="off"/> 						   <span
                                    class="input-group-btn"> <a ui-sref="search.results"><button type="button" class="btn btn-primary">Go
                                        </button></a> </span>
                            </div>
                            <h4 class="text-center">Or</h4>
                            <div class="input-group"><input type="text"  ng-model="serach_term1" placeholder="Store ID Number" id="search-input2" autocomplete="off" class="form-control"> <span
                                    class="input-group-btn"> <a ui-sref="search.results"><button type="button" class="btn btn-primary">Go
                                        </button></a> </span>
                            </div>





                        </div>
                        <div class="col-sm-6"><h4>Select Store</h4>
                            <div class="input-group">
                                <input placeholder="Search" type="text"  class="form-control" id="search-input" ng-model="serach_terms" /> 						   <span
                                    class="input-group-btn"> <a ui-sref="search.results"><button type="button" class="btn btn-primary">Go
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
                            @{{liststores.length}} results found for: <span class="text-navy ng-cloak">“@{{serach_term}} @{{serach_term1}} @{{serach_terms}}”</span>
                        </h2>
                        <small>Request time (0.23 seconds)</small>

                        <div ng-show="liststores.length == 0"> No Stores</div>
                        <div ng-repeat="list in liststores| filter: serach_term | filter: serach_term1 | filter:serach_terms ">
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
@endsection