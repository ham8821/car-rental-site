<?php
include 'customer.php';
$customer = new customer();
if (isset($_POST['register'])) {
    $customer->customer_registration();
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
            width: 250px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center">

                <?php

                    //Add a new user being the admin
                    
                    if ($user->loggedin() && $user_type_id == 1)
                    echo '<h3> Add New User</h3>';
                    else if(!$user->loggedin())

                   //Customer registration

                    echo '<h3> Register Now to start renting cars!</h3>';
                ?>
                
                <form class="form-horizontal" action="register.php" method="POST">

                    <div class="control-group">
                        <label class="control-label" for="inputFname1">First name <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="fname" required="required" id="inputFname1"
                                placeholder="First Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="lname" required="required" id="inputLnam" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="input_email">Email <sup>*</sup></label>
                        <div class="controls">
                            <input type="email" name="email" required="required" id="input_email" placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputSSN1">Contact number<sup>*</sup></label>
                        <div class="controls">
                            <input type="number" name="contact_number" required="required" id="inputSSN1"
                                placeholder="Contact number">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputUsername1">Username <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="username" required="required" id="inputUsername1"
                                placeholder="Username">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
                        <div class="controls">
                            <input type="password" name="password" required="required" id="inputPassword1"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword1">Retry Password <sup>*</sup></label>
                        <div class="controls">
                            <input type="password" name="password_again" required="required" id="inputPassword1"
                                placeholder="Retype-Password">
                        </div>
                    </div>

                   <?php

                        //add the user type selection for admin before adding the user
                        
                        if ($user->loggedin() && $user_type_id == 1){
                            
                        ?>
                         <div class="control-group">
                            <label class="control-label" for="inputPassword1">Type of user<sup>*</sup></label>
                            <div class="controls">
                                <input type="number" name="user_type" required="required" id="" min='1' max ='3'
                                    placeholder="Type of user">
                            </div>
                        </div>  

                        <?php } ?>    

                   
                    <div class="control-group">
                        <div class="controls">
                            <input style="margin-top: 15px;" class="btn btn-large btn-success" type="submit" name="register" value="Register" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</body>

</html>