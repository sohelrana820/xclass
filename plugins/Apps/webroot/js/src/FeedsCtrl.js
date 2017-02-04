app.controller('FeedsCtrl', function($scope, $sce, $timeout, FeedsResources, ProjectsResources, Flash, toastr, SweetAlert){

    $scope.feeds = [];
    $scope.feeds.currentPage = 1;

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/projects/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    $scope.fetchFeeds = function () {
        var conditions = {slug: projectSlug, page: $scope.feeds.currentPage};
        var feeds = FeedsResources.query(conditions).$promise;
        feeds.then(function (res) {
            if (res.result.success) {
                $scope.feeds = {
                    data: res.result.data,
                    count: res.result.count,
                    count_all: res.result.count_all,
                    currentPage: res.result.page,
                    limit: res.result.limit
                };
                console.log();
            }
        })
    };

    $scope.fetchFeeds();

    $scope.intervalFunction = function(){
        $timeout(function() {
            $scope.fetchFeeds();
            $scope.intervalFunction();
        }, 500000)
    };
    $scope.intervalFunction();

    $scope.trustAsHtml = function(string) {
        return $sce.trustAsHtml(string);
    };

    $scope.goPreviousPage = function () {
        if($scope.feeds.currentPage > 1){
            $scope.feeds.currentPage = parseInt($scope.feeds.currentPage) - 1;
            $scope.fetchFeeds();
        }
    };

    $scope.goNextPage = function () {
        var maxPage = parseInt($scope.feeds.count / $scope.feeds.limit);
        if($scope.feeds.currentPage <= maxPage){
            $scope.feeds.currentPage = parseInt($scope.feeds.currentPage) + 1;
            $scope.fetchFeeds();
        }
    };
});
