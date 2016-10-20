var App = angular.module('app', ['angularUtils.directives.dirPagination']);
 App.controller('search', function ($scope,$rootScope,$http,$timeout,WebService,$filter) {
	 
	 
	 $scope.liststore= function(){
		
		 post_data  ='';
		    link="/liststore";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.liststores = response;
				console.log( $scope.liststores);
			});	
		 
	      
		 };

		 $scope.listcreateduser= function(id){
			 post_data  ={'id':id};
		    link="/liststoreusers";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listusers = response;
				console.log( $scope.listusers);
			});
		 };
		 $scope.Selectestore= function(id){
			 post_data  ={'id':id};
		    link="/selectstore";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    if(response.status=='success'){
					//$location.path('/storeedit');
                    window.location.replace(base_url+"/editstore");				
				}
			});
		 };
	});

