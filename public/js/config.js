function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, IdleProvider, KeepaliveProvider) {

    // Configure Idle settings
    IdleProvider.idle(5); // in seconds
    IdleProvider.timeout(120); // in seconds

    $urlRouterProvider.otherwise("/orders/new_orders");

    $ocLazyLoadProvider.config({
        // Set to true if you want to see what and when is dynamically loaded
        debug: false
    });

    $stateProvider

      
        
        .state('mailbox', {
            abstract: true,
            url: "/mailbox",
            templateUrl: "views/common/content.html",
        })
        .state('mailbox.inbox', {
            url: "/inbox",
            templateUrl: "views/mailbox.html",
            data: { pageTitle: 'Mail Inbox' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['css/plugins/iCheck/custom.css','js/plugins/iCheck/icheck.min.js']
                        }
                    ]);
                }
            },
            controller: showMsgCntrl
        })
        .state('mailbox.email_view', {
            url: "/email_view/:id",
            templateUrl: "views/mail_detail.html",
            data: { pageTitle: 'Mail detail' },
            controller : showMsgDetailCntrl
        })
        
         .state('store', {
            abstract: true,
            url: "/store",
            templateUrl: "views/common/content.html",
        })
		.state('store.manage_store_settings', {
            url: "/manage_settings",
            templateUrl: "views/manage_store_settings.html",
            data: { pageTitle: 'Store Settings',
                    managerPrivilage: true
                 },
			resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        
                        {
                            insertBefore: '#loadBefore',
                            name: 'localytics.directives',
                            files: ['css/plugins/chosen/chosen.css','js/plugins/chosen/chosen.jquery.js','js/plugins/chosen/chosen.js']
                        },
                       
                        {
                            name: 'colorpicker.module',
                            files: ['css/plugins/colorpicker/colorpicker.css','js/plugins/colorpicker/bootstrap-colorpicker-module.js']
                        },
                        {
                            name: 'ngImgCrop',
                            files: ['js/plugins/ngImgCrop/ng-img-crop.js','css/plugins/ngImgCrop/ng-img-crop.css']
                        },
                        {
                            files: ['js/plugins/jasny/jasny-bootstrap.min.js']
                        }
                        

                    ]);
                }
            },
            controller : storeDataCtrl
			
        })
        
		.state('store.users', {
            url: '/store_users',
            templateUrl: 'views/store_users.html',
            data: { 
                pageTitle: 'Store Users',
                managerPrivilage: true 
            },
            controller: storeCtrl
        })
		.state('store.new_user', {
            url: '/create_user',
            templateUrl: 'views/store_new_user.html',
            data: { pageTitle: 'Create User',
                    managerPrivilage: true },
            controller: newUserCtrl
        })
		.state('store.edit_user', {
            url: '/edit_user/:id',
            templateUrl: 'views/store_edit_user.html',
            data: { pageTitle: 'Edit User',
                    },
            controller: storeEditCtrl
        })
		
        
		
        .state('login', {
            url: "/login",
            templateUrl: "views/login.html",
            data: { pageTitle: 'Login', 
                    specialClass: 'gray-bg', 
                    requireLogin : false
            },
            controller : loginCtrl
        })
        .state('login_two_columns', {
            url: "/login_two_columns",
            templateUrl: "views/login_two_columns.html",
            data: { pageTitle: 'Login two columns', specialClass: 'gray-bg' }
        })
        .state('register', {
            url: "/register",
            templateUrl: "views/register.html",
            data: { pageTitle: 'Register', specialClass: 'gray-bg' }
        })
        .state('lockscreen', {
            url: "/lockscreen",
            templateUrl: "views/lockscreen.html",
            data: { pageTitle: 'Lockscreen', specialClass: 'gray-bg' }
        })
        .state('forgot_password', {
            url: "/forgot_password",
            templateUrl: "views/forgot_password.html",
            data: { pageTitle: 'Forgot password', specialClass: 'gray-bg' }
        })
        .state('errorOne', {
            url: "/errorOne",
            templateUrl: "views/errorOne.html",
            data: { pageTitle: '404', specialClass: 'gray-bg' }
        })
        .state('errorTwo', {
            url: "/errorTwo",
            templateUrl: "views/errorTwo.html",
            data: { pageTitle: '500', specialClass: 'gray-bg' }
        })
       
        .state('inventory', {
            abstract: true,
            url: "/inventory",
            templateUrl: "views/common/content.html"
        })
        
        .state('inventory.inventory_list', {
            url: "/store_inventory",
            templateUrl: "views/inventory_list.html",
            data: { pageTitle: 'Store Inventory' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            serie: true,
                            files: ['js/plugins/dataTables/datatables.min.js','css/plugins/dataTables/datatables.min.css']
                        },
                        {
                            serie: true,
                            name: 'datatables',
                            files: ['js/plugins/dataTables/angular-datatables.min.js']
                        },
                        {
                            serie: true,
                            name: 'datatables.buttons',
                            files: ['js/plugins/dataTables/angular-datatables.buttons.min.js']
                        }
                    ]);
                }
            }
            ,
            //cmbck
            controller : inventoryCtrl
        })
		.state('inventory.inventory_product_detail', {
            url: "/product_detail/:id",
            templateUrl: "views/inventory_product_detail.html",
            data: { pageTitle: 'Product detail' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['css/plugins/slick/slick.css','css/plugins/slick/slick-theme.css','js/plugins/slick/slick.min.js']
                        },
                        {
                            name: 'slick',
                            files: ['js/plugins/slick/angular-slick.min.js']
                        }
                    ]);
                }
            }
            ,
            controller : productDetailCtrl
        })
		.state('inventory.iventory_upload', {
            url: "/add_inventory",
            templateUrl: "views/inventory_upload.html",
            data: { pageTitle: 'Add Inventory' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['css/plugins/dropzone/basic.css','css/plugins/dropzone/dropzone.css','js/plugins/dropzone/dropzone.js']
                        }
                    ]);
                }
            }
        })
       
        
        .state('orders', {
            abstract: true,
            url: "/orders",
            templateUrl: "views/common/content.html",
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            files: ['js/plugins/footable/footable.all.min.js', 'css/plugins/footable/footable.core.css']
                        },
                        {
                            name: 'ui.footable',
                            files: ['js/plugins/footable/angular-footable.js']
                        }
                    ]);
                }
            }
        })
        
        .state('orders.store_inventory', {
            url: "/store_inventory",
            templateUrl: "views/store_inventory.html",
            data: { pageTitle: 'Store Inventory' }
        })
        .state('orders.new_orders', {
            url: "/new_orders",
            templateUrl: "views/new_orders.html",
            data: { pageTitle: 'New orders' },
            controller : newOrderCtrl
        })
		.state('orders.order_complete', {
            url: "/order_complete",
            templateUrl: "views/order_complete.html",
            data: { pageTitle: 'Completed orders' ,managerPrivilage: true},
            controller : completedOrderCtrl
        })
		.state('orders.order_assigned', {
            url: "/order_assigned",
            templateUrl: "views/order_assigned.html",
            data: { pageTitle: 'Assigned Orders' ,managerPrivilage: true},            
            controller: assignedOrderCtrl
        })
		.state('orders.fulfillment', {
            url: "/fulfillment_center",
            templateUrl: "views/order_fulfillment.html",
            data: { pageTitle: 'Order Fulfillment' },
            controller : fulfillmentCtrl
        })
        
        .state('orders.cart', {
            url: "/cart/:id",
            templateUrl: "views/order_cart.html",
            data: { pageTitle: 'Customer Cart' },
            controller : OrderDetailsCtrl
        })
        .state('orders.fulfillment_cart', {
            url: "/fulfillment_cart/:id",
            templateUrl: "views/order_fulfillment_cart.html",
            data: { pageTitle: 'Fulfillment Cart' },
            controller : fulfillmentCartCtrl
        })
		.state('dashboards', {
            abstract: true,
            url: "/dashboards",
            templateUrl: "views/common/content.html",
        })
		.state('dashboards.dashboard_4_1', {
            url: "/dashboard_4_1",
            templateUrl: "views/dashboard_4_1.html",
            data: { pageTitle: 'Dashboard 4' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            name: 'angles',
                            files: ['js/plugins/chartJs/angles.js', 'js/plugins/chartJs/Chart.min.js']
                        },
                        {
                            name: 'angular-peity',
                            files: ['js/plugins/peity/jquery.peity.min.js', 'js/plugins/peity/angular-peity.js']
                        },
                        {
                            serie: true,
                            name: 'angular-flot',
                            files: [ 'js/plugins/flot/jquery.flot.js', 'js/plugins/flot/jquery.flot.time.js', 'js/plugins/flot/jquery.flot.tooltip.min.js', 'js/plugins/flot/jquery.flot.spline.js', 'js/plugins/flot/jquery.flot.resize.js', 'js/plugins/flot/jquery.flot.pie.js', 'js/plugins/flot/curvedLines.js', 'js/plugins/flot/angular-flot.js', ]
                        }
                    ]);
                }
            }
        })      

}
angular
    .module('inspinia')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
