app.controller('LabelsCtrl', function($scope, LabelResources, Flash){

    $scope.create_form = true;
    $scope.edit_form = false;
    $scope.labels = [];

   $scope.fetchLabelLists = function(){
       var labels = LabelResources.query().$promise;
       labels.then(function (res) {
           if(res.result.success){
               return $scope.labels = res.result.data;
           }
       });
   };
    $scope.fetchLabelLists();

    $scope.isLabelFormSubmitted = false;
    $scope.LabelObj = {color_code: '#C00C00', status: 1};

    /**
     *
     * @param $isValid
     */
    $scope.saveLabel = function($isValid){
        $scope.isLabelFormSubmitted = true;
        if($isValid && $scope.LabelObj.name != undefined)
        {
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){
                    $scope.isLabelFormSubmitted = false;
                    $scope.LabelObj = {color_code: '#C00C00', status: 1};
                    $scope.labels.unshift(res.result.data);
                    Flash.create('success', res.result.message);
                }
                else{
                    Flash.create('error', res.result.message);
                }
            });
        }
    };

    /**
     *
     * @param $isValid
     */
    $scope.updateLabel = function($isValid){
        $scope.isLabelFormSubmitted = true;
        if($isValid && $scope.LabelObj.name != undefined)
        {
            $scope.isLabelFormSubmitted = false;
            delete $scope.LabelObj.created;
            delete $scope.LabelObj.modified;
            delete $scope.LabelObj.tasks;
            var labels = LabelResources.update($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){
                    $scope.isLabelFormSubmitted = false;
                    $scope.fetchLabelLists();
                    $scope.LabelObj = {color_code: '#C00C00', status: 1};
                    $scope.create_form = true;
                    $scope.edit_form = false;
                    Flash.create('success', res.result.message);
                }
                else{
                    Flash.create('error', res.result.message);
                }
            });
        }
    };

    /**
     *
     * @param id
     */
    $scope.deleteLabel = function(id){
        var deletedLabel = LabelResources.delete({id: id}).$promise;
        deletedLabel.then(function (res) {
            if(res.result.success)
            {
                $scope.labels = $scope.labels.filter(function(label){
                    return label.id !== id
                });
                Flash.create('info', res.result.message);
            }
            else{
                Flash.create('error', res.result.message);
            }
        });
    };

    /**
     *
     * @param id
     */
    $scope.openEditLabel = function(id){
        $scope.create_form = false;
        $scope.edit_form = true;
        var getLabel = LabelResources.get({id: id}).$promise;
        getLabel.then(function (res) {
            if(res)
            {
                $scope.LabelObj = res.result.data;
            }
        });
    };
});
