app.controller('UsersCtrl', function($scope, $timeout, UsersResources, ProjectsResources, Flash, toastr, SweetAlert){

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/users");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    $scope.userObj = {};
    $scope.createUser = function () {
        var user = UsersResources.save($scope.userObj).$promise;
        user.then(function (res) {
            if (res.result.success) {
                toastr.success(res.result.message);
                $timeout(function () {
                    var isUsersAssigned = ProjectsResources.assignUser({user_id: res.result.data.id, slug: projectSlug}).$promise;
                    isUsersAssigned.then(function (res) {
                        if(res.result.success){
                            toastr.info(res.result.message);
                        }
                        else{
                            toastr.error(res.result.message);
                        }
                    });
                }, 500);
            }
            else {
                toastr.error(res.result.message);
                $scope.createUsersErrors = res.result.error_message;
            }
        })
    }
});
