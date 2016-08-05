(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

exports.Books = Backbone.Collection.extend({

    model: require('../models/bookModel').Book,

    url: 'index.php/api/books'});
},{"../models/bookModel":6}],2:[function(require,module,exports){
exports.Users = Backbone.Collection.extend({

    model: require('../models/userModel').User,

    url: 'index.php/api/users'});


},{"../models/userModel":7}],3:[function(require,module,exports){
var BooksView      = require('../views/booksView.js').BooksView;
var BookFormView   = require('../views/bookFormView.js').BookFormView;
var Book           = require('../models/bookModel.js').Book;


exports.BooksController = Backbone.Router.extend({

    showBooks :function() {
        var booksView = new BooksView({
            collection: books
        });
        console.log('show');
        booksView.render();
        $('.main-container').html(booksView.render().$el);
    },

    newBook :function() {
        var newBookForm = new BookFormView({
            model: new Book()
        });

        newBookForm.on('form:submitted', function(attrs) {
            console.log(attrs);

            var book = new Book();
            book.set(attrs);

            if (book.isValid()) {
                books.create(attrs);
                alert('Added succesfully');
                router.navigate('books', true);

            }else{
                alert(book.validationError);
            }
        });
        $('.main-container').html(newBookForm.render().$el);
    },

    editBook :function(id) {
        var book = books.get(id),
            editBookForm;

        if (book) {
            editBookForm = new BookFormView({
                model: book
            });

            editBookForm.on('form:submitted', function(attrs) {
                book.set(attrs);

                if (book.isValid()) {
                    book.save();
                    alert('Edit succesfully');
                    router.navigate('users', true);

                }else {
                    alert(book.validationError);
                }
            });
            $('.main-container').html(editBookForm.render().$el);
        } else {
            router.navigate('books', true);
        }
    }

});


},{"../models/bookModel.js":6,"../views/bookFormView.js":9,"../views/booksView.js":11}],4:[function(require,module,exports){

var UsersView      = require('../views/usersView.js').UsersView;
var UserFormView   = require('../views/userFormView.js').UserFormView;
var UserDetailView = require('../views/userDetailView.js').UserDetailView;
var User           = require('../models/userModel.js').User;

exports.UsersController = Backbone.Router.extend({

    showUsers: function () {
        var usersView = new UsersView({
            collection: users
        });
        usersView.render();
        $('.main-container').html(usersView.render().$el);
    },

    newUser :function() {
        var newUserForm = new UserFormView({
            model: new User()
        });
        console.log(newUserForm);

        newUserForm.on('form:submitted', function (attrs) {
            console.log(attrs);

            var user = new User();
            user.set(attrs);

            if (user.isValid()) {
                users.create(attrs);
                alert('Added succesfully');
                router.navigate('users', true);

            } else {
                alert(user.validationError);

            }
        });
        $('.main-container').html(newUserForm.render().$el);
    },

    editUser : function(id) {
        var user = users.get(id),
            editUserForm;

        if (user) {
            editUserForm = new UserFormView({
                model: user
            });

            editUserForm.on('form:submitted', function(attrs) {
                user.set(attrs);

                if (user.isValid()) {
                    user.save();
                    alert('Edit succesfully');
                    router.navigate('users', true);
                }else {
                    alert(user.validationError);
                }
            });

            $('.main-container').html(editUserForm.render().$el);

        } else {
            router.navigate('users', true);
        }
    },
    
    userDetail :function(id) {
        var user = users.get(id),
            detailUserForm;

        if (user) {
            detailUserForm = new UserDetailView({
                model: user
            });
            $('.main-container').html(detailUserForm.render().$el);

        } else {
            router.navigate('users', true);
        }
    }
});

},{"../models/userModel.js":7,"../views/userDetailView.js":13,"../views/userFormView.js":14,"../views/usersView.js":18}],5:[function(require,module,exports){
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

},{"./collections/booksCollection.js":1,"./collections/usersCollection.js":2,"./models/bookModel.js":6,"./models/userModel.js":7,"./router.js":8}],6:[function(require,module,exports){

exports.Book = Backbone.Model.extend({

    urlRoot: 'index.php/api/books',

    defaults: {
        genre: '',
        author:'',
        title:'',
        year:'',
        created_at:'',
        id: null
    },

    validate: function (attrs) {

        var alpha = /[a-zA-zа-яА-Я]+/i;
        var number = /[0-9]+/i;

        if (!$.trim(attrs.gerne) || !$.trim(attrs.author) || !$.trim(attrs.title)) {
            return 'The field is required';
        }

        if (!alpha.test(attrs.gerne) || !alpha.test(attrs.author)) {
            return "Should be only alpha";
        }

        if (!number.test(attrs.year)) {
            return "Should be numbers";
        }
    }
});


},{}],7:[function(require,module,exports){
var Books  = require('../collections/booksCollection.js').Books;

exports.User = Backbone.Model.extend({

    urlRoot: 'index.php/api/users',

    defaults: {
        firstname: '',
        lastname:'',
        role:'reader',
        password:'',
        email:'',
        created_at:'',
        updated_at:'',
        is_active:1,
        id : null
    },

    validate: function (attrs) {

        var email_pat = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i;
        var alpha = /[a-zA-zа-яА-Я]+/i;

        if (!$.trim(attrs.firstname) || !$.trim(attrs.lastname) || !$.trim(attrs.email)) {
            return 'The field is required';
        }

        if (!alpha.test(attrs.firstname) || !alpha.test(attrs.lastname)) {
            return "Should be only alpha";
        }

        if (!email_pat.test(attrs.email)) {
            return "Should be correct email";
        }
    },

    initialize: function() {
        this.books = new Books();
        this.books.url = 'index.php/api/users/' + this.id + '/books';
        this.books.on("reset", this.updateCounts);
    }
});




},{"../collections/booksCollection.js":1}],8:[function(require,module,exports){

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

},{"./controllers/booksController.js":3,"./controllers/usersController.js":4}],9:[function(require,module,exports){
exports.BookFormView = Backbone.View.extend({

    template: _.template($ ('#tpl-new-book').html() ),

    events: {
        'submit .contract-form': 'onFormSubmit'
    },

    render: function() {
        var html = this.template(_.extend(this.model.toJSON(), {
            isNew: this.model.isNew()
        }));
        this.$el.append(html);
        return this;
    },

    onFormSubmit: function(e) {
        e.preventDefault();

        this.trigger('form:submitted', {
            genre: this.$('.book-genre-input').val(),
            title: this.$('.book-title-input').val(),
            author: this.$('.book-author-input').val(),
            year: this.$('.book-year-input').val()
        });
    }
});


},{}],10:[function(require,module,exports){
exports.BookView = Backbone.View.extend({
    tagName: 'tr',
    template: _.template($('#tpl-book').html()),

    events: {
        'click .delete-book': 'onClickDelete'
    },

    initialize: function() {
        this.listenTo(this.model, 'remove', this.remove);
    },

    render: function() {
        var html = this.template(this.model.toJSON());
        this.$el.append(html);
        return this;
    },

    onClickDelete: function(e) {
        e.preventDefault();

        this.model.collection.remove(this.model);

        if (this.model.destroy()){
            alert('Deleted succesfully');
        }

    }
});


},{}],11:[function(require,module,exports){
var BookView =  require('./bookView.js').BookView;

exports.BooksView = Backbone.View.extend({

    template: _.template($('#tpl-books').html()),

    initialize: function() {
        this.collection.on('add', this.renderOne, this );
    },

    renderOne: function(book) {
        var itemView = new BookView({model: book});
        this.$('.books-container').append(itemView.render().$el);
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);
        this.collection.each(this.renderOne, this);
        return this;
    }
});


},{"./bookView.js":10}],12:[function(require,module,exports){
var UserBookView = require('./userbookView.js').UserBookView;

exports.ChargeBookFormView = Backbone.View.extend({

    template: _.template($ ('#tpl-new-charge').html() ),

    events: {
        'submit .contract-form': 'onFormSubmit'
    },

    render: function() {

        var html = this.template(this.model.toJSON());
        this.$el.append(html);
        books.each(this.renderOneBook, this);
        return this;
    },

    onFormSubmit: function(e) {
        e.preventDefault();

        this.trigger('form:submitted', {
            id: this.$('.user-book-input').val()
            //TODO
        });
    },

    renderOneBook: function(book) {
        console.log('select');
        var itemView = new UserBookView({model: book, tagName: 'option'});
        console.log(book);
        this.$('.select-book').append(itemView.render().$el);
    }

});

},{"./userbookView.js":16}],13:[function(require,module,exports){
var ChargeBookFormView = require('./chargeBookFormView.js').ChargeBookFormView;
var Books              = require('../collections/booksCollection.js').Books;
var Book               = require('../models/bookModel.js').Book;
var UserBooksView      = require('./userbooksView.js').UserBooksView;

exports.UserDetailView = Backbone.View.extend({
    tagName: 'div',
    
    template: _.template($('#tpl-user-detail').html()),

    events: {
        'click .charge-book': 'onClickChargeBook'
    },


    initialize: function() {
        this.model.books.on('add', this.renderOne, this );

    },

    onClickChargeBook: function(e) {
        e.preventDefault();

        var chargeView = new ChargeBookFormView({model: this.model});
        //this.$el.append(chargeView.render().$el);
        $('.charge-container').html(chargeView.render().$el);

        chargeView.on('form:submitted', function (attrs) {
            console.log('test');
            console.log(attrs);
            //TODO rest request
            chargeView.remove();
        });
    },
    
    render: function() {

        var html = this.template(this.model.toJSON());

        this.$el.append(html);

        this.model.books.fetch().then(function(books){
            var collbooks = new Books(new Book);
            collbooks.set(books);
            var userBooksView = new UserBooksView({collection : collbooks});
            $('.detail-container').html(userBooksView.render().$el);
        });return this;
    }
});

},{"../collections/booksCollection.js":1,"../models/bookModel.js":6,"./chargeBookFormView.js":12,"./userbooksView.js":17}],14:[function(require,module,exports){
exports.UserFormView = Backbone.View.extend({

    
    template: _.template($ ('#tpl-new-contact').html() ),

    events: {
        'submit .contract-form': 'onFormSubmit'
    },

    render: function() {

        var html = this.template(_.extend(this.model.toJSON(), {
            isNew: this.model.isNew()
        }));

        this.$el.append(html);
        return this;
    },

    onFormSubmit: function(e) {
        e.preventDefault();

        this.trigger('form:submitted', {
            firstname: this.$('.user-firstname-input').val(),
            lastname: this.$('.user-lastname-input').val(),
            email: this.$('.user-email-input').val(),
            password: this.$('.user-password-input').val(),
            role: this.$('.user-role-input').val()
        });
    }
});



},{}],15:[function(require,module,exports){
exports.UserView = Backbone.View.extend({
   
    tagName: 'tr',
    template: _.template($('#tpl-contact').html()),

    events: {
        'click .delete-user': 'onClickDelete'
    },

    initialize: function() {
        this.listenTo(this.model, 'remove', this.remove);
    },

    render: function() {
        var html = this.template(this.model.toJSON());
        this.$el.append(html);
        return this;
    },

    onClickDelete: function(e) {
        e.preventDefault();

        this.model.collection.remove(this.model);

        if (this.model.destroy()){
            alert('Deleted succesfully');
        }
    }
});

},{}],16:[function(require,module,exports){
exports.UserBookView = Backbone.View.extend({
    tagName: 'tr',
    template: _.template($('#tpl-user-book').html()),

    events: {
        'click .return-book': 'onClickReturn',
    },

    initialize: function() {
        this.listenTo(this.model, 'remove', this.remove);
    },
    
    render: function() {
        var html = this.template(this.model.toJSON());
        this.$el.append(html);
        return this;
    },

    onClickReturn: function(e) {
        e.preventDefault();
        var user_id = this.model.attributes.pivot.user_id;
        this.model.urlRoot = 'index.php/api/users/' + user_id + '/books';
        this.model.collection.remove(this.model);
        if (this.model.destroy()){
            alert('Returned succesfully');
        }
    }
});


},{}],17:[function(require,module,exports){
var UserBookView = require('./userbookView.js').UserBookView;

exports.UserBooksView = Backbone.View.extend({

    template: _.template($('#tpl-users-books').html()),

    initialize: function() {
        this.collection.on('add', this.renderOne, this );
    },

    renderOne: function(book) {
        var itemView = new UserBookView({model: book});
        console.log('one');
        this.$('.users-book-container').append(itemView.render().$el);
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);
        this.collection.each(this.renderOne, this);
        return this;
    }
});


},{"./userbookView.js":16}],18:[function(require,module,exports){
var UserView=require('./userView.js').UserView;

exports.UsersView = Backbone.View.extend({

    template: _.template($('#tpl-users').html()),

    initialize: function() {
        this.collection.on('add', this.renderOne, this );
    },

    renderOne: function(user) {
        var itemView = new UserView({model: user});
        this.$('.users-container').append(itemView.render().$el);
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);
        console.log('hhh');
        this.collection.each(this.renderOne, this);
        return this;
    }
});

},{"./userView.js":15}]},{},[5,8]);
