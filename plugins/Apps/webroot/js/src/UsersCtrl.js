app.controller('UsersCtrl', function($scope, $timeout, UsersResources, Flash, toastr, SweetAlert){

    $scope.assignUserMode = false;
    var urlDivider = window.location.href.split("/users");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];

    console.log(projectSlug);

    $scope.userObj = {};
    $scope.createUser = function () {
        var user = UsersResources.save($scope.userObj).$promise;
        user.then(function (res) {

            if (res.result.success) {
                toastr.success(res.result.message);
            }
            else {
                toastr.error(res.result.message);
                $scope.createUsersErrors = res.result.error_message;
            }
        })
    }
});
