app.controller('invoicesController', function($scope, $http, API_URL) {
    //retrieve employees listing from API
    $http.get(API_URL + "invoices")
        .success(function (response) {
            //alert(response.toSource());
            $scope.invoices = response;
        });
});