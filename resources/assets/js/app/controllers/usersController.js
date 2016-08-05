
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
