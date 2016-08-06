app.controller('LabelsCtrl', function($scope, LabelResources){

    $scope.labels = [];
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        $scope.labels = res.labels
    });

    $scope.LabelObj = {};
    $scope.saveLabel = function(){
        var labels = LabelResources.save($scope.LabelObj).$promise;
        labels.then(function (res) {
            if(res.result.success){
                $scope.LabelObj = {};
                $scope.labels.unshift(res.result.data);
            }
        });
    }
});
