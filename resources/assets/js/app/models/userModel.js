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



