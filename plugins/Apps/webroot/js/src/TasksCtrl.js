
app.controller('TasksCtrl', function($scope, LabelResources, UsersResources){
    $scope.TaskObj = {};
    $scope.saveTask = function(){
        console.log($scope.TaskObj);
        console.log($scope.taskLabels);
    };


    /**
     * Getting application active users.
     */
    $scope.fetchUserLists = function(){
        var users = UsersResources.query().$promise;
        users.then(function (res) {
            console.log(res);
            if(res.result.success){
                $scope.users = res.result.data;
            }
        });
    };
    $scope.fetchUserLists();

    /**
     * Getting application active label list.
     */
    $scope.fetchLabelLists = function(){
        var labels = LabelResources.query().$promise;
        labels.then(function (res) {
            if(res.result.success){
                $scope.labels = res.result.data;
            }
        });
    };
    $scope.fetchLabelLists();

    $scope.taskLabels = [];
    $scope.chooseTaskLabels = function(label, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.labels[key].checked = true;
            $scope.taskLabels.push(label);
        }
        else{
            $scope.labels[key].checked = false;
            $scope.taskLabels = $scope.taskLabels.filter(function(oldLabel){
                return oldLabel.id !== label.id;
            });
        }
    };

    $scope.removeTaskLabels = function(label){
        $scope.taskLabels = $scope.taskLabels.filter(function(oldLabel){
            return oldLabel.id !== label.id;
        });

        $scope.labels.forEach(function(orgLabel, key){
            if(orgLabel.id == label.id){
                $scope.labels[key].checked = false;
            }
        });
    }

    $scope.taskUsers = [];
    $scope.chooseTaskUsers = function(user, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.users[key].checked = true;
            $scope.taskUsers.push(user);
        }
        else{
            $scope.users[key].checked = false;
            $scope.taskUsers = $scope.taskUsers.filter(function(oldUser){
                return oldUser.id !== user.id;
            });
        }

        console.log($scope.taskUsers);
    };
});
