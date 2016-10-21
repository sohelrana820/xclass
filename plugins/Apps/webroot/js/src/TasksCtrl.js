app.controller('TasksCtrl', function($scope, LabelResources, UsersResources, TasksResources, DashboardResources, CommentsResources, Flash, toastr, $timeout, BASE_URL, Upload){
    $scope.BASE_URL = BASE_URL;
    /*    // Getting all active labels.
     $scope.fetchLabelsLists = function(){
     $scope.labels = [];
     var labels = LabelResources.query().$promise;
     labels.then(function (res) {
     $scope.labels = res.labels
     });
     };

     $scope.fetchLabelsLists();*/

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

    isDashboardOpend = false;
    var openedUrl = window.location.href.split("tasks");
    if(openedUrl.length < 2){
        isDashboardOpend = true;
    }

    $scope.saveTask = function(){
        $scope.getTaskRelObj();
        console.log($scope.TaskObj);
        if($scope.TaskObj.task){
            Upload.upload({
                url: BASE_URL + 'tasks/add.json',
                data: $scope.TaskObj
            }).then(function (response) {
                if(response.data.result.success){
                    $scope.TaskObj = {};
                    $scope.taskLabels = [];
                    $scope.taskUsers = [];
                    if(!isDashboardOpend){
                        Flash.create('success', response.data.result.message);
                        $timeout(function() {
                            window.location.href = BASE_URL + "tasks";
                        }, 1000);
                    }
                    else{
                        $scope.labels.forEach(function(label, key){
                            $scope.labels[key].checked = false;
                        });
                        $scope.users.forEach(function(user, key){
                            $scope.users[key].checked = false;
                        });
                        $scope.countAttachments = [0];
                        toastr.success(response.data.result.message);
                        $scope.fetchTaskLists({limit: 5});
                    }

                }
                else{
                    if(isDashboardOpend){
                        toastr.success(response.data.result.message);
                    }
                    else{
                        Flash.create('info', response.data.result.message);
                    }
                }
            });
        }
        else{
            toastr.error('Task title can not be empty');
        }
    };


    $scope.countAttachments = [0];
    $scope.addMoreAttachment = function()
    {
        $scope.countAttachments.push($scope.countAttachments.length);
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
    $scope.fetchUserLists({'limit': false});


    /**
     * Getting application active users.
     */
    $scope.fetchTaskLists = function(data){

        $scope.dashboard_task_loader = true;
        var tasks = TasksResources.query(data).$promise;
        tasks.then(function (res) {
            if(res.result.success){
                $timeout(function() {
                    $scope.tasks = {
                        data: res.result.data,
                        count: res.result.count,
                        count_all: res.result.count_all,
                        currentPage: res.result.page,
                        limit: res.result.limit
                    };
                    $scope.dashboard_task_loader = false;
                    $scope.task_loader = true;
                }, 1000);
            }

        });
    };


    if(isDashboardOpend){
        $scope.fetchTaskLists({limit: 5});
    }
    else{
        $scope.fetchTaskLists();
    }

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
    $scope.fetchLabelLists({status: 1, 'limit': false});

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
        $scope.fetchLabelLists({status: 1, 'limit': false, name: query});
    };

    $scope.refreshLabelList = function(query){
        $scope.fetchLabelLists({status: 1, 'limit': false});
        $scope.label_query = null;
        $scope.show_label_search_loader = false;
        $scope.show_label_refresh_loader = true;
    };

    $scope.LabelObj = {color_code: '#C00C00'};
    $scope.saveLabel = function(isValid, assignLabel){
        if($scope.LabelObj.name != undefined && $scope.LabelObj.name){
            $scope.show_label_create_loader = isValid;
            $scope.isLabelFormSubmitted = true;
            var labels = LabelResources.save($scope.LabelObj).$promise;
            labels.then(function (res) {
                if(res.result.success){
                    $timeout(function() {
                        $scope.show_label_create_loader = false;
                        $scope.isLabelFormSubmitted = false;
                        $scope.create_label_form.$setPristine();
                        $scope.LabelObj = {color_code: '#C00C00'};
                        $scope.labels.unshift(res.result.data);

                        $scope.labels.forEach(function(label,key){
                            if(label.id == res.result.data.id){
                                $scope.labels[key].checked = true;
                            }
                        });
                        $scope.taskLabels.push(res.result.data);
                        $scope.show_create_new_label_form = false;

                        if(assignLabel && assignLabel != undefined){
                            $scope.quickUpdate('label_event', true)
                        }
                        if(isDashboardOpend){
                            $scope.fetchAppOverview();
                        }
                        toastr.success(res.result.message);
                    }, 500);


                }
                else{
                    $scope.show_label_create_loader = false;
                    toastr.error(res.result.message);
                }
            });
        }
        else{
            toastr.error('Label name can not be empty');
        }
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
        $scope.fetchUserLists({name: query, 'limit': false});
    };

    $scope.refreshUserList = function(query){
        $scope.fetchUserLists({'limit': false});
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
                        //toastr.success('New label has been added successfully!');
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

        Upload.upload({
            url: BASE_URL + 'comments/add.json',
            data: $scope.commentsObj
        }).then(function (response) {
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
                toastr.error(res.result.message);
                var url = window.location.href.split("view/");
                if(url[1] != undefined && url[1]){
                    $timeout(function() {
                        window.location.href = BASE_URL + "tasks";
                    }, 1000);
                }
                else{
                    $scope.fetchTaskLists($scope.queryString);
                }
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
        $scope.filterQuery.unlabeled = null;
        $scope.filterQuery.unassigned = false;
        $scope.filtterAssignee = [];
        $scope.filtterAuthor = [];
        $scope.filterLabels = [];
        $scope.filterQuery.sort_by = null;
        $scope.filterQuery.order_by = null;
        $scope.filterQuery.status = 'all';
        $scope.filterQuery.query = null;
    };

    $scope.filterQuery = {};
    $scope.doFilter = function(){
        var status = [];
        var labels = [];
        var users = [];
        var authors = [];
        var authors = [];
        $scope.filtered_tasks_list = true;

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
            'query': $scope.filterQuery.query,
            'status[]': status,
            'labels[]': labels,
            'users[]': users,
            'authors[]': authors,
            'sort_by': $scope.filterQuery.sort_by,
            'order_by': $scope.filterQuery.order_by,
            'unlabeled': $scope.filterQuery.unlabeled,
            'unassigned': $scope.filterQuery.unassigned
        };
        $scope.fetchTaskLists($scope.queryString);
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
    };

    $scope.hasLabelAssigned = function(labelList, singleLabel){
        labelList.forEach(function(label){
            if(label.id ==  singleLabel.id){
                singleLabel.checked = true;
            }
        });
        return singleLabel;
    };


    $scope.hasUserAssigned = function(userLists, singleUser){
        userLists.forEach(function(user){
            if(user.id ==  singleUser.id){
                singleUser.checked = true;
            }
        });
        return singleUser;
    };


    $scope.goPreviousPage = function () {
        if($scope.tasks.currentPage > 1){
            $scope.tasks.currentPage = parseInt($scope.tasks.currentPage) - 1;
            $scope.fetchTaskLists({page: $scope.tasks.currentPage});
        }
    };

    $scope.goNextPage = function () {
        var maxPage = parseInt($scope.tasks.count / $scope.tasks.limit);
        if($scope.tasks.currentPage <= maxPage){
            $scope.tasks.currentPage = parseInt($scope.tasks.currentPage) + 1;
            $scope.fetchTaskLists({page: $scope.tasks.currentPage});
        }
    };
});