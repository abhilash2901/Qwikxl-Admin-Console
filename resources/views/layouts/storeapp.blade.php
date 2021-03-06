<!DOCTYPE html>
<html>
   <head>
      <?php echo
         header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
         header("Cache-Control: post-check=0, pre-check=0", false);
         header("Pragma: no-cache");
         header('Content-Type: text/html');
             ?>
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
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
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
      <link href="{{ asset('css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
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
      <link id="loadBefore" href="{{ asset('css/style.css')}}" rel="stylesheet">
      <link href="{{ asset('css/plugins/datapicker/bootstrap-datepicker.css')}}" rel="stylesheet">
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
      <div id="wrapper" class="ng-scope">
         <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="slimScrollDiv">
               <div class="sidebar-collapse">
                  <ul side-navigation class="nav metismenu sidebar-menu" id="side-menu">
                  <li class="nav-header">
                     <div class="profile-element" uib-dropdown><a href="{{ url('storeprofile')}}">
                        <img alt="image" class="img-circle" src="{{ asset('img/profile_small.jpg')}}" />
                        <a  href="{{ url('storeprofile')}}">
                        <span class="clear">
                        <span class="block m-t-xs" align="center" style="text-align:center">
                        <strong class="font-bold"> {{ Auth::user()->firstname }} </strong>
                        </span></a>  <a  >
                        <span class=" block m-t-xs" align="center">{{Session::get('storename')}} & {{Session::get('storeuniqid')}} </span>
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
                  <li ng-class="{active: $state.includes('pages')}"  class="treeview">
                     <a ui-sref="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                     <span class="nav-label">ORDERS</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse treeview-menu" >
                        @permission('order-list')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('listOrders')}}">Orders</a></li>
                        @endpermission
                        @permission('new-order-list')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('neworders')}}">New orders</a></li>
                        @endpermission
                        @permission('assigned-orders') 
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('assignedorders')}}">Assigned orders</a></li>
                        @endpermission 
                        @permission('complete-orders')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('completeorders')}}">Completed orders</a></li>
                        @endpermission 
                        @permission('fulfillment-center')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('fullfillmentorders')}}">Fulfillment Center</a></li>
                        @endpermission
                     </ul>
                  </li>
                  <li ng-class="{active: $state.includes('pages')}" class="treeview">
                     <a ui-sref="#"><i class="fa fa-sliders"></i> <span class="nav-label">MANAGE STORE</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse treeview-menu">
                        @permission('editstore-details')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('storelistss')}}">Store Settings</a></li>
                        @endpermission @permission('store-profile')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('storeprofile')}}">Profile</a></li>
                        @endpermission 
                     </ul>
                  </li>
                  <li ng-class="{active: $state.includes('pages')}"  class="treeview">
                     <a ui-sref="#"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">INVENTORY</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse treeview-menu" >
                        @permission('list-product')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('listproduct')}}">Store Inventory</a></li>
                        @endpermission 
                        @permission('add-product')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('addproduct')}}">Add Inventory </a></li>
                        @endpermission 
                        @permission('list-category')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('categorylist')}}">Categories</a></li>
                        @endpermission
                        @permission('add-category')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('categorys')}}">Add Categories</a></li>
                        @endpermission 
                        @permission('import')
                        <li ui-sref-active="active" ng-class="{in: $state.includes('pages')}"><a href="{{ url('import')}}">Import Inventory </a></li>
                        @endpermission 
                     </ul>
                  </li>
               </div>
            </div>
         </nav>
      </div>
      @endif
      <div id="page-wrapper" class="<?php echo $class;?> orders.new_orders" style="min-height: 634px;<?php echo $s; ?>">
         @if (Auth::guest()) @else
         <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
               <div class="navbar-header">
                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
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
      <script src="{!! asset('js/moment.js') !!}"></script>
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
      <script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
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
      <script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
      <script src="{!! asset('js/plugins/footable/footable.all.min.js') !!}"></script>
      <script src="{!! asset('js/plugins/footable/angular-footable.js') !!}"></script>
      <script>
         $(document).ready(function(){
            $('.footable').footable();
                   $('.footable2').footable();
         // $('#datetimepicker').datetimepicker('setStartDate', '2012-01-01');
             $('.date').datepicker({
           dateFormat: 'dd-MMM-yyyy' ,
             minDate: moment()
          });
          $(".date").on('change',function(e){
         //alert($(this).val());
         $('#datess').datepicker({
             
                startDate:  new Date($(".fromdate").val()),
          dateFormat: 'dd-MMM-yyyy' 
          
            //this option for allowing user to select from year range
               }); 
         });
         $('.clockpicker').clockpicker();
         });
      </script>
   </body>
</html>

