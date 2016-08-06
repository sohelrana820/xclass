app.controller('LabelsCtrl', function($scope, LabelResources){

    $scope.labels = [];
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        $scope.labels = res.labels
    });

    $scope.LabelObj = {
        color_code: '#C00C00'
    };

    $scope.saveLabel = function(){
        var labels = LabelResources.save($scope.LabelObj).$promise;
        labels.then(function (res) {
            if(res.result.success){
                $scope.LabelObj = {
                    color_code: '#C00C00'
                };
                console.log($scope.LabelObj);
                $scope.labels.unshift(res.result.data);
            }
        });
    }
});
