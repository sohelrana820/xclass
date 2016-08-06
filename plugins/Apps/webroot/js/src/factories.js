app.factory('LabelResources', function ($resource) {

    return $resource(':id', {id: '@id'}, {
        get: {method: 'GET', url: '/labels/:id.json'},
        save: {method: 'POST', 'url': 'labels.json'},
        query: {method: 'GET', 'url': '/labels.json', isArray: false,},
        update: {method: 'PUT', url: 'labels/:id.json'},
        delete: {method: 'DELETE', url: '/labels/:id.json'}
    });
});