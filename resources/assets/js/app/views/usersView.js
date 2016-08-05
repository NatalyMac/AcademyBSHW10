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
