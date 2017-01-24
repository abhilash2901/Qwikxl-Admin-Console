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
		  $scope.isDisabled=true;
           $(".disables").attr("disabled","disabled");
         $('#addbanner').ajaxForm(function(options) {
			 $scope.isDisabled=false;
             var items = JSON.parse(options);
			 ids=items.id;
			  $(".disables").prop("disabled", false);
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
		 
		 
		 $scope.Adddpt= function(){
			
			 if ($('#adddpts').parsley().validate()) {
		 

         $('#adddpts').ajaxForm(function(options) {
             var items = JSON.parse(options);
			
			
              var s = items.msg;
             $('html, body').animate({
                 scrollTop: $(".adddpts").offset().top - 100
             }, 'fast');
             $(".adddpts").show();
             $(".adddpts").html('<p class="' +items.class + '">' + s + '</p>');
			 
             if(items.status=='success'){
				  ids=items.storeid;
             setTimeout(function() {
                 $(".adddpts").hide(); $('#addbanner')[0].reset();
             }, 2000);
            post_data  ={"store_id":ids};
		    link="/listdepartments";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listdepartments=response;
			});
			 }
         });
		  
     }
		 };
		  $scope.listdepartments= function(id){
			   
			 post_data  ={"store_id":id};
		    link="/listdepartments";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listdepartments=response;
			});
		 };
		 $scope.listUsers= function(){
			   
			 post_data  ={};
		    link="/listingusersadmin";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listingusers=response;
			});
		 };
		 $scope.listRoles= function(){
			   
			 post_data  ={};
		    link="/listingroles";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.listingroles=response;
			});
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

