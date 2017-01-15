app.controller('ProjectsCtrl', function($scope, $timeout, ProjectsResources, UsersResources, Flash, toastr){

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/users");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    $scope.fetchProjectUsers = function (data) {
        var users = ProjectsResources.query(data).$promise;
        users.then(function (res) {
            if (res.projectUsers.success) {
                $timeout(function () {
                    if (res.projectUsers.success) {
                        $scope.projectsUsers = {
                            users: res.projectUsers.data,
                            count: res.projectUsers.count,
                            /*currentPage: res.result.page,
                            limit: res.result.limit*/
                        };
                    }
                }, 1000);
            }
        });
    };
    $scope.fetchProjectUsers({slug: projectSlug});

    /**
     * Getting application active users.
     */
    $scope.fetchUserLists = function(data){
        var users = UsersResources.query(data).$promise;
        users.then(function (res) {
            if(res.result.success){
                $timeout(function() {
                    $scope.users = res.result.data;
                    $scope.show_user_search_loader = false;
                    $scope.show_user_refresh_loader = false;
                }, 500);
            }
        });
    };

    $scope.searchUser = function(query){
        $scope.show_user_search_loader = true;
        $scope.fetchUserLists({name: query, 'limit': false});
    };

    $scope.refreshUserList = function(query){
        $scope.fetchUserLists({'limit': false});
        $scope.user_query = null;
        $scope.show_user_refresh_loader = true;
        $scope.show_user_search_loader = false;
    };

    $scope.assignProjectUser = function (userId) {
        var isUsersAssigned = ProjectsResources.assignUser({user_id: userId, slug: projectSlug}).$promise;
        isUsersAssigned.then(function (res) {
            if(res.result.success){
                $scope.projectsUsers.users.unshift(res.result.data);
                toastr.success(res.result.message);
            }
            else{
                toastr.error(res.result.message);
            }
        });
    }
});
