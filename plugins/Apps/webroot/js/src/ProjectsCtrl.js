app.controller('ProjectsCtrl', function($scope, $timeout, ProjectsResources, UsersResources, Flash, toastr){

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/users");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    $scope.fetchProjectUsers = function (data) {
        var users = ProjectsResources.projects_users(data).$promise;
        users.then(function (res) {
            if (res.result.success) {
                $timeout(function () {
                    if (res.result.success) {
                        $scope.projectsUsers = {
                            users: res.result.data,
                            count: res.result.count,
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
        $scope.fetchUserLists({name: query, 'limit': 5});
    };

    $scope.refreshUserList = function(query){
        $scope.fetchUserLists({'limit': 5});
        $scope.user_query = null;
        $scope.show_user_refresh_loader = true;
        $scope.show_user_search_loader = false;
    };

    $scope.assignProjectUser = function (userId) {
        var isUsersAssigned = ProjectsResources.assignUser({user_id: userId, slug: projectSlug}).$promise;
        isUsersAssigned.then(function (res) {
            if(res.result.success){
                $scope.fetchProjectUsers({slug: projectSlug});
                $scope.user_query = null;
                toastr.success(res.result.message);
            }
            else{
                toastr.error(res.result.message);
            }
        });
    };

    $scope.removeProjectUser = function (projectsUsersId) {
        var isUsersRemoved = ProjectsResources.removeUser({user_id: projectsUsersId, slug: projectSlug}).$promise;
        isUsersRemoved.then(function (res) {
            if(res.result.success){
                $scope.fetchProjectUsers({slug: projectSlug});
                $scope.user_query = null;
                toastr.error(res.result.message);
            }
            else{
                toastr.error(res.result.message);
            }
        });
    }
});
