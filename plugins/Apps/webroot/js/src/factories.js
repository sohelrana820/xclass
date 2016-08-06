app.factory('LabelResources', function ($resource) {

    return $resource(':id', { uuid: '@uuid' }, {
        get:    { method:'GET'},
        save:   {method:'POST', 'url': '/labels/create.json'},
        query:  {method:'GET', isArray:false, 'url': '/labels.json'},
        remove: {method:'DELETE'},
        delete: {method:'DELETE'},
        update: {method:'PUT'}
    });
});