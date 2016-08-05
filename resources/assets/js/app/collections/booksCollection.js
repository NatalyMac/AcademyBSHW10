
exports.Books = Backbone.Collection.extend({

    model: require('../models/bookModel').Book,

    url: 'index.php/api/books'});