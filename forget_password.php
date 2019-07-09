<?php

include_once 'database.php';
include_once 'user.php';

$user = new user();
$database = new database();

//send password to user

if (isset($_POST['username']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $result = $database->get('users', array('username' => $username, 'email' => $email));

    if ($result) {
        $password = $result[0]['password'];
        
        $from_name = 'Awesome Car Rental';
        $from_email = 'awesomecarrentalsite@gmail.com';
        $headers = 'From: '.$from_name .' <$from_email>';
        $to = ''.$email.'';
        $subject = 'Password';
        $body = 'Dear '.$username.', '."\r\n" ."\r\n". 
                'This is your password: '.$password.' '."\r\n". "\r\n".
                'Regards,'."\r\n". 
                'Awesome Rental Car Team';
        
            if (mail($to, $subject, $body, $headers)) 
                echo "<script>alert('Your password was sent to your email')</script>";
            else
                echo "<script>alert('email is not working')</script>";
                header("refresh:0;url=index.php");
    }
}

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
    <style>
        input{
            width: 200px;
        }
    </style>

    <div class="container">

        <div class="row" style="text-align: center">
            <h3>SET A NEW PASSWORD</h3>
            <h4>Your password will be sent to your email account</h4>
            <form action="" method="POST">
                <div class="control-group col-12"  style="margin-top:20px">
                    <label class="control-label" for="inputPassword1">Username</label>
                </div>
                <div>
                    <input type="text" name="username" class="span3" id="username" placeholder="username">
                </div>
                <div class="control-group col-12"  style="margin-top:20px">
                    <label class="control-label" for="inputPassword1">email</label>
                </div>
                <div>
                    <input type="email" name="email" class="span3" id="email" placeholder="email">
                </div>
                <div class="control-group col-12"  style="margin-top:20px">
                    <div class="controls">
                        <button type="Submit" name="login" class="btn">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>