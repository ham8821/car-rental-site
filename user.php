<?php

class user {

    private $fname;
    private $lname;
    private $email;
    private $password;
    private $contact_number;
    private $user_type_id;
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
    public function set_type_of_user($user_type) {
        $this->user_type_id = $user_type;
    }

    public function get_type_of_user() {
        return $this->user_type_id;
    }

    public function __construct() {
        $this->DB = new database();
    }

    //USERS FUNCTIONS

    //function to manage user login

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (!empty($username) && !empty($password)) {
                $data = $this->DB->get("users", array("username" => $username, "password" => $password));

                if (!empty($data)) {
                               
                    $_SESSION['users'] = $data[0];
                    $user_type = $data[0]['user_type_id'];
                    $user_id = $data[0]['user_id'];
                    
                    //if the user is admin show the list of users

                    if ($user_type == 1) {
                        echo '<script>
                                window.location.href = "list_of_users.php";
                            </script>';
                    } 
                    // if the user is staff or customer show the index page
                    
                    if ($user_type == 2 || $user_type == 3) {
                        echo '<script>
                                window.location.href = "index.php";
                            </script>';
                    } 
                    return true;
                } else {
                    
                    return false;
                }
            }
        }
    }

    //check if the session was started correctly
    public function loggedin() {
        if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            return true;
        } else {
            return false;
        }
    }
}
?>