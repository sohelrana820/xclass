var app = angular.module('Application', ['ngResource', 'textAngular']);

app.controller('TaskCtrl', function($scope, LabelResources){

    $scope.TaskObj = {};
    $scope.saveTask = function(){
        console.log($scope.TaskObj);
        console.log($scope.taskLabels);
    };

    // Getting all active labels.
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        $scope.labels = res.labels
    });

    $scope.taskLabels = [];
    $scope.chooseTaskLabels = function(label, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.labels[key].checked = true;
            $scope.taskLabels.push(label);
        }
        else{
            $scope.labels[key].checked = false;
            $scope.taskLabels = $scope.taskLabels.filter(function(oldLabel){
                return oldLabel.id !== label.id;
            });
        }
    };

    $scope.removeTaskLabels = function(label){
        $scope.taskLabels = $scope.taskLabels.filter(function(oldLabel){
            return oldLabel.id !== label.id;
        });

        $scope.labels.forEach(function(orgLabel, key){
            if(orgLabel.id == label.id){
                $scope.labels[key].checked = false;
            }
        });
    }
});


$('.task_operation').on('click', function (event) {
    $(this).parent().find('.dropdown').toggleClass('open');
});

$('.close_dropdown').on('click', function (event) {
    $(this).parent().parent().parent().toggleClass('open');
});