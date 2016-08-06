app.factory('LabelResources', function ($resource) {

    return $resource(':id', { id: '@id' }, {
        get:    { method:'GET'},
        save:   {method:'POST', 'url': '/labels/create.json'},
        query:  {method:'GET', isArray:false, 'url': '/labels.json'},
        update: {method:'PUT'},
        delete: {
            method: 'DELETE',
            url: '/labels/delete/:id'
        }
    });
});