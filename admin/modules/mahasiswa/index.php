<?php
session_start();

if (empty($_SESSION['email'])) {
  echo '<script>alert("anda harus login");window.location = "../../../index.php";</script>';
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="modules/mahasiswa/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="modules/mahasiswa/css/form-validation.css">
    <link rel="stylesheet" href="modules/mahasiswa/plugins/buttons-export/css/buttons.dataTables.min.css">


</head>

<body class="bg-light">
    <div class="container p-3">
        <p><button type="button" class="btn btn-outline-primary btn-add" data-toggle="modal" data-target="#mightywebModal">Insert Record</button></p>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data mahasiswa</h3>
            </div>
            <div class="card-body">
                <?php include("connection.php");
                $sql = "SELECT * FROM mahasiswa";
                $result = $conn->query($sql); ?>
                <table id="dataMightyWeb">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?><tr>
                                <td><?php echo $row["nama_lengkap"]; ?></td>
                                <td><?php echo $row["alamat"]; ?></td>
                                <td><?php echo $row["jenis_kelamin"]; ?></td>
                                <td><?php echo $row["photo"]; ?></td>
                                <td><a class="btn btn-sm btn-outline-primary" href='javascript:getData("<?php echo $row["idkey"]; ?>")'>Edit</i></a>
                                    <a class="btn btn-sm btn-outline-warning" href="modules/mahasiswa/actions.php?act=delete&idkey=<?php echo $row["idkey"]; ?>">Delete</a>
                                </td>
                            </tr><?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include("input.php"); ?>

    </div>
    <script src="modules/mahasiswa/js/jquery.min.js"></script>
    <script src="modules/mahasiswa/js/bootstrap.min.js"></script>
    <script src="modules/mahasiswa/plugins/datatables-bs4/js/jquery.dataTables.min.js"></script>
    <script src="modules/mahasiswa/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="modules/mahasiswa/plugins/buttons-export/js/dataTables.buttons.min.js"></script>
    <script src="modules/mahasiswa/plugins/buttons-export/js/buttons.html5.min.js"></script>
    <script src="modules/mahasiswa/plugins/buttons-export/js/jszip.min.js"></script>
    <script src="modules/mahasiswa/plugins/buttons-export/js/pdfmake.min.js"></script>
    <script src="modules/mahasiswa/plugins/buttons-export/js/vfs_fonts.js"></script>


    <script>
        $(".btn-add").click(function() {
            $("#mightywebForm").attr("action", "modules/mahasiswa/actions.php?act=insert");
        });

        function getData(ID) {
            $("#mightywebModal").modal("show");
            $('#mightywebForm').attr('action', 'modules/mahasiswa/actions.php?act=update&idkey=' + ID + '');
            var id = ID;
            $.ajax({
                type: "POST",
                url: "modules/mahasiswa/actions.php?act=show",
                data: "idkey=" + id,
                dataType: "json",
                success: function(data) {
                    $('input[name="nama_lengkap"]').val(data.nama_lengkap);
                    $('textarea[name="alamat"]').val(data.alamat);
                    $('input[name="jenis_kelamin"]').each(function() {
                        if ($(this).val() == data.jenis_kelamin) {
                            $(this).prop("checked", true);
                        }
                    });
                    $('input[name="photo"]').removeAttr("required");

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
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, 'pageLength', ]
            });



        });
    </script>
</body>

</html>