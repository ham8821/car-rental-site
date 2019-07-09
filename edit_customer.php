    <?php
    include 'customer.php';
    include 'admin.php';
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
            <?php

    $admin = new admin();
    $DB = new database();

    //EDIT USER INFORMATION WHEN USER_TYPE = 3 (CUSTOMER)

    if ($user->loggedin() && $user_type_id == 3){
        
        $new_id = $_SESSION['users']['user_id'];
        $result = $DB->get("users", array("user_id" => $new_id));

            if (!empty($result)) {
                foreach ($result as $value) {

                    $username = $value['username'];
                    $fname = $value['fname'];
                    $lname = $value['lname'];
                    $email = $value['email'];
                    $contact_number = $value['contact_number'];
                    $old_password = $value['password'];
                }
            } 

            if (isset($_POST['edit_user_data'])) {

                //check if the old password is similar than the enter by the user

                if($old_password != $_POST['old_password']){
                echo '<script>
                            alert("old and new password should match");
                            header("edit_customer.php");
                    </script>';
                }else   
                $admin->update_user();
            }
    }

    //EDIT USER INFORMATION WHEN USER_TYPE = 1 (ADMIN)

    if ($user->loggedin() && $user_type_id == 1){

        if(isset($_GET['id'])){
        $new_id = $_GET['id'];
        
        $result = $DB->get("users", array("user_id" => $new_id));
            if (!empty($result)) {
                foreach ($result as $value) {
                
                    $username = $value['username'];
                    $fname = $value['fname'];
                    $lname = $value['lname'];
                    $email = $value['email'];
                    $contact_number = $value['contact_number'];
                    $old_password = $value['password'];
                }
            }
        }  
        if (isset($_POST['edit_user_data'])) {

            $admin->update_user();
        } 
    }

    ?>
        </header>

        <div class="container">
            <style>
                input {
                    width: 250px;
                }
            </style>
            <div class="row">
                <div class="col-12" style="text-align: center">
                    <h3> Edit Customer information</h3>
                    <form class="form-horizontal" action="" method="POST">

                        <div class="control-group">

                            <input name="new_user_id" value="<?php echo $new_id; ?>" type="hidden">

                            <label class="control-label" for="inputUsername1">Username <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="username" required="required" id="input_uname"
                                    placeholder="<?php echo $username; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputFname1">First name <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="fname" required="required" id="input_fname"
                                    placeholder="<?php echo $fname; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="lname" required="required" id="input_lname"
                                    placeholder="<?php echo $lname; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input_email">email <sup>*</sup></label>
                            <div class="controls">
                                <input type="email" name="email" required="required" id="input_email"
                                    placeholder="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputContactNumber">Contact number<sup>*</sup></label>
                            <div class="controls">
                                <input type="number" name="contact_number" required="required" id="input_contact_number"
                                    placeholder="<?php echo $contact_number; ?>">
                            </div>
                        </div>
                        <?php 

                            //Just ask fot the old password to the customers

                            if($user->loggedin() && $user_type_id == 3)
                            echo ' 
                                    <div class="control-group">
                                        <label class="control-label" for="inputNewPassword">Old password<sup>*</sup></label>
                                        <div class="controls">
                                            <input type="text" name="old_password" required="required" id="input_old_password"
                                            placeholder="Enter the old password">
                                        </div>
                                    </div>';
                        ?>
                       
                        <div class="control-group">
                            <label class="control-label" for="inputNewPassword">New password<sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="new_password" required="required" id="input_new_password"
                                    placeholder="Enter the new password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button style="margin-top: 10px" type="submit" name="edit_user_data" class="btn btn-primary">Confirm</button>
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