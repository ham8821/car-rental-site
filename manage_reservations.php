<?php
include_once 'car.php';
include_once 'reservation.php';
include_once 'admin.php';

$reservation = new reservation();
$reservations = $reservation->get_all_reservations();

$car = new car();
$cars = $car->get_all_cars();

$admin = new admin();
$users = $admin->list_users();


//check if the staff member sent the rejection or confirmation response

if(isset($_GET['user_id']) && isset($_GET['reservation_id']) && isset($_GET['reservation_status']) ){

    $new_user_id = $_GET['user_id'];
    $reservation_id = $_GET['reservation_id'];
    $reservation_status =  $_GET['reservation_status'];
    $reservation->set_reservation_status($reservation_id, $reservation_status);
    
    
    //search for the email and fname of the costumer

    foreach($users as $value){

        if($value['user_id'] == $new_user_id){

            $user_email = $value['email'];
            $user_fname = $value['fname'];
            break;
        }

    }
    
    if($_GET['reservation_status'] == "rejected"){

        //send email to the customer with the cancelation details
        
        $from_name = 'Awesome Car Rental';
        $from_email = 'awesomecarrentalsite@gmail.com';
        $headers = 'From: '.$from_name .' <$from_email>';
        $to = ''.$user_email.'';
        $subject = 'Rental request rejected';
        $body = 'Dear '.$user_fname.', '."\r\n" ."\r\n". ' We are so sorry to inform you that your rental request was rejected.'."\r\n". 
                'This is because the car you requested it is having some mechanical problems'."\r\n". 
                'Plaese try to rent another one or contact us if you need more information'."\r\n". "\r\n".
                'Thank you for using our services. We will be waiting to meet you soon'."\r\n".  "\r\n".
                'Regards,'."\r\n". 
                'Awesome Rental Car Team';
    
                if (mail($to, $subject, $body, $headers)){
                echo "<script>alert('Rejection email sent to customer')</script>";
                header("refresh:0;url=index.php");
                }
            else
                echo "<script>alert('email is not working')</script>";


    }else if($_GET['reservation_status'] == "accepted"){
        
        //send email to the customer with the confirmation details

        $from_name = 'Awesome Car Rental';
        $from_email = 'awesomecarrentalsite@gmail.com';
        $headers = 'From: '.$from_name .' <$from_email>';
        $to = ''.$user_email.'';
        $subject = 'Rental confirmation';
        $body = 'Dear '.$user_fname.', '."\r\n" ."\r\n". ' We are so glad to inform you that your rental request was accepted.'."\r\n". 
                'The payment methods available in our shop are the following:'."\r\n". "\r\n".
                'Cash, debit or credit card (Visa, Mastercard, AMEX)'."\r\n".  "\r\n".
                'Thank you for using our services. We will be waiting to meet you soon'."\r\n".  "\r\n".
                'Regards,'."\r\n". 
                'Awesome Rental Car Team';
        
            if (mail($to, $subject, $body, $headers)) {
                echo "<script>alert('Confirmation email sent to customer')</script>";
                header("refresh:0;url=index.php");
            }
            else
                echo "<script>alert('email is not working')</script>";
        }   
}   

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include_once './partials/head.php';
    ?>
   <style>
        #reservation {
        border-collapse: collapse;
        width: 100%;
         }
  
        #reservation tr:nth-child(even){background-color: #f2f2f2;}
        
        #reservation tr:hover {background-color: #ddd;}
        
        #reservation th {

        background-color:rgba(183, 182, 194, 1);
        color: black;
        font-size:20px;
        font-weight: 200;
         } 
         h2{
             text-align:center;
         }
</style> 

</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
    <div class="container">
        <div class="row">

                        <table class="table" id="reservation">
                        <h2 style="margin-bottom: 30px; margin-top: 30px">Reservations</h2>
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Car_id</th>
                            <th scope="col">Start date</th>
                            <th scope="col">End date</th>
                            <th scope="col">Days</th>
                            <th scope="col">Status</th>
                            <th scope="col">Accept request</th>
                            <th scope="col">Reject request</th>
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
                                        <td>'.$reservations[$i]['reservation_status'].'</td>';

                                        $user_id = $reservations[$i]['user_id'];
                                        $reservation_id = $reservations[$i]['reservation_id'];
                                        

                                        if($reservations[$i]['reservation_status'] == "pending") {

                                        echo '<td>';
                                        echo '<form action="" method="GET">      
                                                <div class="col-12">
                                                    <a href="manage_reservations.php?user_id='.$user_id.'&reservation_id='.$reservation_id.'&reservation_status=accepted">Accept</a> 
                                                </div>
                                            </form>';
                                        echo '</td>';    
                                        echo '<td>'; 
                                    

                                        echo '<form action="" method="GET">      
                                                <div class="col-12">
                                                    <a href="manage_reservations.php?user_id='.$user_id.'&reservation_id='.$reservation_id.'&reservation_status=accepted">Reject</a> 
                                                </div>
                                            </form>'; 
                                        echo '</td>';
                                      }
                                  echo '</tr>';
                            }  
                        ?>
                        </tbody>
                        </table>

                       
        </div>
    </div>
    </div>
</body>
</html>