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

