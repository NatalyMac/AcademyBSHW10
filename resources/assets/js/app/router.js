
var BooksController = require('./controllers/booksController.js').BooksController;
var UsersController = require('./controllers/usersController.js').UsersController;

exports.AppRouter = Backbone.Router.extend({
    routes: {
        ''                   : 'home',
        'users'              : 'showUsers',
        'users/new'          : 'newUser',
        'users/edit/:id'     : 'editUser',
        'users/:id/detail'   : 'userDetail',
        'books'              : 'showBooks',
        'books/new'          : 'newBook',
        'books/edit/:id'     : 'editBook'
    },

    home :function() {
        router.navigate('', {
            trigger: true,
            replace: true
        });
    },

    showUsers : function() {
        var userController = new UsersController();
        userController.showUsers();
    },

    newUser : function() {
        var userController = new  UsersController();
        userController.newUser();
    },

    editUser : function(id) {
        var userController =  new UsersController();
        userController.editUser(id);
    },

    userDetail : function(id) {
        var userController =  new UsersController();
        userController.userDetail(id);
    },

    showBooks : function() {
        var bookController =  new BooksController();
        bookController.showBooks();
    },

    newBook : function() {
        var bookController = new BooksController();
        bookController.newBook();
    },

    editBook : function(id) {
        var bookController = new BooksController();
        bookController.editBook(id);
    }
});
