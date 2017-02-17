app.controller('FeedsCtrl', function($scope, $sce, $timeout, FeedsResources, ProjectsResources, Flash, toastr, SweetAlert){

    $scope.feeds = [];
    $scope.feeds.currentPage = 1;

    $scope.assignUserMode = false;
    $scope.$projectSlug = null;
    var urlDivider = window.location.href.split("/projects/");
    if(urlDivider.length > 1)
    {
        $scope.$projectSlug = urlDivider[urlDivider.length - 1];
    }

    $scope.projects = [];
    $scope.fetchProjets = function () {
        var projects = ProjectsResources.query({}).$promise;
        projects.then(function (res) {
            if (res.projects) {
                $scope.projects = res.projects;
            }
        })
    };

    $scope.fetchProjets();


    $scope.fetchFeeds = function () {
        $scope.feed_loader = true;
        $timeout(function () {
            var conditions = {page: $scope.feeds.currentPage};
            if($scope.$projectSlug){
                conditions.slug = $scope.$projectSlug;
            }
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
                    $scope.feed_loader = false;
                }
            })
        }, 2000)
    };

    $scope.fetchFeeds();
    $scope.intervalFunction = function(){
        $timeout(function() {
            $scope.fetchFeeds();
            $scope.intervalFunction();
        }, 5000)
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
