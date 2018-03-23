app.controller('LabelsCtrl', function ($scope, $timeout, LabelResources, Flash, toastr, SweetAlert) {

    $scope.create_form = true;
    $scope.edit_form = false;
    $scope.searched_labels = false;
    $scope.labels = [];

    var urlDivider = window.location.href.split("/labels");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];
    projectSlug = decodeURIComponent(projectSlug);


    $scope.fetchLabelLists = function (data) {
        data.slug = projectSlug;
        $scope.show_center_loader = true;
        var labels = LabelResources.query(data).$promise;
        labels.then(function (res) {
            if (res.result.success) {
                $timeout(function () {
                    if (res.result.success) {
                        $scope.label = {
                            data: res.result.data,
                            count: res.result.count,
                            currentPage: res.result.page,
                            limit: res.result.limit
                        };
                    }
                    if (res.result.count == 0) {
                        $scope.show_crate_form = false;
                    }
                    $scope.hide_page_loader = true;
                    $scope.show_center_loader = false;
                }, 1000);
            }
        });
    };
    $scope.fetchLabelLists({});

    $scope.searchLabel = function (query) {
        $scope.searched_labels = true;
        $scope.fetchLabelLists({name: query});
    };

    $scope.isLabelFormSubmitted = false;
    $scope.LabelObj = {color_code: '#C00C00', status: 1};

    /**
     *
     * @param $isValid
     */
    $scope.saveLabel = function ($isValid) {
        $scope.isLabelFormSubmitted = true;
        if ($isValid && $scope.LabelObj.name != undefined) {
            $scope.LabelObj.slug = projectSlug;
            $scope.show_center_loader = true;
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if (res.result.success) {
                    $scope.isLabelFormSubmitted = false;
                    $scope.labels.unshift(res.result.data);
                    $scope.create_label_form.$setPristine();
                    $scope.LabelObj = {color_code: '#C00C00', status: 1};
                    toastr.success(res.result.message);
                    $scope.fetchLabelLists({});
                }
                else {
                    $scope.show_center_loader = false;
                    toastr.error(res.result.message);
                }
            });
        }
    };

    /**
     *
     * @param $isValid
     */
    $scope.updateLabel = function ($isValid) {
        $scope.isLabelFormSubmitted = true;
        if ($isValid && $scope.LabelObj.name != undefined) {
            $scope.isLabelFormSubmitted = false;
            delete $scope.LabelObj.created;
            delete $scope.LabelObj.modified;
            delete $scope.LabelObj.tasks;
            $scope.show_center_loader = true;
            var labels = LabelResources.update($scope.LabelObj).$promise;
            labels.then(function (res) {
                if (res.result.success) {
                    $scope.isLabelFormSubmitted = false;
                    $scope.fetchLabelLists({});
                    $scope.LabelObj = {color_code: '#C00C00', status: 1};
                    $scope.create_form = true;
                    $scope.edit_form = false;
                    toastr.success(res.result.message);
                    $scope.fetchLabelLists({});
                }
                else {
                    $scope.show_center_loader = false;
                    toastr.error(res.result.message);
                }
            });
        }
    };

    /**
     *
     * @param id
     */
    $scope.deleteLabel = function (id) {
        SweetAlert.swal({
                title: "Are you sure?",
                text: "You want to delete this label",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var deletedLabel = LabelResources.delete({id: id}).$promise;
                    $scope.show_center_loader = true;
                    deletedLabel.then(function (res) {
                        if (res.result.success) {
                            $scope.label.data = $scope.label.data.filter(function (label) {
                                return label.id !== id
                            });
                            toastr.error(res.result.message);
                            $scope.fetchLabelLists({});
                        }
                        else {
                            $scope.show_center_loader = false;
                            toastr.error(res.result.message);
                        }
                    });
                }
            });
    };

    /**
     *
     * @param id
     */
    $scope.openEditLabel = function (id) {
        $scope.create_form = false;
        $scope.edit_form = true;
        var getLabel = LabelResources.get({id: id}).$promise;
        getLabel.then(function (res) {
            if (res) {
                $scope.LabelObj = res.result.data;
            }
        });
    };


    $scope.goPreviousPage = function () {
        if ($scope.label.currentPage > 1) {
            $scope.label.currentPage = parseInt($scope.label.currentPage) - 1;
            $scope.fetchLabelLists({page: $scope.label.currentPage});
        }
    };

    $scope.goNextPage = function () {
        var maxPage = parseInt($scope.label.count / $scope.label.limit);
        if ($scope.label.currentPage <= maxPage) {
            $scope.label.currentPage = parseInt($scope.label.currentPage) + 1;
            $scope.fetchLabelLists({page: $scope.label.currentPage});
        }
    };
});
