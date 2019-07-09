<?php

include_once 'database.php';
include_once 'user.php';

if(isset($_GET['submit'])){
        
  //send email to the customer with the confirmation details

  $from_name = $_GET['name'];
  $from_email = 'awesomecarrentalsite@gmail.com';
  $headers = 'From: '.$from_name .' <$from_email>';
  $to = 'awesomecarrentalsite@gmail.com';
  $subject = $_GET['title'];
  $body = $_GET['comments'];
  echo "<script>alert('".$_GET['title'].")</script>";
  echo "<script>alert('".$_GET['comments'].")</script>";
      if (mail($to, $subject, $body, $headers)) 
          echo "<script>alert('Feedback email sent. Thanks!')</script>";
      else
          echo "<script>alert('email is not working')</script>";
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
  <main>
    <div class="jumbotron" style="text-align: center; background: white">
      <div class="row">
      <p style="text-align: left">Leave us your feed back and we'll get back to you soon</p>
        <!-- form here -->
        <form method="GET" action="">
        <div class="form-group mx-sm-3 mb-2"  style="width: 300px">
            <label for="feedback-title" class="sr-only">Name</label>
            <input type="text" name="name" class="form-control" id="feedback-name" placeholder="Name">
          </div>
          <div class="form-group mx-sm-3 mb-2"  style="width: 300px">
            <label for="feedback-title" class="sr-only">Title</label>
            <input type="text" name="title" class="form-control" id="feedback-title" placeholder="Title">
          </div>
          <div class="form-group" style="width: 700px; text-align: left ">
            <label for="feedback-text">What do you want to tell us?</label>
            <textarea name="comments" class="form-control" id="feedback-text" rows="8"  placeholder="Your comments here"></textarea>
            <input type="submit" name="submit" />
          </div>   
         
        </form>
      </div>
    </div>
  </main>
</body>

</html>