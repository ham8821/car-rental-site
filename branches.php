<?php

include_once 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include_once './partials/head.php';
    ?>
<style>

span{
    margin-right: 10px;
    margin-left:10px;
    margin-top: 30px;
    

}

div#user_data_paginate.dataTables_paginate.paging_simple_numbers{

    cursor: pointer;

}

a.paginate_button.current {

    margin: 5px;

}

.col-12{

    margin-bottom:40px  

}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
  
    <div class="container">
        <div class="row">
            <div class="col-12" style="width:80%; display:block; margin:auto">
                <h2 style="margin-bottom: 30px; margin-top: 30px;text-align:center" >Awesome Car Rental Branches</h2>
                <img style="max-height: 500px; max-width: 500px; display:block; margin: auto"src="./images/cars.png" alt="">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Find the same cars in other cities!</h3>
                    </div>
                   <div class="panel-body">
                    
                        <table class= "table" id="user_data">
                            <thead>
                                <tr>
                                <th scope="col">Branch name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact Number</th>
                                  
                                </tr>
                            </thead>
                        </table>
                   
                </div>
            </div>
        </div>
    </div>
</body>
    <script type="text/javascript" language="javascript">
        
        $(document).ready(function () {
        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
               url: "fetch.php",
               type: "POST"
            },
            "columnDefs": [{
                "targets": [2],
                "orderable": false,
            }, ],

        });
       });
 
</script>

</html>

