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

