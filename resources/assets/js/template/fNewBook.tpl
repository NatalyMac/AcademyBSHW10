
<script type="text/template" id="tpl-new-book">
    <h2 class="page-header text-center"><%- isNew ? 'Create' : 'Edit' %> Book</h2>
    <form role="form" class="form-horizontal contract-form">
        <div class="form-group">
            <label class="col-sm-4 control-label">Genre:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control book-genre-input" value="<%- genre %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Title:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control book-title-input" value="<%- title %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Author:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control book-author-input" value="<%- author %>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Year:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control user-year-input" value="<%- year %>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
                <button type="submit" class="btn btn-outline btn-lg btn-block">Submit</button>
            </div>
            <div class="col-sm-3">
                <a href="#books" class="btn btn-outline btn-lg btn-block">Cancel</a>
            </div>
        </div>
    </form>
</script>