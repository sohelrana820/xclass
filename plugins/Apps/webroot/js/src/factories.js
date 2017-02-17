app.factory('LabelResources', function ($resource, BASE_URL) {
    return $resource(':id, :slug', {id: '@id', slug: '@slug'}, {
        save: {method: 'POST', url: BASE_URL +  ':slug/labels/create.json'},
        query: {method: 'GET', url: BASE_URL +  ':slug/labels.json', isArray: false},
        get: {method: 'GET', url: BASE_URL +  'labels/:id.json'},
        update: {method: 'PUT', url: BASE_URL +  'labels/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  'labels/:id.json'}
    });
});

app.factory('UsersResources', function ($resource, BASE_URL) {
    return $resource(':id', {id: '@id'}, {
        save: {method: 'POST', url: BASE_URL +  'users/save.json'},
        query: {method: 'GET', url: BASE_URL +  'users.json', isArray: false},
        email_availability: {method: 'POST', url: BASE_URL +  'users/email_availability.json'},
    });
});

app.factory('TasksResources', function ($resource, BASE_URL) {
    return $resource(':id, :attachment_uuid, :slug :identity', {id: '@id', slug: '@slug', identity: '@identity', attachment_uuid: '@attachment_uuid'}, {
        get: {method: 'GET', url: BASE_URL +  ':slug/tasks/:identity.json'},
        save: {method: 'POST', url: BASE_URL +  ':slug/tasks.json'},
        query: {method: 'GET', url: BASE_URL +  ':slug/tasks.json', isArray: false},
        update: {method: 'PUT', url: BASE_URL +  ':slug/tasks/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  ':slug/tasks/:id.json'},
        removed_attachment: {method: 'GET', url: BASE_URL +  'tasks/remove_attachment/:attachment_uuid.json'}
    });
});

app.factory('CommentsResources', function ($resource, BASE_URL) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: BASE_URL +  'comments/:id.json'},
        save: {method: 'POST', url: BASE_URL +  'comments.json'},
        query: {method: 'GET', url: BASE_URL +  'comments.json', isArray: false},
        update: {method: 'PUT', url: BASE_URL +  'comments/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  'comments/:id.json'}
    });
});

app.factory('ProjectsResources', function ($resource, BASE_URL) {
    return $resource(':id, :slug', {id: '@id', slug: '@slug'}, {
        projects_users: {method: 'GET', url: BASE_URL +  ':slug/users.json', isArray: false},
        query: {method: 'GET', url: BASE_URL + 'projects.json', isArray: false},
        assignUser: {method: 'POST', url: BASE_URL +  ':slug/assign_user.json'},
        removeUser: {method: 'PUT', url: BASE_URL +  ':slug/remove_user.json'}
    });
});

app.factory('FeedsResources', function ($resource, BASE_URL) {
    return $resource(':id, :slug', {id: '@id', slug: '@slug'}, {
        query: {method: 'GET', url: BASE_URL +  ':slug/feeds.json', isArray: false},
        get: {method: 'GET', url: BASE_URL +  'feeds/:id.json'}
    });
});

app.factory('DashboardResources', function ($resource, BASE_URL) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: BASE_URL +  'dashboard/overview.json'}
    });
});