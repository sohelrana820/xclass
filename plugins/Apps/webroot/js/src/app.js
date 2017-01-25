var app = angular.module('Application', ['ngResource', 'textAngular', 'ngFileUpload', 'color.picker', 'ngFlash', 'toastr', 'oitozero.ngSweetAlert']);

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

app.controller('MainsCtrl', function($scope, LabelResources, TasksResources, BASE_URL, $timeout){
    $scope.BASE_URL = BASE_URL;

    $scope.searchGlobalTask = function(query)
    {
        if(query)
        {
            $scope.global_task_loader = true;
            angular.element(document).find('.header_task_list').fadeIn(500);
            var tasks = TasksResources.query({query: query, limit: 5}).$promise;
            tasks.then(function (res) {
                $timeout(function(){
                    $scope.global_task_loader = false;
                    $scope.globalTaskLists = res.result.data;
                }, 1000)
            });
        }
        else{
            angular.element(document).find('.header_task_list').fadeOut(500);
        }
    };

    $scope.hideHeaderTaskArea = function () {
        $timeout(function(){
            angular.element(document).find('.header_task_list').fadeOut(500);
        },2000);
    };

    $scope.viewMode = 'overview';
    $scope.openedView =function (mode) {
        $scope.viewMode = mode;
    }
});


app.directive("matchPassword", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=matchPassword"
        },
        link: function(scope, element, attributes, ngModel) {

            ngModel.$validators.matchPassword = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
});

app.directive('uniqueEmail', function ($http, $q, UsersResources) {
    return {
        require: 'ngModel',
        link: function ($scope, element, attrs, ngModel) {
            ngModel.$asyncValidators.uniqueEmail = function (modelValue, viewValue) {
                var $promise = UsersResources.email_availability({email: modelValue});
                return $promise.$promise.then(function (response) {
                    return response;
                }).then(function (response) {
                    if (response.result.is_available) {
                        return $q.when();
                    }
                    else {
                        return $q.reject();
                    }
                }, function (error) {

                });
            };
        }
    };
});