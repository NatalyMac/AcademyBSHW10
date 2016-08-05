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