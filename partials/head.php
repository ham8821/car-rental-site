<meta charset="UTF-8" />
<title>Awesome Car Rental</title>

<!-- CSS (load bootstrap from a CDN) -->
<link rel="stylesheet" type="text/css" href="css/products.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"><!-- button icon css link -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
  crossorigin="anonymous">
  <script src="js/plotly-latest.min.js"></script>

<style>
  body {
    padding-top: 50px;
    background: white;
    font-family: 'Oswald', sans-serif;
    color: black;
    font-size: 16px;
  }
  .margin-10 {
    margin: 10px;
  }

</style>
<?php
require_once 'core.php';
require_once 'user.php';

//user login

$loginerror = "";
$user = new user();
if (isset($_POST['login'])) {
    if (!$user->login()) {
        $loginerror = "Invalid Username or Password";
        echo '<script>alert("' . $loginerror . ' , Please Try Again ")</script>';
        header('#login');
    }
}

if ($user->loggedin()) {
    $user_id = $_SESSION['users']['user_id'];
    $user_type_id = $_SESSION['users']['user_type_id'];
}
?>