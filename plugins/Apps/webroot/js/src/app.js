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

app.controller('MainsCtrl', function($scope, LabelResources, BASE_URL){
    $scope.BASE_URL = BASE_URL;
});
