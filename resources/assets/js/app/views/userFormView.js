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


