app.controller('LabelsCtrl', function($scope, LabelResources){

    $scope.saveLabel = function(){
        var labels = LabelResources.save($scope.LabelObj).$promise;
        labels.then(function (res) {
            console.log(res);
        });
    }
});
