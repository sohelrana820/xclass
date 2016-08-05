var app = angular.module('Application', ['ngResource', 'textAngular']);

app.controller('TaskCtrl', function($scope, LabelResources){

    $scope.saveTask = function(){
        console.log($scope.task);
    };

    // Getting companies list.
    this.getCompanies = function (params) {
        if(!params){
            params = {};
        }

        return CompaniesResources.query(params).$promise;
    };

    var labels = LabelResources.query().$promise;
    labels.then(function (labels) {
        console.log(labels);
    });
});

