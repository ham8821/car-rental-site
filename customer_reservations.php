<?php
include_once 'car.php';
include_once 'customer.php';
include_once 'reservation.php';
include_once 'user.php';


$reservation = new reservation();
$reservations = $reservation->get_all_reservations();

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
        <div class="row">
            
                        <table class="table">
                        <h2 style="margin-bottom: 30px; margin-top: 30px">My Reservations</h2>
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Car_id</th>
                            <th scope="col">Rental Start date</th>
                            <th scope="col">Rental End date</th>
                            <th scope="col">Days</th>
                            <th scope="col">Total Rental cost</th>
                            <th scope="col">Reservation Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            for($i = 0; $i< sizeof($reservations); ++$i){
                            $j = $i+1;
                            if( $_SESSION['users']['user_id'] == $reservations[$i]['user_id']){
                            echo '
                                <th scope="row">'.$j.'</th>
                                    <td>'.$reservations[$i]['car_id'].'</td>
                                    <td>'.date("d-m-y", strtotime($reservations[$i]['start_date'])).'</td>
                                    <td>'.date("d-m-y", strtotime($reservations[$i]['end_date'])).'</td>
                                    <td>'.$reservations[$i]['days_rented'].'</td>
                                    <td>$ '.$reservations[$i]['rental_cost'].'</td>
                                    <td>'.$reservations[$i]['reservation_status'].'</td>
                             </tr>';
                             } 
                            }  
                        ?>
                        </tbody>
                        </table>
                    
        </div>
    </div>
    </div>
</body>

</html>