<?php 
error_reporting(0);
session_start();

if (empty($_SESSION['email'])) {
  echo '<script>alert("anda harus login");window.location = "../../../index.php";</script>';
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="modules/login/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="modules/login/css/form-validation.css">



</head>

<body class="bg-light">
    <div class="container p-3">
        <p><button type="button" class="btn btn-outline-primary btn-add" data-toggle="modal" data-target="#mightywebModal">Insert Record</button></p>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data login</h3>
            </div>
            <div class="card-body">
                <?php include("connection.php");
                $sql = "SELECT * FROM login";
                $result = $conn->query($sql); ?>
                <table id="dataMightyWeb">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?><tr>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["level"]; ?></td>
                                <td><a class="btn btn-sm btn-outline-primary" href='javascript:getData("<?php echo $row["id_login"]; ?>")'>Edit</i></a>
                                    <a class="btn btn-sm btn-outline-warning" href="modules/login/actions.php?act=delete&id_login=<?php echo $row["id_login"]; ?>">Delete</a>
                                </td>
                            </tr><?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include("input.php"); ?>

    </div>
    <script src="modules/login/js/jquery.min.js"></script>
    <script src="modules/login/js/bootstrap.min.js"></script>
    <script src="modules/login/plugins/datatables-bs4/js/jquery.dataTables.min.js"></script>
    <script src="modules/login/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>




    <script>
        $(".btn-add").click(function() {
            $("#mightywebForm").attr("action", "modules/login/actions.php?act=insert");
        });

        function getData(ID) {
            $("#mightywebModal").modal("show");
            $('#mightywebForm').attr('action', 'modules/login/actions.php?act=update&id_login=' + ID + '');
            var id = ID;
            $.ajax({
                type: "POST",
                url: "modules/login/actions.php?act=show",
                data: "id_login=" + id,
                dataType: "json",
                success: function(data) {
                    $('input[name="email"]').val(data.email);
                    $('input[name="password"]').val(data.password);
                    $('input[name="level"]').each(function() {
                        if ($(this).val() == data.level) {
                            $(this).prop("checked", true);
                        }
                    });


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
</body>

</html>