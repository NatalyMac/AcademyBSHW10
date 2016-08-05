//$        = require('jquery');
//_        = require('underscore');
//Backbone = require('backbone');

var Book   = require('./models/bookModel.js').Book;
var User   = require('./models/userModel.js').User;
var Books  = require('./collections/booksCollection.js').Books;
var Users  = require('./collections/usersCollection.js').Users;
var AppRouter = require('./router.js').AppRouter;

$(function() {
        user = new User();
        users = new Users({model:new User()});
        users.fetch();

        book = new Book();
        books = new Books({model:book});
        books.fetch();
        router = new AppRouter();

        Backbone.history.start();
});
