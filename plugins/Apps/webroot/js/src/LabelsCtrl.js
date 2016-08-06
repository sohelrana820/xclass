app.controller('LabelsCtrl', function($scope, LabelResources){

    $scope.labels = [];
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        $scope.labels = res.labels
    });

    $scope.LabelObj = {
        color_code: '#C00C00'
    };

    $scope.isLabelFormSubmitted = false;
    $scope.saveLabel = function(){
        $scope.isLabelFormSubmitted = true;
        if($scope.LabelObj.name != undefined)
        {
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){
                    $scope.isLabelFormSubmitted = false;
                    $scope.LabelObj = {
                        color_code: '#C00C00'
                    };
                    $scope.labels.unshift(res.result.data);
                }
            });
        }
    }
});
