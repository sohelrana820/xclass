app.controller('TasksCtrl', function($scope, LabelResources, UsersResources, TasksResources, CommentsResources, Flash, toastr, $timeout, BASE_URL, Upload){
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
        console.log($scope.TaskObj);
        Upload.upload({
            url: BASE_URL + 'tasks/add.json',
            data: $scope.TaskObj
        }).then(function (response) {
            console.log(response.data);
            if(response.data.result.success){
                $scope.TaskObj = {};
                Flash.create('success', response.data.result.message);
                $timeout(function() {
                    window.location.href = BASE_URL + "tasks";
                }, 1000);
            }
            else{
                Flash.create('info', response.data.result.message);
            }
        });
    };


    $scope.countAttachments = [0];
    $scope.addMoreAttachment = function()
    {
        console.log($scope.countAttachments);
        $scope.countAttachments.push($scope.countAttachments.length);
        console.log($scope.countAttachments);
    };

    /**
     * Getting application active users.
     */
    $scope.fetchUserLists = function(data){

        var users = UsersResources.query(data).$promise;
        users.then(function (res) {
            if(res.result.success){
                $timeout(function() {
                    $scope.users = res.result.data;
                    $scope.show_user_search_loader = false;
                    $scope.show_user_refresh_loader = false;
                }, 500);
            }
        });
    };
    $scope.fetchUserLists();


    /**
     * Getting application active users.
     */
    $scope.fetchTaskLists = function(data){
        var tasks = TasksResources.query(data).$promise;
        tasks.then(function (res) {
            if(res.result.success){
                $scope.tasks = res.result.data;
                $scope.totalTasks = res.result.count;
                $scope.count_all = res.result.count_all;
            }
        });
    };
    $scope.fetchTaskLists();

    /**
     * Getting application active label list.
     */
    $scope.fetchLabelLists = function(data){
        var labels = LabelResources.query(data).$promise;
        labels.then(function (res) {
            if(res.result.success){
                $timeout(function() {
                    $scope.show_label_search_loader = false;
                    $scope.show_label_refresh_loader = false;
                    $scope.labels = res.result.data;
                }, 500);
            }
        });
    };
    $scope.fetchLabelLists({status: 1});

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
    };

    $scope.searchLabel = function(query){
        $scope.show_label_search_loader = true;
        $scope.fetchLabelLists({status: 1, name: query});
    };

    $scope.refreshLabelList = function(query){
        $scope.fetchLabelLists({status: 1});
        $scope.label_query = null;
        $scope.show_label_search_loader = false;
        $scope.show_label_refresh_loader = true;
    };

    $scope.saveLabel = function(isValid){
        $scope.show_label_create_loader = isValid;
        $scope.isLabelFormSubmitted = true;
        var labels = LabelResources.save($scope.LabelObj).$promise;
        labels.then(function (res) {
            if(res.result.success){

                $timeout(function() {
                    $scope.show_label_create_loader = false;
                    $scope.isLabelFormSubmitted = false;
                    $scope.LabelObj = {};
                    $scope.labels.unshift(res.result.data);

                    $scope.labels.forEach(function(label,key){
                        if(label.id == res.result.data.id){
                            $scope.labels[key].checked = true;
                        }
                    });
                    $scope.taskLabels.push(res.result.data);
                    toastr.success(res.result.message);
                    $scope.show_create_new_label_form = false;
                }, 500);


            }
            else{
                $scope.show_label_create_loader = false;
                toastr.error(res.result.message);
            }
        });
    };

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
            if(oldUser.id == user.id){
                $scope.users[key].checked = false;
            }
        });
    };

    $scope.searchUser = function(query){
        $scope.show_user_search_loader = true;
        $scope.fetchUserLists({name: query});
    };

    $scope.refreshUserList = function(query){
        $scope.fetchUserLists();
        $scope.user_query = null;
        $scope.show_user_refresh_loader = true;
        $scope.show_user_search_loader = false;
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
            $scope.taskAttachments = res.result.data.attachments;
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
    $scope.doComment = function(){
        if($scope.commentsObj.comment)
        {

            Upload.upload({
                url: BASE_URL + 'comments/add.json',
                data: $scope.commentsObj
            }).then(function (response) {
                console.log(response);
                if(response.data.result.success){
                    $scope.commentsObj = {task_id: id};
                    $scope.taskComments.push(response.data.result.data);
                    Flash.create('success', response.data.result.message);
                    $scope.countAttachments = [0];
                }
                else{
                    Flash.create('info', response.data.result.message);
                }
            });


            /*var comments = CommentsResources.save($scope.commentsObj).$promise;
            comments.then(function (res) {
                if(res.result.success){
                    $scope.commentsObj = {task_id: id};
                    $scope.taskComments.push(res.result.data);
                    Flash.create('success', res.result.message);
                }
                else{
                    Flash.create('danger', res.result.message);
                }
            });*/
        }
        else{
            Flash.create('danger', 'Write something in comments');
        }
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

        var comments = CommentsResources.save($scope.commentsObj).$promise;
        comments.then(function (res) {
            if(res.result.success){
                $scope.commentsObj = {task_id: id};
                $scope.taskComments.push(res.result.data);
            }
            else{
                Flash.create('info', res.result.message);
            }
        });
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
                Flash.create('danger', res.result.message);
                $timeout(function() {
                    window.location.href = BASE_URL + "tasks";
                }, 1000);
            }
            else{
                Flash.create('danger', res.result.message);
            }
        });
    };


    /*$scope.queryFilter = {
     'status': 1,
     'labels[]': [1, 2, 3, 4],
     'users[]': [12, 3, 3, 4]
     };*/

    $scope.queryString = {};

    $scope.clearQueryString = function(){
        $scope.filterQuery.unlabeled = false;
        $scope.filterQuery.unassigned = false;
        $scope.filtterAssignee = [];
        $scope.filtterAuthor = [];
        $scope.filterLabels = [];
        $scope.filterQuery.sort_by = false;
        $scope.filterQuery.order_by = false;
        $scope.filterQuery.status = 'all';
    };

    $scope.doFilter = function(){
        var status = [];
        var labels = [];
        var users = [];
        var authors = [];

        if($scope.filterQuery){
            if($scope.filterQuery.status == 'closed'){
                status = [2];
            }
            else if($scope.filterQuery.status == 'open'){
                status = [1, 3];
            }
            else if($scope.filterQuery.status == 'all'){
                status = [1, 2, 3];
            }
        };


        var users = [];
        $scope.filtterAssignee.forEach(function(user){
            users.push(user.id);
        });

        var authors = [];
        $scope.filtterAuthor.forEach(function(user){
            authors.push(user.id);
        });

        var labels = [];
        $scope.filterLabels.forEach(function(label){
            labels.push(label.id);
        });

        $scope.queryString = {
            'status[]': status,
            'labels[]': labels,
            'users[]': users,
            'authors[]': authors,
            /*'sort_by': $scope.filterQuery.sort_by,
            'order_by': $scope.filterQuery.order_by,
            'unlabeled': $scope.filterQuery.unlabeled,
            'unassigned': $scope.filterQuery.unassigned,*/
        };



        $scope.fetchTaskLists($scope.queryString);
        console.log(status);
        console.log(status);
        console.log(labels);
        console.log(authors);
        console.log($scope.queryString);
    };

    $scope.filtterAssignee = [];
    $scope.chooseFilterAssignee = function(user, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.users[key].checked = true;
            $scope.filtterAssignee.push(user);
        }
        else{
            $scope.users[key].checked = false;
            $scope.filtterAssignee = $scope.filtterAssignee.filter(function(oldUser){
                return oldUser.id !== user.id;
            });
        }
        console.log($scope.filtterAssignee);
        $scope.doFilter();
    };

    $scope.removeFilterAssignee = function(user){
        $scope.filtterAssignee = $scope.filtterAssignee.filter(function(oldUser){
            return oldUser.id !== user.id;
        });

        $scope.users.forEach(function(oldUser, key){
            if(oldUser.id == user.id){
                $scope.users[key].checked = false;
            }
        });
        $scope.doFilter();
    };


    $scope.filtterAuthor = [];
    $scope.chooseFilterAuthor = function(user, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.users[key].checked = true;
            $scope.filtterAuthor.push(user);
        }
        else{
            $scope.users[key].checked = false;
            $scope.filtterAuthor = $scope.filtterAuthor.filter(function(oldUser){
                return oldUser.id !== user.id;
            });
        }
        console.log($scope.filtterAuthor);
        $scope.doFilter();
    };

    $scope.removeFilterAuthor = function(user){
        $scope.filtterAuthor = $scope.filtterAuthor.filter(function(oldUser){
            return oldUser.id !== user.id;
        });

        $scope.users.forEach(function(oldUser, key){
            if(oldUser.id == user.id){
                $scope.users[key].checked = false;
            }
        });
        $scope.doFilter();
    };

    $scope.filterLabels = [];
    $scope.chooseFilterLabel = function(label, key, isChecked){
        if(isChecked == undefined || isChecked == false)
        {
            $scope.labels[key].checked = true;
            $scope.filterLabels.push(label);
        }
        else{
            $scope.labels[key].checked = false;
            $scope.filterLabels = $scope.filterLabels.filter(function(oldLabel){
                return oldLabel.id !== label.id;
            });
        }
        $scope.doFilter();
    };

    $scope.removeFilterLabel = function(label){
        $scope.filterLabels = $scope.filterLabels.filter(function(oldLabel){
            return oldLabel.id !== label.id;
        });

        $scope.labels.forEach(function(orgLabel, key){
            if(orgLabel.id == label.id){
                $scope.labels[key].checked = false;
            }
        });
        $scope.doFilter();
    }
});
