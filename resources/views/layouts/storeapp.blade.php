<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token()}}" />
    <!-- Page title set in pageTitle directive -->
    <title>Qwikxl</title>
    <!-- jQuery and Bootstrap -->
    <script src="{!! asset('js/jquery/jquery-2.1.1.min.js') !!}"></script>
    <script src="{!! asset('js/plugins/jquery-ui/jquery-ui.js') !!}"></script>
    <script src="{!! asset('js/parsley.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap/bootstrap.min.js') !!}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        var base_url = "<?php echo URL::to('/'); ?>";
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>

    <script src="{!! asset('js/select2.js') !!}"></script>


    <!-- Bootstrap -->
	
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-confirm-delete.css')}}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">
    <!-- Font awesome -->
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <!-- footable -->
    <link href="{{ asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/parsley.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/jquery.ezdz.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{!! asset('js/parsley.min.js') !!}"></script>
    <script>
        var base_url = "<?php echo URL::to('/'); ?>";
    </script>
    <!-- Main Inspinia CSS files -->

    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/datepick.css')}}" rel="stylesheet">

    <link id="loadBefore" href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>

<!-- ControllerAs syntax -->
<!-- Main controller with serveral data used in Inspinia theme on diferent view -->

<body id="page-top" class=" <?php
    if (Auth::guest())
        echo " pace-done gray-black scroller ";
    else
        echo "pace-done ";

?>">


    @if (Auth::guest())

    <?php $s='margin: 0 0 0 47px;' ; $class="gray-black" ; ?> @else
    <?php $s='0' ; $class="gray-bg" ; ?>

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul side-navigation class="nav metismenu sidebar-menu" id="side-menu">
                <li class="nav-header">

                    <div class="profile-element" uib-dropdown>
                        <img alt="image" class="img-circle" src="{{ asset('img/profile_small.jpg')}}" />
                        <a uib-dropdown-toggle href>
                            <span class="clear">
                                    <span class="block m-t-xs" align="center">
                                        <strong class="font-bold"> {{ Auth::user()->firstname }} {{ Auth::user()->firstname }}</strong>
                                    </span>
                            <span class=" block m-t-xs" align="center">profile</span>
                            </span>
                        </a>

                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>





                <!--<li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('/storeprofile ')}}"><i class="	glyphicon glyphicon-user"></i><span class="nav-label ng-binding">PROFILE</span></a>

                </li>



                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('storelistss')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Store Settings</span></a>

                </li>
                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('category')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Category Settings</span></a>

                </li>
                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('categorylist')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Category list</span></a>

                </li>

                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('listproduct')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Product List</span></a>

                </li>-->

                 <li ng-class="{active: $state.includes('pages')}" class="treeview">
                    <a ui-sref="#"><i class="fa fa-th-large"></i> <span class="nav-label">STORE SETTINGS</span><span class="fa arrow"></span></a>
                    
					 <ul class="nav nav-second-level collapse treeview-menu">
                        @permission('editstore-details')
                        <li ng-class="{active: $state.includes('mailbox')}">
                         <a href="{{ url('storelistss')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Store</span></a>

                      </li>
                        @endpermission @permission('store-profile')
                        <li ng-class="{active: $state.includes('mailbox')}">
                         <a href="{{ url('storeprofile')}}"><i class="glyphicon glyphicon-user"></i><span class="nav-label ng-binding">Profile</span></a>

                       </li>
                        @endpermission 
                    </ul>
                </li>
				<li ng-class="{active: $state.includes('pages')}"  class="treeview">
                    <a ui-sref="#"><i class="fa fa-th-large"></i> <span class="nav-label">CATALOG</span><span class="fa arrow"></span></a>
                   <ul class="nav nav-second-level collapse treeview-menu" >
					 @permission('list-category')
                        <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('categorylist')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Categories </span></a>

                </li>
                 @endpermission
				 @permission('add-category')
                        <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('category')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Add Category </span></a>

                </li>
                 @endpermission @permission('list-product')
                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('listproduct')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Inventory </span></a>

                </li> @endpermission 
				@permission('add-product')
                <li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('addproduct')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Add Inventory </span></a>

                </li> @endpermission 
				<li ng-class="{active: $state.includes('mailbox')}">
                    <a href="{{ url('import')}}"><i class="fa fa-cog"></i><span class="nav-label ng-binding">Import </span></a>

                </li> 
                    </ul>
                </li>
        </div>
    </nav>
    @endif


    <div id="page-wrapper" class="<?php echo $class;?> orders.new_orders" style="min-height: 634px;<?php echo $s; ?>">

        @if (Auth::guest()) @else
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li uib-dropdown>
                        <a class="count-info" href uib-dropdown-toggle>
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-messages" uib-dropdown-menu style="display:none">
                            <li>
                                <div class="dropdown-messages-box" style="display:none">


                                    <div>
                                        <small class="pull-right">3 min ago</small>
                                        <strong>2033510023</strong> outside blue car.
                                        <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box" style="display:none">


                                    <div>
                                        <small class="pull-right text-navy">2min ago</small>
                                        <strong>4702210093</strong> Im outside red car.
                                        <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box" style="display:none">


                                    <div>
                                        <small class="pull-right">1min ago</small>
                                        <strong>4043376994</strong> Im outside.
                                        <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a ui-sref="mailbox.inbox">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li uib-dropdown>
                        <a class="count-info" href uib-dropdown-toggle>
                            <i class="fa fa-bell"></i> <span class="label label-danger">8</span>
                        </a>
                        <ul class="dropdown-alerts" uib-dropdown-menu style="display:none">
                            <li>
                                <a ui-sref="commerce.orders">
                                    <div>
                                        <i class="fa fa-cart-plus fa-fw"></i> You have 4 new orders
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider" style="display:none"></li>
                            <li>
                                <a ui-sref="commerce.completed_orders">
                                    <div>
                                        <i class="fa fa-gift fa-fw"></i> 3 Completed Orders
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>


                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a ui-sref="miscellaneous.notify">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li ng-controller="topNavCtrl">
                        <a href="{{ url('/logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>

                </ul>

            </nav>
        </div>
        @endif
        <!-- Main view  -->
        @yield('content')
    </div>



     <script src="{!! asset('js/angular/angular.js') !!}"></script>
    <script src="{!! asset('js/dirPagination.js') !!}"></script>
    <script src="{!! asset('js/custom/customstore.js') !!}"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{!! asset('js/customstore.js') !!}"></script>
    <script src="{!! asset('js/jquery.ezdz.min.js') !!}"></script>  
	<script src="{!! asset('js/customstates.js') !!}"></script> 


    <script src="{!! asset('js/custom/service.js') !!}"></script>
    <script src="{!! asset('js/angular-translate/angular-translate.min.js') !!}"></script>


    <!-- MetsiMenu -->
    <script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>

    <!-- SlimScroll -->
    <script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

    <!-- Peace JS -->
    <script src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{!! asset('js/inspinia.js') !!}"></script>

    <!-- Main Angular scripts-->
    <script src="{!! asset('js/angular/angular.min.js') !!}"></script>
    <script src="{!! asset('js/angular/angular-sanitize.js') !!}"></script>
    <script src="{!! asset('js/plugins/oclazyload/dist/ocLazyLoad.min.js') !!}"></script>
    <script src="{!! asset('js/angular-translate/angular-translate.min.js') !!}"></script>
    <script src="{!! asset('js/ui-router/angular-ui-router.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap/ui-bootstrap-tpls-1.1.2.min.js') !!}"></script>
    <script src="{!! asset('js/plugins/angular-idle/angular-idle.js') !!}"></script>
    <script src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('js/config.js') !!}"></script>
    <script src="{!! asset('js/translations.js') !!}"></script>
    <script src="{!! asset('js/directives.js') !!}"></script>
    <script src="{!! asset('js/controllers.js') !!}"></script>

</body>

</html>