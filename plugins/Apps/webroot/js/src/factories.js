app.factory('LabelResources', function ($resource) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: '/labels/:id.json'},
        save: {method: 'POST', 'url': 'labels.json'},
        query: {method: 'GET', 'url': '/labels.json', isArray: false,},
        update: {method: 'PUT', url: 'labels/:id.json'},
        delete: {method: 'DELETE', url: '/labels/:id.json'}
    });
});

app.factory('UsersResources', function ($resource) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: '/users/:id.json'},
        save: {method: 'POST', 'url': 'users.json'},
        query: {method: 'GET', 'url': '/users.json', isArray: false},
        update: {method: 'PUT', url: 'users/:id.json'},
        delete: {method: 'DELETE', url: '/users/:id.json'}
    });
});

app.factory('TasksResources', function ($resource) {
    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: '/tasks/:id.json'},
        save: {method: 'POST', 'url': '/tasks.json'},
        query: {method: 'GET', 'url': '/tasks.json', isArray: false},
        update: {method: 'PUT', url: 'tasks/:id.json'},
        delete: {method: 'DELETE', url: '/tasks/:id.json'}
    });
});