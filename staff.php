<?php

include_once 'database.php';
include_once 'user.php';
include_once 'car.php ';

?>
<?php
class staff extends user {

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

    // STUFF FUNCTIONS

    //function to add a new car 
    public function add_car() {

        if (isset($_POST['image']) && isset($_POST['car_name']) && isset($_POST['car_model']) && isset($_POST['car_brand']) && 
            isset($_POST['car_year']) && isset($_POST['price_per_day'])) {

            $car_name = $_POST['car_name'];
            $car_model = $_POST['car_model'];
            $car_brand = $_POST['car_brand'];
            $car_year = $_POST['car_year'];
            $price_per_day= $_POST['price_per_day'];
            $image = $_POST['image'];

            //check if all data is ready to be upload

            if (!empty($image) && !empty( $car_name) && !empty($car_model) && !empty($car_brand) && !empty($car_year) && !empty($price_per_day)) {
                
                if ($this->DB->insert("cars", array('car_name' => $car_name, 'car_model' => $car_model, 'car_brand' => $car_brand, 'car_year' => $car_year, 
                    'price_per_day' => $price_per_day, 'image' => $image, 'rented_status' => 0))) {

                    echo '<script>alert("Car Added Successfully")</script>';
                    header("refresh:0;url=index.php");

                } else {
                    echo '<script>alert("Add Failed")</script>';
                    header("refresh:0;url=index.php");
                }
            } else {
                echo '<script>alert("All Fields Are Required")</script>';
                header("refresh:0;url=index.php");

            }
        }
    }

    //function to add a delete a car, found by car_id 

    public function delete_car($car_id) {

        if (!empty($car_id)) {
            $result = $this->DB->get("cars", array("car_id" => $car_id));
            if (!empty($result)) {
                $total = $this->DB->delete("cars", array("car_id" => $car_id));
                echo '<script>alert("Car Deleted")</script>';
                header("refresh:0;url=index.php");

            } else {
                header("refresh:0;url=index.php");
                echo '<script>alert("Car Not Found")</script>';
            }
        } else {
            echo '<script>alert("Please enter the car_id")</script>';
            header("refresh:0;url=index.php");

        }
    }

    //function to update a car 
    public function update_car() {

        if (isset($_POST['image']) && isset($_POST['car_name']) && isset($_POST['car_model']) && isset($_POST['car_brand']) && isset($_POST['car_year']) && isset($_POST['price_per_day'])) {
            $car_name = $_POST['car_name'];
            $car_model = $_POST['car_model'];
            $car_brand = $_POST['car_brand'];
            $car_year = $_POST['car_year'];
            $price_per_day= $_POST['price_per_day'];
            $image = $_POST['image'];
            $car_id = $_POST['new_car_id'];

            if (!empty($image) && !empty( $car_name) && !empty($car_model) && !empty($car_brand) && !empty($car_year) && !empty($price_per_day)) {
                $result = $this->DB->get("cars", array('car_id' => $car_id));
            
                if (!empty($result)) {
                $total = $this->DB->update_car("cars", array('car_name' => $car_name, 'car_model' => $car_model, 'car_brand' => $car_brand, 'car_year' => $car_year, 'price_per_day' => $price_per_day, 'image' => $image), $car_id);
                echo '<script>alert("Car Updated")</script>';
                echo '<script>header("Refresh:0")</script>';
            } else {
                echo '<script>alert("Car Not Found")</script>';
            }
            
            }
        }
    }

    //function to show all user - ok
    function list_users() {
        return $this->DB->get('users', null);
    }
}
?>





