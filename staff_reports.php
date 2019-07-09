
<?php
include_once 'car.php';
include_once 'customer.php';
include_once 'reservation.php';
include_once 'staff.php';
include_once 'admin.php';

$reservation = new reservation();
$reservations = $reservation->get_all_reservations();
$car = new car();
$cars = $car->get_all_cars();
$admin = new admin();
$users = $admin->list_users();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include_once './partials/head.php';
    ?>
     <link rel="stylesheet" type="text/css" href="css/reports.css">
</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
    <div class="container-fluid">
        <div class="row">
           <center> <span class="mainslogan">Count it.</span> <span> Welcome to reports section. In this page, you can check reservation reports, available cars, user list by clicking each button down below.</span> </center>
           
           <div class="col-md-5">
           
                        <!-- Bar chart that shows the number of reservation per each user using Ploty -->
                        
                        <div id="customer-reservations" style=" margin:auto"></div>
                             
                        <script>
                            TESTER = document.getElementById('customer-reservations');

                           <?php
                             $admin = new admin();
                             $users = $admin->list_users();
                             $reservation = new reservation();
                             $reservations = $reservation->get_all_reservations();
                           
                            $x = array();
                            $y = array();

                           
                            for($j = 0; $j< sizeof($users); ++$j){
                                $count = 0;

                                //when the user is a customer, save the username in the x array
                                if($users[$j]['user_type_id'] == 3)
                                {
                                array_push($x, $users[$j]['username']);

                                for($i = 0; $i< sizeof($reservations); ++$i){

                                    //if the user match with the reservation add 1 to the count

                                    if($users[$j]['user_id'] == $reservations[$i]['user_id'])
                                        $count = $count + 1;
                                }
                                array_push($y, $count);   
                                }
                            }
                            $xsize = sizeof($x);
                            $ysize = sizeof($y);
                            ?>

                           var x1 = [];
                           var y1 = [];

                            //transfer all data from $x to x1
                           <?php for($i = 0; $i<$xsize; ++$i) {?>
                                i = <?php echo $i ?>;
                                x1[i] = '<?php echo $x[$i] ?>';
                           <?php } ?>
                            
                            //transfer all data from $y to y1
                           <?php for($j = 0; $j<$ysize; ++$j) {?>
                                j = <?php echo $j ?>;
                                y1[j] = <?php echo $y[$j]?>;
                            <?php } ?>
                            
                            var layout = {
                                            title: 'Reservations per user',
                                            barmode: 'stack',
                                            paper_bgcolor: 'rgba(245,246,249,1)',
                                            plot_bgcolor: 'rgba(245,246,249,1)',
                                            width: 600,
                                            height: 400,
                                            showlegend: true,
                                            annotations: []
                                            };

                            var data = [
                                            {
                                                name: 'No of reservations',
                                                x: x1,
                                                y: y1,
                                                type: 'bar'
                                            }
                                        ];
                            Plotly.newPlot('customer-reservations', data, layout);
                               
                        </script>     
            </div>

            <div class="countboxrow col-md-7">

               
                <br><br>
                    <div class="row">
                        
                        <div class="countbox col-md-4">
                        
                        <span>Dashboard > </span><span style="color: blue">Overview</span>
                        
                        </div>
                        <div class="countbox col-md-4">
                        <center><h2>Number of reservations</h2>
                        <div class="usericon"><img src="images/reservations.png" alt="" class="fluid"></div>
                        <?php
                            $con = mysqli_connect("localhost","root","","car-rental");
                            $sql="SELECT * FROM reservations";
                            $result = mysqli_query($con, $sql);              
                            $rows = mysqli_num_rows($result);                     
                            echo '<p class="numbercount">'.$rows.'</p>';
                            mysqli_close($con);
                        ?>        
                        <hr>
                        </center>
                        </div>

                        <div class="countbox col-md-4">
                        <center><h2>Rental-car income</h2>
                        <div class="usericon"><img src="images/cost.png" alt="" style="height: 40px; margin-top: 10px;" class="fluid"></div>
                        <?php
                            $con = mysqli_connect("localhost","root","","car-rental");
                            $sql="SELECT SUM(rental_cost) AS value_sum FROM reservations";
                            $result = mysqli_query($con, $sql);    
                            $row = mysqli_fetch_assoc($result); 
                            $sum = $row['value_sum'];
                            echo '<p class="numbercount">$'.$sum.'</p>';
                        ?> 
                        <hr>   
                         </center>
                        </div>
                 </div>
                 
                 <!-- tab links-------------------------------------------------------------- -->

                        <div class="row">
                            <div class="col-md-4"> </div>
                            <div class="col-md-8">   
                                 <div class="tab">
                                 <a href="#reservation"><button type="button" class="tablinks btn btn-primary btn-lg" onclick="openCity(event, 'reservation')" >Reservation list</button></a>
                                  <a href="#availablecar"><button type="button" class="tablinks btn btn-primary btn-lg"  onclick="openCity(event, 'availablecar')">Cars available</button></a>
                                  <a href="#customers"> <button type="button" class="tablinks btn btn-primary btn-lg"  onclick="openCity(event, 'customers')">Customer list</button></a>
                                  </div> 
                             </div>
                        </div>
                    
                <!---------------- tab contents --------------------------------------------------->
                            
            <hr>

            </div>
        </div>
            <div class="row">
                <!--reservation list -->
                <div class="col-12">
             <div id="reservation" class="tabcontent">   
                 
             <table class="table" id="reserves">
                        <h2 style="margin-bottom: 30px; margin-top: 30px">Reservations</h2>
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Car_id</th>
                            <th scope="col">Start date</th>
                            <th scope="col">End date</th>
                            <th scope="col">Days</th>
                            <th scope="col">Rental cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            for($i = 0; $i< sizeof($reservations); ++$i){
                            $j = $i+1;
                            echo '
                                <th scope="row">'.$j.'</th>
                                    <td>'.$reservations[$i]['user_id'].'</td>
                                    <td>'.$reservations[$i]['car_id'].'</td>
                                    <td>'.date("d-m-y", strtotime($reservations[$i]['start_date'])).'</td>
                                    <td>'.date("d-m-y", strtotime($reservations[$i]['end_date'])).'</td>
                                    <td>'.$reservations[$i]['days_rented'].'</td>
                                    <td>$ '.$reservations[$i]['rental_cost'].'</td>
                             </tr>';
                             } 
                             
                        ?>
                        </tbody>
                        </table>
            </div>
            </div>
            <!-- available car -->
            <div class="col-12">
             <div id="availablecar" class="tabcontent">    
             <table class="table" id="cartable">
                        <h2 style="margin-bottom: 30px; margin-top: 30px">Cars available to rent</h2>
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Year</th>
                            <th scope="col">Price per day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            for($i = 0; $i< sizeof($cars); ++$i){
                            $j = $i+1;
                            echo '
                                <th scope="row">'.$j.'</th>
                                    <td>'.$cars[$i]['car_name'].'</td>
                                    <td>'.$cars[$i]['car_brand'].'</td>
                                    <td>'.$cars[$i]['car_model'].'</td>
                                    <td>'.$cars[$i]['car_year'].'</td>
                                    <td>$ '.$cars[$i]['price_per_day'].'</td>
                             </tr>';
                             } 
                             
                         ?>
                        </tbody>
                        </table>
            </div>
            </div>
            <!-- customer list -->
            <div class="col-12">
             <div id="customers" class="tabcontent">     
             <table class="table" id="customers">
                        <h2 style="margin-bottom: 30px; margin-top: 30px">Customers</h2>
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">username</th>
                            <th scope="col">Type of user</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">email</th>
                            <th scope="col">Contact number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            for($i = 0; $i< sizeof($users); ++$i){
                            $j = $i+1;
                            switch($users[$i]['user_type_id']){
                                case 1: $user_type = "admin";break;
                                case 2: $user_type = "staff";break;
                                case 3: $user_type = "customer";break;
                            }
                            echo '
                                <th scope="row">'.$j.'</th>
                                    <td>'.$users[$i]['user_id'].'</td>
                                    <td>'.$users[$i]['username'].'</td>
                                    <td>'.$user_type.'</td>
                                    <td>'.$users[$i]['fname'].'</td>
                                    <td>'.$users[$i]['lname'].'</td>
                                    <td>'.$users[$i]['email'].'</td>
                                    <td>'.$users[$i]['contact_number'].'</td>
                             </tr>';
                             } 
                             
                        ?>
                        </tbody>
                        </table>
                    </div>
                 </div>
            </div>
      </div>
    </div>
    <script  src="js/main.js" type="text/javascript"></script>
</body>
</html>
