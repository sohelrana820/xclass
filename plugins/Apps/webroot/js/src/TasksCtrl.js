app.controller('TasksCtrl', function($scope, LabelResources, UsersResources, TasksResources, CommentsResources, Flash, toastr){
    $scope.TaskObj = {};

    $scope.getTaskRelObj = function(){
        var usersIDs = [];
        $scope.taskUsers.forEach(function(user){
            usersIDs.push(user.id);
        });
        $scope.TaskObj.users = {
            '_ids': usersIDs
        };

        var labelsIDs = [];
        $scope.taskLabels.forEach(function(label){
            labelsIDs.push(label.id);
        });
        $scope.TaskObj.labels = {
            '_ids': labelsIDs
        };
    };

    $scope.saveTask = function(){
        $scope.getTaskRelObj();
        var task = TasksResources.save($scope.TaskObj).$promise;
        task.then(function (res) {
            if(res.result.success){
                $scope.TaskObj = {};
                Flash.create('success', res.result.message);
            }
            else{
                Flash.create('info', res.result.message);
            }
        });
    };


    /**
     * Getting application active users.
     */
    $scope.fetchUserLists = function(){
        var users = UsersResources.query().$promise;
        users.then(function (res) {
            if(res.result.success){
                $scope.users = res.result.data;
            }
        });
    };
    $scope.fetchUserLists();


    /**
     * Getting application active users.
     */
    $scope.fetchTaskLists = function(){
        var tasks = TasksResources.query().$promise;
        tasks.then(function (res) {
            if(res.result.success){
                $scope.tasks = res.result.data;
                $scope.totalTasks = res.result.count;
            }
        });
    };
    $scope.fetchTaskLists();

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
    };

    $scope.removeTaskUsers = function(user){
        $scope.taskUsers = $scope.taskUsers.filter(function(oldUser){
            return oldUser.id !== user.id;
        });

        $scope.users.forEach(function(oldUser, key){
            if(oldUser.id == label.id){
                $scope.users[key].checked = false;
            }
        });
    };

    $scope.buildTaskObjForShow = function(id){
        var task = TasksResources.get({id: id}).$promise;
        task.then(function (res) {
            $scope.TaskObj.id = res.result.data.id;
            $scope.TaskObj.task = res.result.data.task;
            $scope.TaskObj.description = res.result.data.description;
            $scope.TaskObj.status = res.result.data.status;
            $scope.taskUsers = res.result.data.users;
            $scope.taskLabels = res.result.data.labels;
            $scope.taskComments = res.result.data.comments;
        });
    };

    // Task edit and comments area
    var url = window.location.href.split("edit/");
    if(url.length == 2)
    {
        var id = url[1];
    }
    else{
        var url = window.location.href.split("view/");
        var id = url[1];
    }
    if(id != undefined)
    {
        $scope.buildTaskObjForShow(id);
    }



    $scope.updateTask = function(){
        $scope.getTaskRelObj();
        var task = TasksResources.update($scope.TaskObj).$promise;
        task.then(function (res) {
            if(res.result.success){
                $scope.buildTaskObjForShow(id);
                $scope.view_task = true;
                $scope.edit_task_form = false;
                Flash.create('success', res.result.message);
            }
            else{
                Flash.create('info', res.result.message);
            }
        });
    };

    $scope.quickUpdate = function(event, value){
        $scope.getTaskRelObj();
        var task = TasksResources.update($scope.TaskObj).$promise;
        task.then(function (res) {
            if(res.result.success){
                if(event == 'user_event'){
                    if(value)
                    {
                        toastr.success('New user has been assigned successfully!');
                    }
                    else{
                        toastr.error('User has been removed successfully!');
                    }
                }
                else if(event == 'label_event'){
                    if(value)
                    {
                        toastr.success('New label has been added successfully!');
                    }
                    else{
                        toastr.error('Label has been removed successfully!');
                    }
                }
                else if(event == 'change_status'){
                    if(value == 2)
                    {
                        Flash.create('success', 'Task has been marked as closed');
                    }
                    else if(value == 3){
                        Flash.create('danger', 'Task has been reopened');
                    }
                }
            }
        });
    };

    $scope.commentsObj = {task_id: id};
    $scope.doComment = function(flsMsg){
        console.log($scope.commentsObj);
        var comments = CommentsResources.save($scope.commentsObj).$promise;
        comments.then(function (res) {
            if(res.result.success){
                $scope.commentsObj = {task_id: id};
                $scope.taskComments.push(res.result.data);
                if(flsMsg == undefined){
                    Flash.create('success', res.result.message);
                }
            }
            else{
                Flash.create('info', res.result.message);
            }
        });
    };

    $scope.changeStatus = function(status){
        $scope.TaskObj.status = status;
        $scope.quickUpdate('change_status', status);
        if(status == 2){
            $scope.commentsObj.changing_status = 'closed'
        }
        else if(status == 3){
            $scope.commentsObj.changing_status = 'reopened'
        }
        $scope.doComment(false);
    };

    /**
     *
     * @param id
     */
    $scope.deleteTask = function(id){
        var deletedTask = TasksResources.delete({id: id}).$promise;
        deletedTask.then(function (res) {
            if(res.result.success)
            {
                $scope.tasks = $scope.tasks.filter(function(task){
                    return task.id !== id
                });
                Flash.create('success', res.result.message);
            }
            else{
                Flash.create('danger', res.result.message);
            }
        });
    };
});
