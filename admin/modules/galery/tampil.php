<?php include("connection.php");
$sql = "SELECT * FROM galery";
$result = $conn->query($sql); ?>
<table id="dataMightyWeb">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Deskripsi</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?><tr>
                <td><?php echo $row["photo"]; ?></td>
                <td><?php echo $row["deskripsi"]; ?></td>
                <td><a class="btn btn-sm btn-outline-primary" href='javascript:getData("<?php echo $row["id_galery"]; ?>")'>Edit</i></a>
                    <a class="btn btn-sm btn-outline-warning" href='javascript:delData("<?php echo $row["id_galery"]; ?>")'>Delete</a>
                </td>
            </tr><?php } ?>
    </tbody>
</table>
<script>
    $(".btn-add").click(function() {
        $("#mightywebForm").attr("action", "modules/galery/actions.php?act=insert");
    });

    function getData(ID) {
        $("#mightywebModal").modal("show");
        $('#mightywebForm').attr('action', 'modules/galery/actions.php?act=update&id_galery=' + ID + '');
        var id = ID;
        $.ajax({
            type: "POST",
            url: "modules/galery/actions.php?act=show",
            data: "id_galery=" + id,
            dataType: "json",
            success: function(data) {
                $('input[name="photo"]').removeAttr("required");
                $('textarea[name="deskripsi"]').val(data.deskripsi);


                return false;
            }
        });
    }
    $("#mightywebModal").on("hidden.bs.modal", function(e) {
        $(this).find("form").trigger("reset");
        $("input[type=file]").attr("required", "required");
    });
    (function() {
        "use strict";
        window.addEventListener("load", function() {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener("submit", function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                }, false);
            });
        }, false);
    })();
    $(function() {
        $("#dataMightyWeb").addClass("table table-hover table-bordered ");
        var table = $("#dataMightyWeb").DataTable({
            "searching": true,
            "paging": true,
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'Show all']
            ],
            "ordering": true,
            "info": true,
        });



    });
</script>