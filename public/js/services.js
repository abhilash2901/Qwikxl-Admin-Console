function AuthService($http, $q, $cookies){
    return {
        isAuthenticated : function(){
            if($cookies.get('user_id')===undefined)
               return false;
            else
                return true;
        },
        isManager : function(){
            if($cookies.get('user_type')=="Manager")
                return true;
            else 
                return false;
        }
    }
}

function authentication($rootScope, $state, AuthService,$q, $cookies){
    $rootScope.$on("$stateChangeStart", function(event, toState, toParams, fromState, fromParams){
        if ((toState.data.requireLogin === undefined || toState.data.requireLogin === true)&& !AuthService.isAuthenticated()){
            $state.transitionTo("login");
            event.preventDefault(); 
        }
        else{
            //for every other statechange update the expiry time of the cookies set....
            var user_type = $cookies.get('user_type');
            var user_id   = $cookies.get('user_id');
            var time = new Date();
            $cookies.put('user_type',user_type,time+1200);
            $cookies.put('user_id',user_id,time+1200);
        }
        if (toState.data.requireLogin === false&& AuthService.isAuthenticated()){
            //After logged in login page should be inaccessible
            $state.transitionTo("orders.new_orders");
            event.preventDefault(); 
        }

        if(toState.data.managerPrivilage===true && !AuthService.isManager()){
            $state.transitionTo("orders.new_orders");
            event.preventDefault(); 
        }
    });
}
function fileUpload($http){
    this.uploadFileToUrl = function(file, uploadUrl){
        var fd = new FormData();console.log(file);
        fd.append('logo', file);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(){
        })
        .error(function(){
        });
    }
}
angular
    .module('inspinia')
    .factory('AuthService', AuthService)
    .service('fileUpload', fileUpload)
    .run(authentication);
