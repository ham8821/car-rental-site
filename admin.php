<?php

include_once 'database.php';
include_once 'user.php';
include_once 'car.php ';

?>
<?php
class admin extends user {

    private $fname;
    private $lname;
    private $email;
    private $password;
    private $contact_number;
    private $DB;

    public function set_fname($fn) {
        $this->fname = $fn;
    }

    public function get_fname() {
        return $this->fname;
    }

    public function set_lname($ln) {
        $this->lname = $ln;
    }

    public function get_lname() {
        return $this->lname;
    }

    public function set_email($em) {
        $this->email = $em;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_password($psw) {
        $this->password = $psw;
    }

    public function get_password() {
        return $this->password;
    }

    public function set_contact_number($cnumber) {
        $this->contact_number = $cnumber;
    }

    public function get_contact_number() {
        return $this->contact_number;
    }

    public function __construct() {
        $this->DB = new Database();
    }

    // ADMIN FUNCTIONS


    //function to delete user

    public function delete_user($user_id) {

            if (!empty($user_id)) {
            $result = $this->DB->get("users", array("user_id" => $user_id));
            
            if (!empty($result)) {
            $total = $this->DB->delete("users", array("user_id" => $user_id));
     
             echo '<script>alert("User Deleted Successfully '.$user_id.'");
                 </script>';
            header("refresh:0;url=index.php");
            }else{
                echo '<script>alert("User Not detected  '.$user_id.'");

                    </script>';
               header("refresh:0;url=index.php");
               }
            }
    }

     //function to update user

    public function update_user(){
        if (isset($_POST['username']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['contact_number']) && isset($_POST['email'])) {
            $new_user_id = $_POST['new_user_id'];
            $username = $_POST['username'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];
            if (!empty($new_user_id)) {
                $result = $this->DB->get("users", array('user_id' => $new_user_id));
                if (!empty($result)) {
                    $total = $this->DB->update("users", array('username' => $username, 'fname' => $fname, 'lname' => $lname, 'email' => $email, 
                    'contact_number' => $contact_number), $new_user_id);
         
                    echo '<script>
                             header("edit_customer.php");
                         </script>';
                     echo '<script>alert("Profile Updated Successfully")</script>';
                     header("refresh:0;url=index.php");


                } else {
                    echo'<script>alert("User Not Found")</script>';
                    header("refresh:0;url=index.php");

                }
            } else {
                echo'<script>alert("The user_id is missing")</script>';
                header("refresh:0;url=index.php");

            }
        }
}

    //function to add a new car - ok
    public function add_car() {

        if (isset($_POST['car_name']) && isset($_POST['car_model']) && isset($_POST['car_brand']) && isset($_POST['car_year']) && isset($_POST['price_per_day'])) {
            $car_name = $_POST['car_name'];
            $car_model = $_POST['car_model'];
            $car_brand = $_POST['car_brand'];
            $car_year = $_POST['car_year'];
            $price_per_day= $_POST['price_per_day'];
            $image = $this->uploadimage('image');

            //check if all data is ready to be upload

            if (!empty($image) && !empty( $car_name) && !empty($car_model) && !empty($car_brand) && !empty($car_year) && !empty($price_per_day)) {
                if ($this->DB->insert("car", array('car_name' => $car_name, 'car_model' => $car_model, 'car_brand' => $car_brand, 'car_year' => $car_year, 'price_per_day' => $price_per_day, 'image' => $image))) {
                    echo '<script>alert("Car Added Successfully")</script>';
                } else {
                    echo '<script>alert("Add Failed")</script>';
                }
            } else {
                echo '<script>alert("All Fields Are Required")</script>';
            }
        }
    }

    //function to update a car 
    public function update_car() {

        $car_id = $_POST['car_id'];
        $car_name = $_POST['car_name'];
        $car_model = $_POST['car_model'];
        $car_brand = $_POST['car_brand'];
        $car_year = $_POST['car_year'];
        $price_per_day= $_POST['price_per_day'];
     //   $image = $this->uploadimage('image');


        if (!empty($car_id)) {
            $result = $this->DB->get("cars", array('car_id' => $car_id));
            if (!empty($result)) {
                $total = $this->DB->update_car("cars", array('model' => $model, 'car_year' => $car_year, 'price_per_day' => $price, 'brand' => $brand));
                echo '<script>alert("Car Updated")</script>';
                header("refresh:0;url=index.php");
            } else {
                echo '<script>alert("Car Not Found")</script>';
                header("refresh:0;url=index.php");

            }
        }
    }

    //function to show all user - ok
    function list_users() {
        return $this->DB->get('users', null);
    }
}
?>





