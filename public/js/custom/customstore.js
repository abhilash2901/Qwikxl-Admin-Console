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
App.filter('dateRange', function() {
     return function(records, dateKey, from, to) {
       return records.filter(function(record) {
         return !moment(record[dateKey], 'd-MMM-yyyy').isBefore(moment(from))
                && !moment(record[dateKey], 'd-MMM-yyyy').isAfter(moment(to));
            });
        }
    });
App.filter('selectedTags', function() {
    return function(listcategory, tags) {
        return listcategory.filter(function(task) {
            if(tags !=''){
            for (var i in task.type) {
                if (tags.indexOf(task.type[i]) != -1) {
                    return true;
                }
            }
            return false;
			}else{
				return listcategory;
			}

        });
		return true;
		
    };
});
 App.controller('store', function ($scope,$rootScope,$http,$timeout,WebService,$filter) {
	 
	  setTimeout(function() {
                     $("#alls").val('all').trigger("change");
                 }, 500); setTimeout(function() {
                     $("#status").val('0').trigger("change");
                 }, 500);
	 $scope.storeusersid=function(id){
		 
		 $scope.storeuserid=id;
	    }; 
		 $scope.tags = [];
	 $scope.selectetype= function(type){
		// alert(type);
		$scope.tags = [];
		 if(type !='all'){
			 if(type==1){
				 $("#dpt").click();
			 }else{
				 $("#general").click();
			 }
		 var i = $.inArray(type,  $scope.tags);
		
        if (i < -1) {
             $scope.tags.splice(i, 1);
			
        } else {
            
			$scope.tags.push(type);
		}
		console.log($scope.tags)
		 }
	   };
		 $scope.liststoreuser= function(){
		
		 post_data  ='';
		    link="/liststoreuser";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.detailsstores = response.users;
				$scope.detailsusers = response.storeuser;
				console.log( $scope.detailsstores);
				var s =response.users;
				//alert(s.logo);
				if(s.logo){
				 $(".imageshows").html('<img src=' + base_url + '/' + s.logo + ' width="50%" height="100px">');
			 }
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
		$scope.listingOrder= function(){
			 post_data  ={};
		    link="/getOrders";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.getOrders=response.orders;
				//console.log($scope.getOrders);
				$scope.getstatus=response.statuss;
			});
		 };
		 $scope.customerList= function(){
			 post_data  ={};
		    link="/customerlist";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.customerlist=response;
			});
		 };
		 $scope.clear=false;
		 $scope.Clear= function(){
			 $scope.clear=true;
			 if($scope.clear == true){
			     $scope.orderid='';
				 $scope.unique='';
				 $scope.status='0';
				 $scope.statust='0'; 
				 $scope.from=''; $scope.to='';
				 
			   }
			
		 };
		 $scope.Getsingleorder= function(id){
			 
			 post_data  ={'id':id};
		    link="/getsingleorder";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.getsingleorder=response.single;
				$scope.getitemlist=response.itemlist;
				$scope.statuss=response.statuss;
				$scope.total=response.total;
			});
		 };
		  $scope.Editcustm= function(){
			  
			   if ($('#custm').parsley().validate()) {
        var form = $('#custm').serializeArray();
        jQuery.ajax({
            type: 'POST',
            url: base_url + '/customupdate',

            dataType: 'json',
            data: form,
            success: function(res) {
                $(".custm").show();
               
               
                    $('html, body').animate({
                        scrollTop: $(".custm").offset().top - 100
                    }, 'fast');
                    $(".custm").html('<p class="' + res.class + '">' + res.msg + '</p>');
					setTimeout(function() {
                     $(".custm").hide();
                    // location.reload();
                 }, 2000);

                post_data  ={'id': res.id};
		    link="/getsingleorder";
		
	
			var promise = WebService.send_data( link,post_data);
			promise.then(function(response){  
			    $scope.getsingleorder=response.single;
				$scope.getitemlist=response.itemlist;
			});

            }
        });
    }
	 
			  
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
		 
		 $scope.Changedate= function(){
			 
			 
			 //$scope.dates=$scope.date;
			$scope.dates=$filter('date')(new Date($scope.date), "d-MMM-yyyy");
			 console.log($scope.dates);
		 };
		 $scope.to=''; $scope.from='';
		$scope.dateRangeFilter = function (property, startDate, endDate) {
			//alert(startDate);
			if(startDate){
    return function (item) {
        if (item[property] === null) return false;
 
        var itemDate = item[property];
        var s =$filter('date')(new Date(startDate), "dd-MMM-yyyy");
        var e =$filter('date')(new Date(endDate), "dd-MMM-yyyy");
       //console.log(s );
	   //console.log(e );
        if (itemDate >= s && itemDate <= e ) return true;
        return false;
    }
			}
};
	});

