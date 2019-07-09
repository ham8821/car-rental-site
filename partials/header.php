
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><i class="fas fa-car"></i>
       

        <?php
        
        //to show the name of the user when logged in
        if ($user->loggedin()) {
        echo  'Welcome ';
        echo $_SESSION['users']['fname'];

        }
        ?></a>
      <ul class="nav navbar-nav">

        <li><a href="about_us.php">About us</a></li>
        <li><a href="branches.php">Branches</a></li>
        <li><a href="show_map.php">Show location</a></li>
        <li><a href="products.php">Cars</a></li>
  
        <?php

          //When the user is a CUSTOMER, then show the SEND FEEDBACK form
          if ($user->loggedin() && $user_type_id == 3){
            echo ' <li><a href="edit_customer.php">Edit my profile</a></li>';  
            echo ' <li><a href="feedback.php">Send feedback</a></li>';
            echo ' <li><a href="customer_reservations.php">My Reservations</a></li>';
           
          }
          //When the user is ADMIN, show some options
          if ($user->loggedin() && $user_type_id == 1){
            echo ' <li><a href="list_of_users.php">List of users</a></li>';
          }
          if($user->loggedin() && ($user_type_id == 1 || $user_type_id == 2))
            echo '<li><a href="add_car.php">Add new car</a></li>';
          
          if($user->loggedin() &&  ($user_type_id == 1 || $user_type_id == 2)){
            echo '<li><a href="staff_reports.php">Reports</a></li>';
            echo '<li><a href="manage_reservations.php">Manage reservations</a></li>';
          }
         if ($user->loggedin() && $user_type_id == 1){
          echo '<li><a href="register.php">Add new user</a></li>';
         }else if (!$user->loggedin()){
          echo '<li><a href="register.php">Register</a></li>';
         }
         if (!$user->loggedin())
         echo '<li><a href="login.php">Log in</a></li>';
         
         if ($user->loggedin())
         echo '<li><a href="logout.php">Log out</a></li>';
        ?>
      </ul>
    </div>
  </div>
</nav>
