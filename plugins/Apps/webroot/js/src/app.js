var app = angular.module('Application', ['ngResource', 'textAngular', 'color.picker', 'ngFlash']);

app.config(function($provide) {
    $provide.decorator('ColorPickerOptions', function($delegate) {
        var options = angular.copy($delegate);
        options.alpha = false;
        options.format = 'hex';
        return options;
    });
});

app.controller('MainsCtrl', function($scope, LabelResources){

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