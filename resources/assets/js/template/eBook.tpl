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