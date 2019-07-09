<?php
include_once 'user.php';
include_once 'admin.php';
include_once 'reservation.php';


$admin = new admin();
$users = $admin->list_users();

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
    <!-- link list -->
    <link rel="stylesheet" type="text/css" href="css/userlist.css">


    <!-- --------- -->
    </header>
    <h1>List of users</h1>
    <br>
    <div class="container">
         <div class="row">
            <div class="col-md-6">
                <div class="row">
                        <div class="bannerpic col-md-12">
                        <img src="images/listuserbanner.jpg" class="banner" alt="bannerpic">
                        </div>
                </div>
            </div>
            <!-- Here will be the tabs for each user list -->
           
            <div class="dashboard col-md-6">
                <span>Dashboard > </span><span style="color: blue">Overview</span>
                <br><br>
                    <div class="row">
                        
                        <div class="countbox col-md-4">
                        <center><p>Your admin</p></center>
                        <div class="usericon"><img src="images/admin.png" alt="" class="fluid"></div>
                        <?php
                            $con = mysqli_connect("localhost","root","","car-rental");
                            $sql="SELECT * FROM users where user_type_id=1";
                            $result = mysqli_query($con, $sql);              
                            $rows = mysqli_num_rows($result);                     
                            echo '<h2>'.$rows.'</h2>';
                            mysqli_close($con);
                        ?>
                        <hr>
                        </div>
                        <div class="countbox col-md-4">
                        <center><p>Your staff</p></center>
                        <div class="usericon"><img src="images/staff.png" alt="" class="fluid"></div>
                        <?php
                            $con = mysqli_connect("localhost","root","","car-rental");
                            $sql="SELECT * FROM users where user_type_id=2";
                            $result = mysqli_query($con, $sql);              
                            $rows = mysqli_num_rows($result);                     
                            echo '<h2>'.$rows.'</h2>';
                            mysqli_close($con);
                        ?>
                        <hr>
                        </div>
                        <div class="countbox col-md-4">
                        <center><p>Your customer</p></center>
                        <div class="usericon"><img src="images/user.png" alt="" class="fluid"></div>
                        <?php
                            $con = mysqli_connect("localhost","root","","car-rental");
                            $sql="SELECT * FROM users where user_type_id=3";
                            $result = mysqli_query($con, $sql);              
                            $rows = mysqli_num_rows($result);                     
                            echo '<h2>'.$rows.'</h2>';
                            mysqli_close($con);
                        ?>
                        <hr>    
                        </div>
                 </div>
                 
                 <!-- tab links-------------------------------------------------------------- -->
                        <div class="tab">
                                  <!-- <button class="tablinks" onclick="openCity(event, 'Adminlist')" id="defaultOpen">Admin list</button> -->
                                 <a href="#Adminlist"><button type="button" class="tablinks btn btn-primary btn-lg" onclick="openCity(event, 'Adminlist')" >Admin list</button></a>
                                  <!-- <button class="tablinks" onclick="openCity(event, 'Stafflist')">Staff list</button> -->
                                  <a href="#Stafflist"><button type="button" class="tablinks btn btn-primary btn-lg"  onclick="openCity(event, 'Stafflist')">Staff list</button></a>
                                  <!-- <button class="tablinks" onclick="openCity(event, 'Customerlist')">Customer list</button>     -->
                                  <a href="#Customerlist"> <button type="button" class="tablinks btn btn-primary btn-lg"  onclick="openCity(event, 'Customerlist')">Customer list</button></a>
                        </div>
                <!---------------- tab contents --------------------------------------------------->
                            
            </div>
        </div>      
   </div>        
    <hr>
    <div class="row">
                        <div id="Adminlist" class="tabcontent">
                                  
                                  <div class="row" id="adminrow">
                                     <br><br>
                                         <?php
                                                $number_of_admin = 0;
                                                $staff_members = 0;
                                                $number_of_customers = 0;

                                                echo '<h2 style="color: blue">List of administrators</h2>';
                                                echo '<hr/>';
                        
                                               for($i = 0; $i< sizeof($users); ++$i){
                                            
                                                 //show the admin data
                                                    if($users[$i]['user_type_id']== 1) {
                            
                                                        $number_of_admin = 1;
                            
                                                        echo '<div class="adminprofile col-md-12" style="text-align: center">';
                                                        echo '<img src="images/adminicon.png" alt="adminicon" class="icon" style="width: 85px;">';
                                                        echo '<p> username: '.$users[$i]['username'] . '</p>';
                                                        echo '<p> email: '. $users[$i]['email'] .'</p>';
                                                        echo '<p> contact number: '. $users[$i]['contact_number'] .'</p>';
                                                        echo  '<span>
                                                                <form class="buttonform" action="" method="GET" style="display: inline;">
                                                                    <button type="submit" name="delete_user_1" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Delete user</button>                  
                                                                </form> 
                                                             
                                                                <form class="buttonform" action="edit_customer.php" method="GET" style="display: inline;" >
                                                                    <button  type="submit" name="id" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Edit user</button>
                                                                </form>
                                                                </span>';
                                                             
                                                              
                                                        echo '</div>';
                                                        echo '<hr/>';     
                                                        echo '<br><br>';          
                                                    }
                                                    //when the admin selects delete user
                                
                                                    if(isset($_GET['delete_user_1'])){
                                                    

                                                        $user_id = $_GET['delete_user_1'];
                                                        $reservation = new reservation();
                                                        $reservations = $reservation->get_all_reservations();
                                                        
                                                        foreach($reservations as $value){
    
                                                            if($value['user_id'] == $user_id)
                                                            $reservation->delete_reservation($user_id);
    
                                                        }
                                                        $admin->delete_user($user_id);
                                                        break;
                                                    }
      
                                            }
                                            if($number_of_admin == 0){
                        
                                                echo '<p>No admins</p>';
                                                echo '<hr/>';
                                            }  

                                          ?>
                                        
                                  </div>
                                </div>
                                <br><br>
                                <!-- ---------------------------------------------------------------------------------------- -->
                                <div id="Stafflist" class="tabcontent">
                               
                                  
                                  <div class="row">
                                   <?php
                                            echo '<h2 style="color: blue">List of staff members</h2>';
                                            echo '<hr/>';

                                            for($i = 0; $i< sizeof($users); ++$i){
                                                
                                                //show the staff data
                                                
                                                if($users[$i]['user_type_id']== 2) {
                                            
                                                    $staff_members = 1;
                                                
                                                    echo '<div class="col-md-4" style="margin-top:20px;">';
                                                    echo '<div id="imojirow" class="row">';
                                                            echo '<div class="icon col-md-5" style="text-align: center">';
                                                            echo '<img src="images/stafficon.png" alt="stafficon" class="imoji" style="width: 85px;margin-top: 55px;">';
                                                            echo '</div>';
                                                            echo '<div class="profile col-md-7 style="text-align: center">';
                                                                    echo '<h4> First name: ' . $users[$i]['fname'] . '</h5>';
                                                                    echo '<h4> Last name: ' . $users[$i]['lname'] . '</h5>';
                                                                    echo '<p> username: '.$users[$i]['username'] . '</p>';
                                                                    echo '<p> email: '. $users[$i]['email'] .'</p>';
                                                                    echo '<p> contact number: '. $users[$i]['contact_number'] .'</p>';
                                                                
                            
                                                            echo '  <form class="buttonform" action="" method="GET" style="display: inline;">
                                                                        <button type="submit" name="delete_user_2" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Delete user</button>                  
                                                                    </form> 
                                                                    <form class="buttonform" action="edit_customer.php" method="GET" style="display: inline;">
                                                                        <button type="submit" name="id" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Edit user</button>
                                                                    </form>';
                                                           echo '</div>';
                                                    echo '</div>';                               
                                                    echo '</div>';
                                                    // echo '<hr/>';  
                                                }
                                                    
                                                //when the admin selects delete user

                                                if(isset($_GET['delete_user_2'])){
                                                
                                                    $user_id = $_GET['delete_user_2'];
                                                    $reservation = new reservation();
                                                    $reservations = $reservation->get_all_reservations();
                                                    
                                                    foreach($reservations as $value){

                                                        if($value['user_id'] == $user_id)
                                                        $reservation->delete_reservation($user_id);

                                                    }
                                                    $admin->delete_user($user_id);
                                                    break;
                                                }

                                            }

                                            if($staff_members == 0){

                                                echo '<p>No stuff members</p>';
                                                echo '<hr/>';
                                            }
                                   
                                   ?>
                                   
                                  </div>
                                </div>
                                 
                                <!-- ------------------------------------------------------------------------------------- -->
                                <div id="Customerlist" class="tabcontent">
                                
                                  <div class="row">
                                 <?php
                                            echo '<h2 style="color: blue" >List of customers</h2>';
                                            echo '<hr/>';

                                            for($i = 0; $i< sizeof($users); ++$i){
                                            
                                                //show the customers data

                                                if($users[$i]['user_type_id']== 3) {
                                            
                                                $number_of_customers = 1;

                                                echo '<div class="col-md-3" style="margin-top:20px;">';
                                                echo '<div id="imojirow" class="row">';
                                                echo '<div class="icon col-md-5" style="text-align: center">';
                                                echo '<img src="images/usericon.png" alt="usericon" class="imoji" style="width: 120px;margin-top: 45px;margin-bottom:20px;">';

                                                echo '  <form class="buttonform" action="" method="GET" style="display: inline;">
                                                            <button type="submit" name="delete_user_3" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Delete user</button>                  
                                                        </form> 
                                                        <form class="buttonform" action="edit_customer.php" method="GET" style="display: inline;">
                                                            <button style="margin-top: 10px;" type="submit" name="id" value='. $users[$i]['user_id'].' class="btn btn-outline-primary">Edit user</button>
                                                        </form> ';

                                                echo '</div>';

                                                echo '<div class="profile col-md-7 style="text-align: center">';
                                                echo '<h3> User No: '.$users[$i]['user_id'].'</h5>';
                                                echo '<h4> First name: ' . $users[$i]['fname'] . '</h5>';
                                                echo '<h4> Last name: ' . $users[$i]['lname'] . '</h5>';
                                                echo '<p> username: '.$users[$i]['username'] . '</p>';
                                                echo '<p> email: '. $users[$i]['email'] .'</p>';
                                                echo '<p> contact number: '. $users[$i]['contact_number'] .'</p>';

                                           
                                                        
                                                        echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                // echo '<hr/>';  
                                            
                                               
                                                }
                                                if(isset($_GET['delete_user_3'])){
                                                    

                                                    $user_id = $_GET['delete_user_3'];
                                                    
                                                    $reservation = new reservation();

                                                    $reservations = $reservation->get_all_reservations();
                                                    
                                                    foreach($reservations as $value){

                                                        if($value['user_id'] == $user_id)
                                                        $reservation->delete_reservation($user_id);

                                                    }

                                                    $admin->delete_user($user_id);
                                                    break;
                                                }

                                            }  
                                            if($number_of_customers == 0){

                                                echo '<p>No customers</p>';
                                                echo '<hr/>';
                                            }  

                                        
                                 ?>
                                  </div>
                                </div>
                                <br><br>
     </div>

   <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
    
  
    <script  src="js/main.js" type="text/javascript"></script>
</body>

</html>