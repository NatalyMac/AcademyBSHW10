exports.Users = Backbone.Collection.extend({

    model: require('../models/userModel').User,

    url: 'index.php/api/users'});

