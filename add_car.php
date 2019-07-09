<?php

include 'customer.php';
include_once 'staff.php';


$car = new car();
$staff = new staff();
if (isset($_POST['add_car'])) {
    $staff->add_car();
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
                    //ADD A NEW USER BEING THE ADMIN OR PART OF THE STAFF
                    
                    if ($user->loggedin() && ($user_type_id == 1 || $user_type_id == 2))
                    echo '<h3> Add New Car</h3>';
                ?>
                
                <form class="form-horizontal" action="add_car.php" method="POST">

                    <div class="control-group">
                        <label class="control-label">Car name<sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="car_name" required="required" id="car_name"
                                placeholder="Car name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Car model<sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="car_model" required="required" id="car_model" placeholder="Car model">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Car brand <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="car_brand" required="required" id="car_brand" placeholder="Car brand">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Year <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="car_year" required="required" id="car_year"
                                placeholder="Car year">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Price per day<sup>*</sup></label>
                        <div class="controls">
                            <input type="number" name="price_per_day" required="required" id="price_per_day"
                                placeholder="Price per day">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Image <sup>*</sup></label>
                        <div class="controls">
                            <input type="text" name="image" required="required" id="car-image"
                                placeholder="Image url">
                        </div>
                    </div>    
                    <div class="control-group">
                        <div class="controls">
                            <input style="margin-top: 15px;" class="btn btn-large btn-success" type="submit" name="add_car" value="Add car" />
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