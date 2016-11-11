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
		
		 $scope.listbanner= function(id){
			
			 post_data  ={"id":id};
		    link="/listbanner";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listbanner=response;
			});
		 };
		 $scope.AddBanner= function(){
			
			 if ($('#addbanner').parsley().validate()) {
		 

         $('#addbanner').ajaxForm(function(options) {
             var items = JSON.parse(options);
			 ids=items.id;
			
              var s = items.msg;
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucess").show();
             $(".uploadsucess").html('<p class="alert alert-success">' + s + '</p>');
			 
             
             setTimeout(function() {
                 $(".uploadsucess").hide(); $('#addbanner')[0].reset();
             }, 2000);
            post_data  ={"id":ids};
		    link="/listbanner";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listbanner=response;
			});
         });
		  
     }
		 };
		 
		 
		
  $scope.bannerCreated= function(){
    if ($('#editbanner').parsley().validate()) {
   

         $('#editbanner').ajaxForm(function(options) {
             var items = JSON.parse(options);
              var s = items.msg;
			  ids=items.id;
             $('html, body').animate({
                 scrollTop: $(".uploadsucess").offset().top - 100
             }, 'fast');
             $(".uploadsucesss").show();
             $(".uploadsucesss").html('<p class="alert alert-success">' + s + '</p>');

             setTimeout(function() {
                 $(".uploadsucesss").hide(); 
             }, 2000);
			 post_data  ={"id":ids};
		    link="/listbanner";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listbanner=response;
			});

         });
	}
 } ;
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		
	});

