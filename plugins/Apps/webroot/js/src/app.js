var app = angular.module('Application', ['ngResource', 'textAngular', 'ngFileUpload', 'color.picker', 'ngFlash', 'toastr', 'blockUI']);

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
            angular.element(document).find('.header_task_list').show();
            var tasks = TasksResources.query({query: query, limit: 5}).$promise;
            tasks.then(function (res) {
                $timeout(function(){
                    $scope.global_task_loader = false;
                    $scope.globalTaskLists = res.result.data;
                }, 1000)
            });
        }
        else{
            angular.element(document).find('.header_task_list').hide();
        }

    }
});
