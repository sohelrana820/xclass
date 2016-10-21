app.controller('DashboardCtrl', function($scope, LabelResources, UsersResources, TasksResources, DashboardResources, CommentsResources, Flash, toastr, $timeout, BASE_URL, Upload){
    $scope.BASE_URL = BASE_URL;

    $scope.fetchAppOverview = function(data){
        $scope.overview_loader = true;
        var overview = DashboardResources.get().$promise;
        overview.then(function (res) {
            $scope.overview = res.result;
            $scope.overview_loader = false;
        });
    };

    $scope.fetchAppOverview();
});