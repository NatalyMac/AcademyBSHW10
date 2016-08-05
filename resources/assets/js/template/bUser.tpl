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