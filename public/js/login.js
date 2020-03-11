var app = angular.module('app', []);

app.controller('LoginController', ['$scope', '$http', function($scope, $http) {

    var self = this;

    self.data = {
        email: null,
        password: null
    }

    self.message = "";

    self.tryLogin = function(){
        self.message = "";

        $http({
            url: '/login',
            data : self.data,
            method : 'POST',
        }).then(function (response) {
            var response = response.data;

            if (!response.is_valid){
                self.message = "Incorrect username or password";
            } else {
                window.location.replace("/login");
            }
        }, function (response) {
            self.message = "An unexpected error has occurred";
        });
    }

}]);