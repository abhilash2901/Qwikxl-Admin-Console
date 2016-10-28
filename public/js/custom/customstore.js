var App = angular.module('apps',  ['angularUtils.directives.dirPagination']);
App.filter('startsWithLetter', function () {
  return function (items, letter) {
    var filtered = [];
    var letterMatch = new RegExp(letter, 'i');
    for (var i = 0; i < items.length; i++) {
      var item = items[i];
      if (letterMatch.test(item.name.substring(0, 1))) {
        filtered.push(item);
      }
    }
    return filtered;
  };
});

 App.controller('store', function ($scope,$rootScope,$http,$timeout,WebService,$filter) {
	 
	 $scope.storeusersid=function(id){
		 
		 $scope.storeuserid=id;
	    }; 
	 $scope.liststoreuser= function(){
		
		 post_data  ='';
		    link="/liststoreuser";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.detailsstores = response.users;
				$scope.detailsusers = response.storeuser;
				console.log( $scope.detailsstores);
				$(".country").val($scope.detailsstores.country).trigger("change");
				
				setTimeout(function() {
                   $(".state").val($scope.detailsstores.state).trigger("change");
					
                }, 500);
				setTimeout(function() {
                    $(".city").val($scope.detailsstores.city).trigger("change");

					
                }, 1000);
			});	
		 
	      
		};
		$scope.listproducts= function(){
		
		 post_data  ='';
		    link="/listingproducts";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listproducts = response;
				
				
			});	
		 
	      
		};
		$scope.listcategory= function(){
		
		 post_data  ='';
		    link="/listingcategory";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listcategory = response;
				
				
			});	
		 
	      
		};
		
 		 
	});

