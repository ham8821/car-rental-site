<?php
    include 'customer.php';
    include 'admin.php';
    include_once 'staff.php';
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
    $staff = new staff();
    $DB = new database();


    //EDIT CAR INFORMATION 

    if ($user->loggedin() && ($user_type_id == 1 || $user_type_id == 2)){

        //checking that a edit car was requested by staff or admin

        if(isset($_GET['edit_car_data'])){
        $new_id = $_GET['edit_car_data'];
        
        //read all car data to show in the form

        $result = $DB->get("cars", array("car_id" => $new_id));
            if (!empty($result)) {
                foreach ($result as $value) {

                    $car_name = $value['car_name'];
                    $car_model = $value['car_model'];
                    $car_brand= $value['car_brand'];
                    $price_per_day = $value['price_per_day'];
                    $car_year = $value['car_year'];
                }
            }
        }  
        
        // post request to edit car data
        
        if (isset($_POST['edit_car_data'])) {

            $staff->update_car();
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
                    <h3> Edit Car information</h3>
                    <form class="form-horizontal" action="" method="POST">

                        <div class="control-group">

                            <input name="new_car_id" value="<?php echo $new_id; ?>" type="hidden">

                            <label class="control-label">Car name <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="car_name" required="required" id="car_name"
                                    placeholder="<?php echo $car_name; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Car model<sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="car_model" required="required" id="input_fname"
                                    placeholder="<?php echo $car_model; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Car brand <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="car_brand" required="required" id="input_lname"
                                    placeholder="<?php echo $car_brand ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Year <sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="car_year" required="required" id="car_year"
                                    placeholder="<?php echo $car_year ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Price per day<sup>*</sup></label>
                            <div class="controls">
                                <input type="number" name="price_per_day" required="required" id="price_per_day"
                                    placeholder="<?php echo $price_per_day; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >image<sup>*</sup></label>
                            <div class="controls">
                                <input type="text" name="image" required="required" id="image"
                                    placeholder="New url to car image">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button style="margin-top: 10px" type="submit" name="edit_car_data" class="btn btn-primary">Confirm</button>
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