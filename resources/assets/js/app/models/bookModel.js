
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

        if (!($.trim(attrs.genre))){
            return 'The field is required';
        }
        if (!($.trim(attrs.author))){
            return 'The field is required';
        }
        if (!($.trim(attrs.title))){
            return 'The field is required';
        }
        if (!($.trim(attrs.year))){
            return 'The field is required';
        }

        if (!alpha.test(attrs.genre) || !alpha.test(attrs.author)) {
            return "Should be only alpha";
        }

        if (!number.test(attrs.year)) {
            return "Should be numbers";
        }
    }
});


