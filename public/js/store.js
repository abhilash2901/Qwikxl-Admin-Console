function storeCtrl($scope, $http, $state){
	$scope.users = [];
	$scope.getEveryOne = function(){
        $http({
            method: 'GET',
            url: '/api/v1/storeusers',
        }).then(function successCallback(response) {
        	$scope.users = response.data;
        });
    }
    $scope.getEveryOne();
    $scope.deleteUser = function(id) {
    	console.log("deleting:");
    	console.log(id);
    	$http({
            method: 'GET',
            url: '/api/v1/user/delete/'+id,
        }).then(function successCallback(response) {
        	window.location.reload(); 
        });
    }
}
function storeAssignCtrl($scope, $http){
    $scope.users = [];
    $scope.getUsers = function(){
        $http({
            method: 'GET',
            url: '/api/v1/users',
        }).then(function successCallback(response) {
            $scope.users = response.data;
        });
    }
    $scope.getUsers();
}

function newUserCtrl($scope, $http, $state) {
	$scope.createUser = function(){
        console.log($scope.userData);
        if($scope.userData.$valid){
    		$http({
        		method: 'POST',
        		url: '/api/v1/user/createuser',
        		data:$scope.newUser
        	}).then(function successCallback(response) {
        	   	$state.go('store.users');
        	});		
        }
        else if(!$scope.userData.email2.$valid){
            alert("Email ids doesnt match!")
        }
	};
}


function storeEditCtrl($scope, $state, $stateParams, $http, $q, $cookies)
{
	$scope.user = {};
	$scope.getUser = function(){
        $http({
            method: 'GET',
            url: '/api/v1/user/'+$stateParams.id
        }).then(function successCallback(response) {
        	$scope.user = response.data;
        });
        $scope.role = $cookies.get('user_type');
    };
    $scope.getUser();

    $scope.save = function(){
    	console.log('fn call recieved');
        console.log($scope.userData);
    	if($scope.userData.$valid){
            $http({
        		method: 'POST',
        		url: '/api/v1/user/update',
        		data:$scope.user
        	}).then(function successCallback(response) {
            		$state.go('store.users');
        	});
        }
        else console.log("Invalid Entry");
    }
}

function inventoryCtrl($scope, $http, $state){
	$scope.inventories = {};
	$scope.getInventories = function(){
		$http({
            method: 'GET',
            url: '/api/v1/inventories',
        }).then(function successCallback(response) {
        	$scope.inventories = response.data;
        	console.log(response.data);
        });
	};
	$scope.getInventories();
    $scope.search = function(){
        console.log('fun called');
        $http({
            method: 'POST',
            url: '/api/v1/search',
            data : $scope.searchdata,
        }).then(function successCallback(response) {
            $scope.inventories = response.data;
            console.log(response.data);
        });
    };
}

function productDetailCtrl($scope, $state, $stateParams, $http){
	$scope.inventory = {};
	$scope.getProductDetails = function(){
		$http({
            method: 'GET',
            url: '/api/v1/product/'+ $stateParams.id,
        }).then(function successCallback(response) {
        	$scope.inventory = response.data;
        	console.log(response.data);
        });
	};
	$scope.getProductDetails();
}

function newOrderCtrl($scope, $state, $http){
	$scope.newOrders = [];
	$scope.getNewOrders = function(){
		$http({
            method: 'GET',
            url: '/api/v1/new_orders/',
        }).then(function successCallback(response) {
        	$scope.newOrders = response.data;
        	console.log(response.data);
        });
	};
	$scope.getNewOrders();	
    $scope.search = function(){
        $scope.searchdata.order_status = "New Order";
        console.log($scope.searchdata);
        $http({
            method: 'POST',
            url: '/api/v1/orders/search',
            data : $scope.searchdata,
        }).then(function successCallback(response) {
            $scope.newOrders = response.data;
            console.log(response.data);
        });
    };
}


function assignedOrderCtrl($scope, $state, $http){
	$scope.searchStr='';
    $scope.assignedOrders = [];
	$scope.getAssignedOrders = function(){
		$http({
            method: 'GET',
            url: '/api/v1/assigned_orders/',
        }).then(function successCallback(response) {
        	$scope.assignedOrders = response.data;
        	console.log(response.data);
        });
	};
	$scope.getAssignedOrders();	
    $scope.search = function(){
        $scope.searchdata.order_status = "In Progress";
        console.log($scope.searchdata);
        $http({
            method: 'POST',
            url: '/api/v1/orders/search',
            data : $scope.searchdata,
        }).then(function successCallback(response) {
            $scope.assignedOrders = response.data;
            console.log(response.data);
        });
    };
}


function completedOrderCtrl($scope,$http)
{
	$scope.completedOrders = [];
	$scope.getCompletedOrders = function(){
		$http({
            method: 'GET',
            url: '/api/v1/completed_orders/',
        }).then(function successCallback(response) {
        	$scope.completedOrders = response.data;
        	console.log(response.data);
        });
	};
	$scope.getCompletedOrders();	
    $scope.search = function(){
        $scope.searchdata.order_status = "Completed";
        console.log($scope.searchdata);
        $http({
            method: 'POST',
            url: '/api/v1/orders/search',
            data : $scope.searchdata,
        }).then(function successCallback(response) {
            $scope.completedOrders = response.data;
            console.log(response.data);
        });
    };
}
function fulfillmentCtrl($scope, $stateParams, $http){
    $scope.myOrders = [];
    $scope.getMyOrders = function(){
        $http({
            method: 'GET',
            url: '/api/v1/myorders',
        }).then(function successCallback(response) {
            $scope.myOrders = response.data;
            console.log(response.data);
        });
    };
    $scope.getMyOrders();
    $scope.search = function(){
        $scope.searchdata.order_status = "all";
        console.log($scope.searchdata);
        $http({
            method: 'POST',
            url: '/api/v1/orders/search',
            data : $scope.searchdata,
        }).then(function successCallback(response) {
            $scope.myOrders = response.data;
            console.log(response.data);
        });
    }; 
}
function departmentCtrl($scope, $http) {
    $scope.departments=[];
    $http({
            method: 'GET',
            url: '/api/v1/departments',
        }).then(function successCallback(response) {
            $scope.departments = response.data;
            console.log(response.data);
        });
}
/************************************************************
	This is the one for The Cart
	**********************************************************/
function OrderDetailsCtrl($scope, $state, $stateParams, $http, $cookies){
	$scope.order = {};
	$scope.getOrderDetails = function(){
        $scope.displayNote = 0;
		$http({
            method: 'GET',
            url: '/api/v1/orders/'+ $stateParams.id,
        }).then(function successCallback(response) {
        	$scope.order = response.data;
        	console.log(response.data);
        });
        $scope.role = $cookies.get('user_type');
	};
	$scope.getOrderDetails();	
	
	$scope.assign = function(){
		console.log('assigning function called');	
		var dt = new Date();
		var month=dt.getMonth()+1;
		var str = dt.getFullYear()+'-'+month+'-'+dt.getDate();
		$scope.order.orderassignment.dateassigned = str;
		console.log($scope.status);
    	if($scope.order.orderassignment.assignedto==''){
            $scope.order.orderassignment.assignedto = $cookies.get('user_id');
        }
        $http({
    		method: 'POST',
    		url: '/api/v1/assign',
    		data:$scope.order
    	}).then(function successCallback(response) {
    		$state.go('orders.new_orders');
    	});
	};
	
	$scope.remove = function($id){   
		$http({
    		method: 'GET',
    		url: '/api/v1/remove_from_cart/'+$id,
    	}).then(function successCallback(response) {
    		console.log(response.data);
            window.location.reload(); 
    	});
	};

    $scope.saveNote = function(){
        $scope.displayNote = 0;
        $scope.order.note = $scope.order.newNote;
        $http({
            method : "POST",
            url : "/api/v1/order/updateNote",
            data : {
                note : $scope.order.newNote,
                id : $scope.order.id
            }

        }).then(function successCallback(response) {
            console.log(response.data);
            $scope.displayNote = 0;
        });
    };

    $scope.toggleNote  = function(){
        $scope.displayNote = 1;
    };
    $scope.discardNote = function(){
        $scope.displayNote = 0;
    };
    
}

function storeDataCtrl($scope, $http, $state, fileUpload, $cookies) {
	$scope.store={};
    $scope.getStoreData = function(){
        //Still Getting The Store with ID=1
        //Verify 
        $http({
            method: 'GET',
            url: '/api/v1/store_data',
        }).then(function successCallback(response) {
            $scope.store = response.data;
        });

    };
    $scope.getStoreData();
	$scope.updateStore = function(){
        if ($scope.storeDetails.$valid){
            console.log("input is proper");
            $http({
                method: 'POST',
                url: '/api/v1/store/update/',
                data:$scope.store
            }).then(function successCallback(response) {
                console.log(response.data);
                $state.go('store.users');
            });
        }
    	else{
            console.log("invalid input");
        }
    	console.log($scope.store);
	};

    $scope.uploadImage = function(){
        var file = $scope.store.logo;
        console.log(file);
        var uploadUrl = '/api/v1/stores/logo_update';
        fileUpload.uploadFileToUrl(file, uploadUrl);
        $scope.getStoreData();
    };
}
/*******************SHOW MESSAGES********************/
function showMsgCntrl($scope, $state, $http, $window){
	 $scope.page= 1;
	 $scope.take= 10;
         
	$scope.newMessages = [];
	$scope.getNewMessages = function(){
		$http({
            method: 'GET',
            url: '/api/v1/new_messages/?page=' + $scope.page + '&take=' + $scope.take,
        }).then(function successCallback(response) {
        	$scope.newMessages = response.data.data;
        	$scope.pages = Math.ceil(response.data.pages/ $scope.take);
        	$scope.totalPages = response.data.pages;
        	 //console.log( $scope.pages);
        });
	};
	$scope.getNewMessages();	
	
	$scope.nextPage = function() {
        if ($scope.page < $scope.pages) {
            $scope.page++;
            $scope.getNewMessages();
        }
    };
    
    $scope.previousPage = function() {
        if ($scope.page > 1) {
            $scope.page--;
            $scope.getNewMessages();
        }
    };
	
}
/**********Show message detail controller*******************/
function showMsgDetailCntrl($scope, $state, $stateParams, $http) {
	$scope.message={};
	$scope.newMessage={};
	$scope.getMessageDetails = function(){
		$http({
            method: 'GET',
            url: '/api/v1/messages/'+ $stateParams.id,
        }).then(function successCallback(response) {
        	$scope.message = response.data;
        	$scope.newMessage.messageTo = response.data.to;
        	$scope.newMessage.parentId = response.data.id;
        	console.log(response.data);
        });
	};
	$scope.getMessageDetails();
	
	$scope.sendReply = function(){
		console.log('fun called');
		$http({
    		method: 'POST',
    		url: '/api/v1/mailbox/createreply',
    		data:$scope.newMessage
    	}).then(function successCallback(response) {
    		console.log(response.data);
    		$state.go('mailbox.inbox');
    	});		
	};
}
/********************VERIFY*****************************/
function topNavCtrl($scope, $http,$q, $cookies, $state) {
	$scope.logout = function(){
         $http({
                method : 'GET',
                url : '/api/v1/logout',
            }).then(function successCallback(response) {
                $state.go('login');
                console.log(response.data);
                console.log($cookies.get('user_id'));
            });
    };
}

function loginCtrl($scope, $http, $state, AuthService,$q, $cookies) {
    $scope.login = function(){
        if($scope.loginForm.$valid){
            $http({
                method : 'POST',
                url : '/api/v1/validate',
                data : $scope.loginData
            }).then(function successCallback(response) {
                if($cookies.get('user_id') === undefined)
                    $scope.info = response.data;
                else
                    $state.go('orders.new_orders');
            });
        }        
    }
}
