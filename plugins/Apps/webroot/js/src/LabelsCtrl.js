app.controller('LabelsCtrl', function($scope, LabelResources){

    $scope.labels = [];
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        $scope.labels = res.labels
    });

    $scope.isLabelFormSubmitted = false;
    $scope.LabelObj = {
        color_code: '#C00C00'
    };

    $scope.saveLabel = function($isValid){
        $scope.isLabelFormSubmitted = true;

        if($isValid && $scope.LabelObj.name != undefined)
        {
            $scope.isLabelFormSubmitted = false;
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){

                    $scope.LabelObj = {

                    };
                    $scope.labels.unshift(res.result.data);
                }
            });
        }
    }
});
