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

