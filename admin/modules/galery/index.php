<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Title Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="modules/galery/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="modules/galery/css/form-validation.css">

</head>

<body class="bg-light">
    <div class="container p-3">
        <p><button type="button" class="btn btn-outline-primary btn-add" data-toggle="modal" data-target="#mightywebModal">Insert Record</button></p>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data galery</h3>
                <div class="card-tools">
                <button type ="button" class="btn btn-tool" id="load-data">
                    <i  class="fas fa-sync-alt"></i>
                </button>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
        <?php include("input.php"); ?>

    </div>
    <script src="modules/galery/js/jquery.min.js"></script>
    <script src="modules/galery/js/bootstrap.min.js"></script>
    <script src="modules/galery/plugins/datatables-bs4/js/jquery.dataTables.min.js"></script>
    <script src="modules/galery/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function(){
            loadData();
                $('#load-data').click(function(){
                        loadData();
            });
        });

        function loadData(){
        $('.card-body').load('modules/galery/tampil.php');
        }
        function delData(ID){
        var id = ID;
        $.ajax({
                type	: "POST",
                url		: "modules/galery/actions.php?act=delete&id_galery="+id+"",
                dataType	: "html", 
                success: function(){
                    loadData();
                }
            });
        }
    </script>
</body>

</html>