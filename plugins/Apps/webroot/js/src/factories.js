app.factory('LabelResources', function ($resource, BASE_URL) {
    return $resource(':id, :slug', {id: '@id', slug: '@slug'}, {
        get: {method: 'GET', url: BASE_URL +  ':labels/:id.json'},
        save: {method: 'POST', url: BASE_URL +  ':slug/labels/create.json'},
        query: {method: 'GET', url: BASE_URL +  ':slug/labels.json', isArray: false,},
        update: {method: 'PUT', url: BASE_URL +  'labels/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  'labels/:id.json'}
    });
});

app.factory('UsersResources', function ($resource, BASE_URL) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: BASE_URL +  'users/:id.json'},
        save: {method: 'POST', url: BASE_URL +  'users.json'},
        query: {method: 'GET', url: BASE_URL +  'users.json', isArray: false},
        update: {method: 'PUT', url: BASE_URL +  'users/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  'users/:id.json'}
    });
});

app.factory('TasksResources', function ($resource, BASE_URL) {
    return $resource(':id, :slug: :identity', {id: '@id', slug: '@slug', identity: '@identity'}, {
        get: {method: 'GET', url: BASE_URL +  ':slug/tasks/:identity.json'},
        save: {method: 'POST', url: BASE_URL +  ':slug/tasks.json'},
        query: {method: 'GET', url: BASE_URL +  ':slug/tasks.json', isArray: false},
        update: {method: 'PUT', url: BASE_URL +  ':slug/tasks/:id.json'},
        delete: {method: 'DELETE', url: BASE_URL +  ':slug/tasks/:id.json'}
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
        query: {method: 'GET', url: BASE_URL +  ':slug/users.json', isArray: false}
    });
});

app.factory('DashboardResources', function ($resource, BASE_URL) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: BASE_URL +  'dashboard/overview.json'}
    });
});