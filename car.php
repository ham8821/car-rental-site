<?php

include_once 'database.php';

class car {

    private $car_name;
    private $car_id;
    private $car_brand;
    private $car_model;
    private $car_year;
    private $price_per_day;
    private $rented_status;
    private $DB;

    function __construct() {
        $this->DB = new Database();
    }

    public function set_car_name($cname) {
        $this->car_name = $cname;
    }

    public function get_car_name() {
        return $this->car_name;
    }

    public function set_car_id($c_id) {
        $this->car_id = $c_id;
    }

    public function get_car_id() {
        return $this->car_id;
    }

    public function set_car_brand($brand) {
        $this->car_brand = $brand;
    }

    public function get_car_brand() {
        return $this->car_brand;
    }

    public function set_car_model($model) {
        $this->car_model = $model;
    }

    public function get_car_model() {
        return $this->car_model;
    }

    public function set_car_year($year) {
        $this->car_year= $year;
    }

    public function get_car_year() {
        return $this->car_year;
    }

    public function set_price_per_day($price) {
        $this->price_per_day = $price;
    }

    public function get_price_per_day() {
        return $this->price_per_day;
    }
    public function set_rented_status($status) {
        $this->rented_status = $status;
    }

    public function get_rented_status() {
        return $this->rented_status;
    }

    public function get_all_cars() {
        return $this->DB->get('cars', null);
    }

    // Get all details for an specific car
    
    public function get_car_details($car_id) {
        return ($this->DB->get('cars', array('car_id' => $car_id))[0]);
    }
}

?>