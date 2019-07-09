<?php
include_once 'car.php';
include_once 'customer.php';
include_once 'staff.php';
include_once 'reservation.php';


$car = new car();
$cars = $car->get_all_cars();

$staff = new staff;
$customer = new customer();


//check if a post request to delete car was permormed
if(isset($_POST['delete_car_data'])){

    $car_id = $_POST['delete_car_data'];
    $reservation = new reservation();
    $reservations = $reservation->get_all_reservations();
    
    foreach($reservations as $value){

        if($value['car_id'] == $car_id)
        $reservation->delete_reservation_by_car_id($car_id);

    }

    $staff->delete_car($car_id);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include_once './partials/head.php';
    ?>

</head>

<body id="top" class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
    <section>
    <div class ="container">
        <div class="row">
            <div class="col-12">
               <p class="slogan"> You drive, we care.<p>
            </div>
         <div class="row">  
                <div class="imgbox col-12">      
                    <img src="images/wallpaper.jpg" id="wallpaper" class="img-fluid" alt="maincarpic"> 
              
                </div>
            </div> 
            <div class="row" id="iconrow">
                <div class="col-12">
                <a class="icon" href="#carsection"><i class="glyphicon glyphicon-circle-arrow-down" id="arrowicon"></i></a>
                </div>
        </div>
        </div>
    </div>
   </section>

   <br><br>
  <!-- here-> list code -->
    <section id="carsection">
    <div class="container">
        <div class="row">

            <?php
                        for($i = 0; $i< sizeof($cars); ++$i){

                            //rented_status = 0 means car no rented
                            //rented_status = 1 means car rented or waiting for approval
                            
                                echo '<div class="carprofile col-md-6" >';  
                                echo '<div class="row">';
                                echo '<hr>';
                                echo '<h2> '.$cars[$i]['car_name'].'</h2>'; 
                                echo '<hr>';
                                echo '<div class="col-md-6">';
                                
                                
                                echo '<div class="picbox">';
                                echo '<img src="' . $cars[$i]['image'] . '" alt="car-image" style="max-width:300px;max-height:300px" /></a>';
                                echo '</div>';
                                echo '</div>';
                               

                                echo '<div class="infobox col-md-6">';
                                // echo  '<div class=""';
                                echo '<h4> Brand: ' . $cars[$i]['car_brand'] . '</h5>';
                                echo '<h4> Model: ' . $cars[$i]['car_model'] . '</h5>';
                                echo '<p> Year: '.$cars[$i]['car_year'] . '</p>';
                                echo '<p> Price per day: $'. $cars[$i]['price_per_day'] .'</p>';
                                echo '</div>';
                                // echo '</div>';

                                echo '</div>';
                                //if a costumer is logged in, then show the Reserve now option 
                                if ($user->loggedin() && $user_type_id == 3) 
                                {   
                                    // echo '<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Simple collapsible</button>';
                                    echo '<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#demo">Booking</button>';
                                    echo '<div id="demo" class="collapse">';
                                    echo '<br>';
                                    echo '<h4> Reservation dates </h4>';
                                    echo    '<form action="" method="POST">    
                                                <div class="col-12>  
                                                    <label style="margin-bottom: 10px">Start date* </label>          
                                                    <input type="date" style="width: 140px;" id="start_date" required="required" name="start_date" placeholder="Select"> 
                                                </div> 
                                                <br>
                                                <div class="col-12>  
                                                    <label style="margin-bottom: 10px">End date* </label>        
                                                    <input type="date" style="width: 140px;" id="end_date" required="required" name="end_date" placeholder="Select">     
                                                </div>    

                                                <div class="col-12" style="text-align:center">
                                                    <input style="visibility:hidden" name="car_sel_id" value='.$cars[$i]['car_id'].'>
                                                    <input style="visibility:hidden" name="price_per_day" value='.$cars[$i]['price_per_day'].'>
                                                </div>
                                                <div class="col-12" style="text-align:center">
                                                    <button type="submit" name="reservation" class="btn btn-primary">Book now</button>
                                                </div>
                                            </form>';   
                                    echo '</div>';                 
                                }  

                                 //if the admin or the staff is logged in, then show the edit option 

                                 if ($user->loggedin() && ($user_type_id == 1 || $user_type_id == 2)) 
                                 {   
                                    
                                     echo '<span>
                                            <form class="buttonform" action="edit_car.php" method="GET">      
                                             <button type="submit" name="edit_car_data" value='.$cars[$i]['car_id'].' class="btn btn-warning">Edit car</button>
                                             </form>
                                             </span>'; 
                                  
                               
                                    echo '<span>
                                            <form class="buttonform" action="" method="POST">      
                                            <button type="submit" name="delete_car_data" value='.$cars[$i]['car_id'].' class="btn btn-warning">Delete car</button>
                                            </form>
                                            </span>';     
                                                       
                                 }  

                                echo '</div>';
                                //echo '<hr/>';
                                 
                                if (isset($_POST['reservation'])) {     

                                    $car_id = $_POST['car_sel_id'];    
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                    
                                    //function to calculate the renting days
                                    function dateDiffInDays($start_date, $end_date)  
                                    { 
                                        $diff = strtotime($end_date) - strtotime($start_date); 
                                        return abs(round($diff / 86400)); 
                                    } 
                                    
                                    // Function call to find date difference 
                                    $days_rented = dateDiffInDays($start_date, $end_date); 

                                    $price_per_day = $_POST['price_per_day'];
                                    $rental_cost = $days_rented * $price_per_day;
                                    
                                    $customer->new_reservation($days_rented, $rental_cost, $car_id, $start_date, $end_date);

                                    //send email to request reservation
                                    
                                    $from_name = 'Awesome Car Rental Site Team';
                                    $from_email = 'awesomecarrentalsite@gmail.com';
                                    $headers = 'From: '.$from_name .' <$from_email>';
                                    $body = 'Dear '.$_SESSION['users']['fname'].': '."\r\n". ' Thanks for request a car rental. We will contact you as soon as possible.';
                                    
                                    $subject = 'Rental request in progress';
                                    
                                    $user_email = $_SESSION['users']['email'];
                                    $to = ''.$user_email.'';

                                    if (mail($to, $subject, $body, $headers)) {
                                        echo "success!";
                                    }else{
                                        echo "fail...";
                                    } echo "<script>alert('email is not working')</script>";
                                    
                                    break;
                            }
                    
                    }        
                ?>
            <br class="clr" />
        </div>
    </div>
    <br>
    <div class="row" id="iconrow2">
                <div class="col-12">
                <a class="icon" href="#top"><i class="glyphicon glyphicon-circle-arrow-up" id="arrowicon2"></i></a>
                </div>
        </div>
<br>
    </section>


    </div>
<!-- script links-------------------------------------------------------------------------------------------------------------------------------------------------------- -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
</body>

</html>