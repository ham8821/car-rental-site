<?php

include_once 'database.php';
include_once 'user.php';
include_once 'car.php';

class customer extends user {

    private $fname;
    private $lname;
    private $email;
    private $password;
    private $contact_number;
    private $DB;

    public function set_fname($fn) {
        $this->lname = $fn;
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
        $this->DB = new database();
    }

    //Register new costumer

    public function customer_registration() {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['fname']) && isset($_POST['lname']) 
            && isset($_POST['contact_number']) && isset($_POST['email']) && isset($_POST['user_type'])) {

            $user_type = $_POST['user_type'];
            $contact_number = $_POST['contact_number'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_again = $_POST['password_again'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            if (!empty ($user_type) && !empty($fname) && !empty($lname) && !empty($password) && !empty($password_again) && !empty($username) && !empty($contact_number) && !empty($email)) {
                if ($password != $password_again) {
                    echo '<script>alert("Password Doesnot Match")</script>';
                } else {
                    if ($this->DB->get("users", array("username" => $username))) {
                        echo '<script>alert("The username  ' . $username . ' already exists")</script>';
                    } else {

                        //INSERTING A CUSTOMER / ADMIN / STAFF MEMBER

                        if ($this->DB->insert("users", array('fname' => $fname, 'lname' => $lname, 'username' => $username, 'password' => $password, 'email' => $email, 
                            'contact_number' => $contact_number, 'user_type_id' => $user_type))) {

                            echo '<script>alert("Registeration Success ")</script>';
                            header("refresh:1;url=index.php");
                        } else {
                            echo '<script>alert("Registeration Failed ")</script>';
                        }
                    }
                }
            } else {
                echo '<script>alert("All Fields Are Required")</script>';
            }
        }
    }

    //Create a new car reservation
    
    public function new_reservation($days_rented, $rental_cost, $car_id, $start_date, $end_date) {
      
            $user_id = $_SESSION['users']['user_id'];
            $result = $this->DB->insert('reservations', array('car_id' => $car_id, 'user_id' => $user_id, 'start_date' => $start_date, 
            'end_date' => $end_date, 'days_rented' => $days_rented, 'rental_cost' => $rental_cost, 'reservation_status' => 'pending'));

            if ($result) {

                echo '<script>
                              alert("Reservation Successfully register. Thanks!")
                              
                     </script>';

                    //set rented_status = 1, means the car is not available to rent
                    
                    $result = $this->DB->update_car('cars',array('rented_status' => 1), $car_id);
                echo '<script>
                window.location.href = "index.php";
                </script>';
                
            }

    }
}

?>