var app = angular.module('Application', ['ngResource', 'textAngular', 'color.picker']);

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