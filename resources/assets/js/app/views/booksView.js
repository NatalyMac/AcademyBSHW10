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

