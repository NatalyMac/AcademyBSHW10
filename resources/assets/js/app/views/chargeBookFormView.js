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
