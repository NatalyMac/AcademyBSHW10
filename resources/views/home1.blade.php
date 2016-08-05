@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-default">
            <div class="panel-heading">eLibrary</div>

            <div class="panel-body">
            Welcome to our eLibrary!
            </div>
        </div>

    <div class="col-xs-12 main-container"></div>
  <!-------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-users">
        <h2 class="page-header text-center">List of users</h2>
        <p class="text-center">
            <a href="#users/new" class="btn btn-lg btn-outline">Add User</a>
        </p>
        <table class="table table-hover table-striped table-bordered users-container">
            <thead>
            <tr>
                <td>FirstName</td>
                <td>LastName</td>
                <td>Email</td>
                <td>Role</td>
                <td colspan="5">Action</td>
            </tr>
            </thead>
        </table>
    </script>
<!------------------------------------------------------------------------>
    <script type="text/template" id="tpl-contact">
        <td><%- firstname %></td>
        <td><%- lastname %></td>
        <td><%- email %></td>
        <td><%- role %></td>
        <td>
            <small>
            <a href="#users/edit/<%- id %>" class ='edit-user'
            ><span class="glyphicon glyphicon-pencil"></span></a>
            </small>
        </td>
        <td>
            <small>
            <a href="#" class="delete-user">
            <span class="glyphicon glyphicon-trash"></span>
            </a>
            </small>
        </td>
        <td>
            <small>
            <a href="#users/<%- id %>/detail">
                <span class="glyphicon glyphicon-folder-open"></span>
            </a>
            </small>
        </td>
    </script>
<!----------------------------------------------------------------------------->
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

<!---------------------------------------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-books">
        <h2 class="page-header text-center">List of books</h2>
        <p class="text-center">
            <a href="#books/new" class="btn btn-lg btn-outline">Add Book</a>
        </p>

        <table class="table table-hover table-striped table-bordered books-container">
            <thead>
            <tr>
                <td>Genre</td>
                <td>Title</td>
                <td>Author</td>
                <td>year</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
        </table>

    </script>
<!-------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-book">
        <td><%- genre %></td>
        <td><%- title %></td>
        <td><%- author %></td>
        <td><%- year %></td>
        <td>
            <small>
                <a href="#books/edit/<%- id %>"><span class="glyphicon glyphicon-pencil"></span></a>
            </small>
        </td>
        <td>
            <small>
                <a href="#" class="delete-book">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </small>

        </td>
    </script>
<!------------------------------------------------------------------------------------->

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
<!----------------------------------------------------------------------------------------->

    <script type="text/template" id="tpl-user-detail">
        <h2 class="page-header text-center">Detail of user</h2>
        <div>
            <div class="panel"> <%- firstname %> </div>
            <div class="panel"> <%- lastname %> </div>
            <div class="panel"> <%- email %> </div>
            <div class="panel"> <%- role %> </div>
            <div class ="detail-container"></div>

            <p class="text-center">
                <a href="#" class=" charge-book btn btn-lg btn-outline">Charge book</a>
            </p>


            <div class = "charge-container"></div>

            <div class="col-sm-3">
                <a href="#users" class="btn btn-outline btn-lg btn-block">Cancel</a>
            </div>

        </div>
    </script>
<!------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-users-books">
        <h2>List of Books</h2>
        <table class="table table-hover table-striped table-bordered users-book-container">
            <thead>
                <tr>
                <td>Genre</td>
                <td>Title</td>
                <td>Author</td>
                <td>Year</td>
                <td>Action</td>
                </tr>
            </thead>
        </table>
    </script>
<!----------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-user-book">
        <td><%- genre %></td>
        <td><%- title %></td>
        <td><%- author %></td>
        <td><%- year %></td>
    <td>
        <small>
            <a href="#">
            <span class="glyphicon glyphicon-import return-book"></span>
            </a>
        </small>
    </td>
    </script>
<!------------------------------------------------------------------------------->
    <script type="text/template" id="tpl-new-charge">
        <form role="form" class="form-horizontal contract-form">

            <div class="form-group">
                <label class="control-label col-sm-2"  for="book">Select a Book:</label>
            <select class =" select-book user-book-input" id="book" name ="book">
                <option></option>
            </select>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-3">
                    <button type="submit" class="btn btn-outline btn-lg btn-block">Submit</button>
                </div>
            </div>
        </form>
    </script>


    </div>
</div>
</div>

@endsection
