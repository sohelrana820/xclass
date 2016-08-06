app.controller('LabelsCtrl', function($scope, LabelResources, Flash){

    $scope.labels = [];
    var labels = LabelResources.query().$promise;
    labels.then(function (res) {
        if(res.result.success){
            return $scope.labels = res.result.data;
        }
    });

    $scope.isLabelFormSubmitted = false;
    $scope.LabelObj = {color_code: '#C00C00'};

    $scope.saveLabel = function($isValid){
        $scope.isLabelFormSubmitted = true;
        if($isValid && $scope.LabelObj.name != undefined)
        {
            $scope.isLabelFormSubmitted = false;
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){
                    $scope.isLabelFormSubmitted = false;
                    $scope.LabelObj = {color_code: '#C00C00'};
                    $scope.labels.unshift(res.result.data);
                    Flash.create('success', 'Label has been created successfully');
                }
                else{
                    Flash.create('error', 'Sorry, label could not created');
                }
            });
        }
    };

    $scope.deleteLabel = function(id){
        var deletedLabel = LabelResources.delete({id: id}).$promise;
        deletedLabel.then(function (res) {
            if(res.result.success)
            {
                $scope.labels = $scope.labels.filter(function(label){
                    return label.id !== id
                });
                Flash.create('info', 'Label has been deleted successfully');
            }
            else{
                Flash.create('error', 'Sorry, label could not deleted');
            }
        });
    };

    $scope.openEditLabel = function(id){
        var getdLabel = LabelResources.get({id: id}).$promise;
        getdLabel.then(function (res) {
            $scope.LabelObj = res.result.data;
        });
    };
});
