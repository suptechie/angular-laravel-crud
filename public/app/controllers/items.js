app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('itemsController', function ($scope, $http, API_URL) {

    //fetch items listing from 
    $http({
        method: 'GET',
        url: API_URL + "items"
    }).then(function (response) {
        $scope.items = response.data.items;
        console.log(response);
    }, function (error) {
        console.log(error);
        alert('This is embarassing. An error has occurred. Please check the log for details');
    });
    
});