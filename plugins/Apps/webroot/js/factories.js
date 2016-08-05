app.factory('LabelResources', function ($resource) {
    var endpoint = '/labels';

    return $resource(endpoint+'/:id', { uuid: '@uuid' }, {
        get:    { method:'GET'},
        save:   {method:'POST'},
        query:  {method:'GET', isArray:false},
        remove: {method:'DELETE'},
        delete: {method:'DELETE'},
        update: {method:'PUT'}
    });
});