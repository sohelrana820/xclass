app.controller('LabelsCtrl', function($scope, $timeout, LabelResources, Flash, blockUI){

    $scope.create_form = true;
    $scope.edit_form = false;
    $scope.labels = [];

   $scope.fetchLabelLists = function(data){
       var labels = LabelResources.query(data).$promise;
       var myBlockUI = blockUI.instances.get('myBlockUI');
       myBlockUI.start({
           message: 'Please wait!',
       });

       labels.then(function (res) {
           if(res.result.success){
               $timeout(function() {
                   if(res.result.success){
                       $scope.label = {
                           data: res.result.data,
                           count: res.result.count,
                           currentPage: res.result.page,
                           limit: res.result.limit
                       };
                   }
                   myBlockUI.stop();
               }, 1000);
           }
       });
   };
    $scope.fetchLabelLists({});

    $scope.isLabelFormSubmitted = false;
    $scope.LabelObj = {color_code: '#C00C00'};

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
                    $scope.LabelObj = {color_code: '#C00C00'};
                    $scope.labels.unshift(res.result.data);
                    Flash.create('success', res.result.message);
                    $scope.fetchLabelLists({});
                }
                else{
                    Flash.create('danger', res.result.message);
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
                    $scope.LabelObj = {color_code: '#C00C00'};
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
                $scope.label.data = $scope.label.data.filter(function(label){
                    return label.id !== id
                });
                Flash.create('danger', res.result.message);
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

    $scope.goPreviousPage = function () {
        $scope.label.currentPage = parseInt($scope.label.currentPage) - 1;
        if($scope.label.currentPage < 1){
            $scope.label.currentPage = 1;
        }
        $scope.fetchLabelLists({page: $scope.label.currentPage});
    };

    $scope.goNextPage = function () {
        $scope.label.currentPage = parseInt($scope.label.currentPage ) + 1;
        var maxPage = parseInt($scope.label.count / $scope.label.limit);
        var modVal = $scope.label.count % $scope.label.limit;
        if(modVal > 0){
            maxPage = maxPage + 1;
        }
        if($scope.label.currentPage >= maxPage){
            $scope.label.currentPage = maxPage;
        }
        $scope.fetchLabelLists({page:  $scope.label.currentPage});
    }
});
