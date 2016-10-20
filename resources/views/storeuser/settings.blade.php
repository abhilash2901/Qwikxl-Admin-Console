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
        	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- Angular JS -->

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

	<!-- MY App -->
  
	<script src="{{ asset('js/app/packages/dirPagination.js') }}"></script>

	<script src="{{ asset('js/app/route.js') }}"></script>

	<script src="{!!asset('js/app/services/myServices.js')!!}"></script>

	<script src="{!! asset('js/app/helper/myHelper.js')!!}"></script>

	<!-- App Controller -->

	<script src="{!! asset('js/app/controllers/storeController.js') !!}"></script>

        <!-- Main Inspinia CSS files -->
         <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">
        <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">   
        <link href="{!! asset('css/datepick.css') !!}" rel="stylesheet">
		 <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <!-- footable -->
        <link href="{{ asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet" type="text/css" />

        <link id="loadBefore" href="{!! asset('css/style.css') !!}" rel="stylesheet">
    </head>

    <!-- ControllerAs syntax -->
    <!-- Main controller with serveral data used in Inspinia theme on diferent view -->
    <body ng-app="main-App" id="page-top" class=" <?php
    if (Auth::guest())
        echo "pace-done gray-black scroller";
    else
        echo "pace-done";

?>">


        @if (Auth::guest())

<?php   $s='margin: 0 0 0 47px;';
$class ="gray-black" ;
?>
   @else
    <?php   $s='0';
$class ="gray-bg" ;
?>

          <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul side-navigation class="nav metismenu" id="side-menu">
                    <li class="nav-header">

                        <div class="profile-element" uib-dropdown>
                            <img alt="image" class="img-circle" src="{{ asset('img/profile_small.jpg')}}"/>
                            <a uib-dropdown-toggle href>
                                <span class="clear">
                                    <span class="block m-t-xs" align="center">
                                        <strong class="font-bold"> {{ Auth::user()->name }}</strong>
                                    </span>
                                    <span class=" block m-t-xs" align="center">profile</span>
                                </span>
                            </a>

                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>




            </div>
        </nav>
        @endif

        <div id="page-wrapper" class="<?php echo $class;?> orders.new_orders" style="min-height: 634px;<?php echo $s; ?>">

            @if (Auth::guest())
            @else
            <div class="row border-bottom" >
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                    </div>
                    <ul class="nav navbar-top-links navbar-right" >
                        <li uib-dropdown>
                            <a class="count-info" href uib-dropdown-toggle>
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-messages" uib-dropdown-menu style="display:none">
                                <li>
                                    <div class="dropdown-messages-box" style="display:none">


                                        <div>
                                            <small class="pull-right">3 min ago</small>
                                            <strong>2033510023</strong> outside blue car. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box" style="display:none">


                                        <div>
                                            <small class="pull-right text-navy">2min ago</small>
                                            <strong>4702210093</strong> Im outside red car. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box" style="display:none">


                                        <div>
                                            <small class="pull-right">1min ago</small>
                                            <strong>4043376994</strong> Im outside. <br>
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
                            <ul class="dropdown-alerts" uib-dropdown-menu  style="display:none">
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
           	<div class="container">

		<ng-view></ng-view>

	</div>
        </div>


   

</body>
</html>
