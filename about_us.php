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
.col-12{

    margin-bottom:40px  

}
</style>
</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
    <div class="row"  style="text-align: center">
        <div class="col-12">
            <h1>About us</h1>
            <img src="./images/creators.png" alt="creators" style="width:100px; height:100px">
        </div>
        <div class="col-12">
            <h3>We are the founders of</h3>
            <h3 style="color:orange">Awesome Rental Car</h3>
        </div>
       <div class="col-12" style="font-size: 26px">
            <p><i class="far fa-check-circle"></i> Emma Hum</p>
            <p><i class="far fa-check-circle"></i> Diego Evangelisti</p>
            <p><i class="far fa-check-circle"></i> Roman Carlo</p>
       </div>

        <div class="col-12">
            <h3>Design and created for Internet Programming</h3>
            <p>Tutor: Arthur Lewis</p>
            <p>2019. GradDip Level 7
            </p>Aspire2 International, Auckland, New Zealand </p>
        </div>
    </div>
</body>
    <footer>
    <?php
            include './partials/footer.php';
    ?>
    </footer>
</html>