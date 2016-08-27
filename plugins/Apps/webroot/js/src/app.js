var app = angular.module('Application', ['ngResource', 'textAngular', 'ngFileUpload', 'color.picker', 'ngFlash', 'toastr']);

app.constant('BASE_URL', localStorage.getItem('BASE_URL'));

app.config(function($provide) {
    $provide.decorator('ColorPickerOptions', function($delegate) {
        var options = angular.copy($delegate);
        options.alpha = false;
        options.format = 'hex';
        options.placeholder = 'Label color';
        return options;
    });
});

app.controller('MainsCtrl', function($scope, LabelResources, BASE_URL){
    $scope.BASE_URL = BASE_URL;
/*    // Getting all active labels.
    $scope.fetchLabelsLists = function(){
        $scope.labels = [];
        var labels = LabelResources.query().$promise;
        labels.then(function (res) {
            $scope.labels = res.labels
        });
    };

    $scope.fetchLabelsLists();*/
});