<?php
include_once 'car.php';
$car = new car();
?>

<!DOCTYPE html>
<html lang="en">

 <head>
 <?php
  include_once './partials/head.php';
?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.icon-bar {
  /* position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%); */
  text-align: center;
  positoin: absolute;
 
}

.icon-bar a {
  display: inline;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: black;
  font-size: 20px;
  background-color: transparent;
  
}

.icon-bar a:hover {
  background-color: #000;
  color:white;
  border-radius: 15px;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.youtube {
  background: #bb0000;
  color: white;
}

</style>
</head> 

<body class="container" style="margin-bottom: 10px">
  <header>
  <?php
     include_once './partials/header.php';
  ?>
  </header>

  <div id="share"></div>
  <main>
    <div class="jumbotron" style="text-align: center; background: white">
      <div class="row">
        <div class="col-12" style="text-align: center;">
          <h1>Awesome Car Rental</h1> 
          <p style="font-size: 28px;">Find the car you like and take a trip!</p>
          <a href="products.php"><button style="font-size: 24px" type="button" class="btn btn-warning">Start now</button></a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="img-fluid">
            <img style="max-width:300px; max-height:300px; margin-right: 20px" src="./images/car_2.jpg" alt="car1">
            <img style="max-width:300px; max-height:300px; margin-right: 20px" src="./images/car_1.jpg" alt="car2">
          </div>
          
        </div>
        <div class="col-12">
        <br>
        <div class="icon-bar">
  <a href="https://www.facebook.com" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="https://www.twitter.com" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="https://www.google.com" class="google"><i class="fa fa-google"></i></a> 
  <a href="https://www.linkedin.com" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="https://www.youtube.com" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>