var app = angular.module('Application', ['ngResource', 'textAngular', 'ngFileUpload', 'color.picker', 'ngFlash', 'toastr', 'blockUI', 'nvd3']);

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


    $scope.options = {
        chart: {
            type: 'pieChart',
            height: 250,
            x: function(d){return d.key;},
            y: function(d){return d.y;},
            showLabels: true,
            duration: 500,
            labelThreshold: 0.01,
            labelSunbeamLayout: true,
            legend: {
                margin: {
                    top: 5,
                    right: 35,
                    bottom: 5,
                    left: 0
                }
            }
        }
    };

    $scope.data = [
        {
            key: "One",
            y: 5
        },
        {
            key: "Two",
            y: 2
        },
        {
            key: "Three",
            y: 9
        },
    ];


    $scope.options2 = {
        chart: {
            type: 'cumulativeLineChart',
            height: 250,
            margin : {
                top: 20,
                right: 20,
                bottom: 60,
                left: 65
            },
            x: function(d){ return d[0]; },
            y: function(d){ return d[1]/100; },

            color: d3.scale.category10().range(),
            duration: 300,
            useInteractiveGuideline: true,
            clipVoronoi: false,

            xAxis: {
                axisLabel: 'X Axis',
                tickFormat: function(d) {
                    return d3.time.format('%m/%d/%y')(new Date(d))
                },
                showMaxMin: false,
                staggerLabels: true
            },

            yAxis: {
                axisLabel: 'Y Axis',
                tickFormat: function(d){
                    return d3.format(',.1%')(d);
                },
                axisLabelDistance: 20
            }
        }
    };

    $scope.data2 = [
        {
            key: "Long",
            values: [ [ 1083297600000 , 1] , [ 77078283705125 , 2], [ 1085976000000 , 3] , [ 8356366650335 , 4], [ 1088568000000 , 5] , [ 3121322073127 , 6] ]
            ,
            mean: 250
        },
        {
            key: "Short",
            values: [ [ 1083297600000 , 1] , [ 77078283705125 , 2], [ 1085976000000 , 5] , [ 8356366650335 , 1], [ 1088568000000 , 5] , [ 3121322073127 , 4] ]
            ,
            mean: -60
        },
    ];
});
