var app = angular.module('Application', ['textAngular']);

app.controller('TaskCtrl', function($scope){

    $scope.saveTask = function(){
        console.log($scope.task);
    }
});