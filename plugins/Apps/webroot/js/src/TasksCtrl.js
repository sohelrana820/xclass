app.controller('TasksCtrl', function($scope, $location, LabelResources, UsersResources, ProjectsResources, TasksResources, DashboardResources, CommentsResources, Flash, toastr, SweetAlert, $timeout, BASE_URL, Upload){
    $scope.BASE_URL = BASE_URL;

    $scope.taskView= 'list';
    $scope.switchTaskView = function (viewMode) {
        $scope.taskView = viewMode;
    };

    $scope.TaskObj = {};
    $scope.action_on_label = null;
    $scope.action_on_user = null;

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

    var urlDivider = window.location.href.split("/tasks");
    urlDivider = urlDivider[0].split("/");
    var projectSlug = urlDivider[urlDivider.length - 1];
    projectSlug = decodeURIComponent(projectSlug);

    var taskIdentity = window.location.href.split('/tasks/');
    var taskIdentity = parseInt(taskIdentity[1]);


    function getQueryParams(queryParam, url) {
        var pageUrl = url || window.location.search.substring(1);
        var urlVariables = pageUrl.split(/[&||?]/);
        var response = null;

        for (var i = 0; i < urlVariables.length; i += 1) {
            var param = urlVariables[i];
            var paramName = (param || '').split('=');

            if (paramName[0] === queryParam) {
                response = paramName[1];
            }
        }

        return response;
    }

    var commentUuid = window.location.href.split("#/");
    if(commentUuid.length > 1)
    {
        commentUuid = commentUuid[1];
    }else{
        commentUuid = null;
    }
    $scope.commentUuid = commentUuid;

    $scope.newTask = getQueryParams('new');
    if($scope.newTask == 'true'){
        $scope.taskView= 'create';
    }

    /**
     * Creating new tasks
     */
    $scope.saveTask = function(){
        $scope.getTaskRelObj();
        if($scope.TaskObj.task){
            $scope.save_task_loader = true;
            $scope.show_center_loader = true;
            Upload.upload({
                url: BASE_URL + projectSlug +'/tasks/create.json',
                data: $scope.TaskObj
            }).then(function (response) {
                if(response.data.result.success){
                    $timeout(function () {
                        $scope.TaskObj = {};
                        $scope.taskLabels = [];
                        $scope.taskUsers = [];
                        $scope.save_task_loader = false;
                        $scope.show_center_loader = false;
                        $scope.labels.forEach(function(label, key){
                            $scope.labels[key].checked = false;
                        });
                        $scope.users.forEach(function(user, key){
                            $scope.users[key].checked = false;
                        });
                        $scope.countAttachments = [0];
                        toastr.success(response.data.result.message);
                        $scope.fetchTaskLists({});
                        $scope.taskView = 'list';
                    }, 1000)
                }
                else{
                    $scope.show_center_loader = false;
                    toastr.error(response.data.result.message);
                }
            });
        }
        else{
            toastr.error('Task title can not be empty');
        }
    };


    /**
     * Creating new tasks
     */
    $scope.viewTask = function(data){
        var taskDetails = TasksResources.get(data).$promise;
        taskDetails.then(function (res) {
            if (res.result.success) {
                console.log(res.result.data);
                $scope.TaskObj = {};
                $scope.TaskObj.id = res.result.data.id;
                $scope.TaskObj.task = res.result.data.task;
                $scope.TaskObj.description = res.result.data.description;
                $scope.TaskObj.status = res.result.data.status;
                $scope.TaskObj.created = res.result.data.created;
                $scope.TaskObj.createdUserProfile = res.result.data.createdUserProfile;
                $scope.TaskObj.createdUser = res.result.data.createdUser;
                $scope.taskUsers = res.result.data.users;
                $scope.taskLabels = res.result.data.labels;
                $scope.taskComments = res.result.data.comments;
                $scope.taskAttachments = res.result.data.attachments;
            }
            else {
                toastr.error(res.result.message);
            }
        });
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
        data.slug = projectSlug;
        var users = ProjectsResources.projects_users(data).$promise;
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

    /**
     *Getting application active users.
     */
    $scope.fetchUserLists({'limit': 5});

    /**
     * Getting application tasks.
     */
    $scope.fetchTaskLists = function(data){
        data.slug = projectSlug;
        $scope.show_center_loader = true;
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
                    $scope.show_center_loader = false;
                    $scope.task_loader = true;
                }, 1000);
            }

        });
    };

    /**
     * Getting application active label list.
     */
    $scope.fetchLabelLists = function(data){
        data.slug = projectSlug;
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

    $scope.fetchLabelLists({status: 1, 'limit': 5});

    $scope.taskLabels = [];
    $scope.chooseTaskLabels = function(label, key, isChecked){
        $scope.action_on_label = label;
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
        $scope.action_on_label = label;
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
        $scope.fetchLabelLists({status: 1, 'limit': 5, name: query});
    };

    $scope.refreshLabelList = function(query){
        $scope.fetchLabelLists({status: 1, 'limit': 5});
        $scope.label_query = null;
        $scope.show_label_search_loader = false;
        $scope.show_label_refresh_loader = true;
    };

    $scope.LabelObj = {color_code: '#C00C00'};
    $scope.saveLabel = function(isValid, assignLabel){
        if($scope.LabelObj.name != undefined && $scope.LabelObj.name){
            $scope.show_label_create_loader = isValid;
            $scope.isLabelFormSubmitted = true;
            $scope.LabelObj.slug = projectSlug;
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
                            $scope.action_on_label = res.result.data;
                            $scope.quickUpdate('label_event', true)
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
        $scope.action_on_user = user;
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
        $scope.action_on_user = user;
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
        $scope.fetchUserLists({name: query, 'limit': 5});
    };

    $scope.refreshUserList = function(query){
        $scope.fetchUserLists({'limit': 5});
        $scope.user_query = null;
        $scope.show_user_refresh_loader = true;
        $scope.show_user_search_loader = false;
    };



    if(taskIdentity)
    {
        $scope.viewTask({slug: projectSlug, identity: taskIdentity});
    }
    else{
        $scope.fetchTaskLists({});
    }

    $scope.updateTask = function(){
        $scope.update_task_loader = true;
        $scope.show_center_loader = true;
        $scope.getTaskRelObj();
        var task = TasksResources.update($scope.TaskObj).$promise;
        task.then(function (res) {
            $timeout(function () {
                if(res.result.success){
                    $scope.update_task_loader = false;
                    $scope.show_center_loader = false;
                    $scope.view_task = true;
                    $scope.edit_task_form = false;
                    toastr.success(res.result.message);
                }
                else{
                    $scope.show_center_loader = false;
                    toastr.error(res.result.message);
                }
            }, 1000)
        });
    };

    $scope.quickUpdate = function(event, value){

        $scope.getTaskRelObj();
        $scope.TaskObj.edit_type = event;
        $scope.TaskObj.edit_status = value;
        $scope.TaskObj.action_on_label = $scope.action_on_label;
        $scope.TaskObj.action_on_user = $scope.action_on_user;

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
                        toastr.success('Task has been marked as closed');
                    }
                    else if(value == 3){
                        toastr.error('Task has been reopened');
                    }
                }
            }
        });
    };

    $scope.commentsObj = {};
    $scope.doComment = function(){
        $scope.commentsObj.task_id = $scope.TaskObj.id;
        if($scope.commentsObj.comment)
        {
            $scope.task_quick_update_loader = true;
            $scope.show_center_loader = true;
            Upload.upload({
                url: BASE_URL + 'comments/add.json',
                data: $scope.commentsObj
            }).then(function (response) {
                $timeout(function () {
                    if(response.data.result.success){
                        $scope.task_quick_update_loader = false;
                        $scope.show_center_loader = false;
                        $scope.commentsObj = {task_id: $scope.TaskObj.id};
                        $scope.taskComments.push(response.data.result.data);
                        toastr.success(response.data.result.message);
                        $scope.countAttachments = [0];
                    }
                    else{
                        $scope.show_center_loader = false;
                        toastr.success(response.data.result.message);
                    }
                }, 1000)
            });
        }
        else{
            toastr.error('Write something in comments');
        }
    };

    $scope.updateComment = function(){
        if($scope.editCommentObj.comment)
        {
            $scope.task_quick_update_loader = true;
            $scope.show_center_loader = true;
            console.log($scope.editCommentObj);
            Upload.upload({
                url: BASE_URL + 'comments/edit.json',
                data: $scope.editCommentObj
            }).then(function (response) {
                $timeout(function () {
                    console.log(response.data.result.data);
                    if(response.data.result.success){
                        $scope.task_quick_update_loader = false;
                        $scope.show_center_loader = false;
                        $scope.open_comment_for = false;
                        toastr.success(response.data.result.message);
                        $scope.taskComments[$scope.editCommentObj.comment_key] = response.data.result.data;
                        $scope.countAttachments = [0];
                        console.log()
                    }
                    else{
                        $scope.show_center_loader = false;
                        toastr.success(response.data.result.message);
                    }
                }, 1000)
            });
        }
        else{
            toastr.error('Write something in comments');
        }
    };

    $scope.deleteComment = function(commentKey, comment){
        $scope.show_center_loader = true;
        SweetAlert.swal({
                title: "Are you sure?",
                text: "You want to delete this comment",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var removeComment = CommentsResources.delete({id: comment.id}).$promise;
                    removeComment.then(function (res) {
                        $timeout(function () {
                            if(res.result.success){
                                $scope.show_center_loader = false;
                                toastr.warning(res.result.message);
                                delete $scope.taskComments[commentKey];
                            }
                            else{
                                $scope.show_center_loader = false;
                                toastr.error(res.result.message);
                            }
                        }, 1000)
                    });
                }
            });
    };

    $scope.changeStatus = function(status){
        $scope.task_quick_update_loader = true;
        $scope.show_center_loader = true;
        $scope.TaskObj.status = status;
        $scope.commentsObj.task_id = $scope.TaskObj.id;
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
                $scope.task_quick_update_loader = false;
                $scope.show_center_loader = false;
                $scope.commentsObj = {task_id: $scope.TaskObj.id};
                $scope.taskComments.push(response.data.result.data);
                toastr.success(response.data.result.message);
                $scope.countAttachments = [0];
            }
            else{
                $scope.show_center_loader = false;
                toastr.success(response.data.result.message);
            }
        });
    };

    $scope.removeTaskAttachment = function(uuid){
        var task = TasksResources.removed_attachment({attachment_uuid: uuid}).$promise;
        task.then(function (res) {
            $timeout(function () {
                if(res.result.success){
                    $scope.taskAttachments = $scope.taskAttachments.filter(function (attachment) {
                        return attachment.uuid != uuid;
                    })
                    toastr.success(res.result.message);
                }
                else{
                    toastr.error(res.result.message);
                }
            }, 1000)
        });
    };

    $scope.removeCommentAttachment = function(commentKey, uuid){
        var task = TasksResources.removed_attachment({attachment_uuid: uuid}).$promise;
        task.then(function (res) {
            $timeout(function () {
                if(res.result.success){
                    $scope.taskComments[commentKey].attachments = $scope.taskComments[commentKey].attachments.filter(function (attachment) {
                        return attachment.uuid != uuid;
                    });
                    toastr.success(res.result.message);
                }
                else{
                    toastr.error(res.result.message);
                }
            }, 1000)
        });
    };

    $scope.open_comment_for = false;
    $scope.openCommentEditForm = function(key, comment){
        $scope.open_comment_for = true;
        $scope.editCommentObj = {
            id: comment.id,
            task_id: comment.task_id,
            comment: comment.comment,
            comment_key: key
        };
    };

    /**
     *
     * @param id
     */
    $scope.deleteTask = function(id){
        SweetAlert.swal({
                title: "Are you sure?",
                text: "You want to delete this task",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
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
        $scope.queryString.slug = projectSlug;
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

    $scope.userObj = {};
    $scope.createUser = function () {
        $scope.createUserSubmitted = true;
        $scope.show_center_loader = true;
        $scope.show_user_create_loader = true;
        var user = UsersResources.save($scope.userObj).$promise;
        user.then(function (res) {
            if (res.result.success) {
                toastr.success(res.result.message);
                $timeout(function () {
                    $scope.userObj = {};
                    $scope.assignProjectUser(res.result.data.id);

                    $scope.createUserForm.$setPristine();
                    $scope.users.unshift(res.result.data);

                    $scope.users.forEach(function(user,key){
                        if(user.id == res.result.data.id){
                            $scope.users[key].checked = true;
                        }
                    });
                    $scope.taskUsers.push(res.result.data);

                    $scope.createUserSubmitted = false;
                    $scope.show_center_loader = false;
                    $scope.show_user_create_loader = false;
                    $scope.show_create_new_user_form = false;
                }, 500);
            }
            else {
                $scope.show_center_loader = false;
                toastr.error(res.result.message);
                $scope.createUsersErrors = res.result.error_message;
            }
        })
    };

    $scope.assignProjectUser = function (userId) {
        var isUsersAssigned = ProjectsResources.assignUser({user_id: userId, slug: projectSlug}).$promise;
        isUsersAssigned.then(function (res) {
            if(res.result.success){
                $scope.user_query = null;
                toastr.success(res.result.message);
            }
            else{
                toastr.error(res.result.message);
            }
        });
    };
});