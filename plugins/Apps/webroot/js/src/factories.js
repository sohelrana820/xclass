app.factory('LabelResources', function ($resource) {

    return $resource(':id', { id: '@id' }, {
        get: {
            method: 'GET',
            url: '/labels/:id.json'
        },
        save:   {method:'POST', 'url': 'labels.json'},
        query:  {method:'GET', isArray:false, 'url': '/labels.json'},
        update: {method:'PUT'},
        delete: {
            method: 'DELETE',
            url: '/labels/:id.json'
        },
    });
});