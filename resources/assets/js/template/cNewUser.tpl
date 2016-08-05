<script type="text/template" id="tpl-new-contact">
    <h2 class="page-header text-center"><%- isNew ? 'Create' : 'Edit' %> User</h2>
    <form role="form" class="form-horizontal contract-form">
        <div class="form-group">
            <label class="col-sm-4 control-label">Firstname:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control user-firstname-input" value="<%- firstname %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Lastname:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control user-lastname-input" value="<%- lastname %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Email address:</label>
            <div class="col-sm-6">
                <input type="email" class="form-control user-email-input" value="<%- email %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Password:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control user-password-input" value="<%- password %>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2"  for="role">Role:</label>
            <select class ="user-role-input" id="role" name ="role">
                <option>reader</option>
                <option>admin</option>
            </select>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
                <button type="submit" class="btn btn-outline btn-lg btn-block">Submit</button>
            </div>
            <div class="col-sm-3">
                <a href="#users" class="btn btn-outline btn-lg btn-block">Cancel</a>
            </div>
        </div>
    </form>
</script>