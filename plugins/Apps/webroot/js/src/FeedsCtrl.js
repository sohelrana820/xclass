app.controller('FeedsCtrl', function($scope, $sce, $timeout, FeedsResources, ProjectsResources, Flash, toastr, SweetAlert){

    $scope.feeds = [];

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/projects/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    $scope.fetchFeeds = function (data) {
        var feeds = FeedsResources.query(data).$promise;
        feeds.then(function (res) {
            if (res.result.success) {
                $scope.feeds = res.result.data;
                console.log($scope.feeds);
            }
        })
    };

    $scope.fetchFeeds({slug: projectSlug});

    $scope.intervalFunction = function(){
        $timeout(function() {
            $scope.fetchFeeds({slug: projectSlug});
            $scope.intervalFunction();
        }, 5000)
    };
    $scope.intervalFunction();

    $scope.trustAsHtml = function(string) {
        return $sce.trustAsHtml(string);
    };
});
