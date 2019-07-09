<?php

include_once 'database.php';
include_once 'user.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
  include_once './partials/head.php';
?>
</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
        ?>

       
    </header>
    
    <div class="container">

        <div class="row" style="text-align: center">
            <h2>Log in</h2>
            <form action="" method="POST">
                
                <div class="control-group col-12"  style="margin-top:20px">
                    <label class="control-label" for="Username">Username</label>
                </div>
                <div>
                    <input class="span3" type="text" id="Username" name="username" placeholder="Username">
                </div>
                <div class="control-group col-12"  style="margin-top:20px">
                    <label class="control-label" for="inputPassword1">Password</label>
                </div>
                <div>
                    <input type="password" name="password" class="span3" id="inputPassword1" placeholder="Password">
                </div>
                <div class="control-group col-12"  style="margin-top:20px">
                    <div class="controls">
                        <button style="width: 100px; font-size: 18px" type="submit" name="login" class="btn">Sign in</button> 
                    </div>
                    <div style="margin-top: 20px">
                    <a href="forget_password.php" style="font-size: 18px">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>