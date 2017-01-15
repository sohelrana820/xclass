app.controller('ProjectsCtrl', function($scope, $timeout, ProjectsResources, Flash, toastr){

    var urlDivider = window.location.href.split("/users");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];
    console.log(projectSlug);

    $scope.fetchProjectUsers = function (data) {
        var users = ProjectsResources.query(data).$promise;
        users.then(function (res) {
            console.log(res);
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

});
