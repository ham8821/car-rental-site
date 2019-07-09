<?php

include_once 'database.php';
include_once 'user.php';


class reservation {

    private $car_id;
    private $user_id;
    private $start_date;
    private $end_date;
    private $days_rented;
    private $rental_cost;
    private $reservation_status;
    private $DB;

    public function __construct() {
        $this->DB = new Database();
    }

    //get all reservations

    public function get_all_reservations() {
        return ($this->DB->get('reservations', null));
    }

    //delete reservation by user_id
    public function delete_reservation($user_id){

        $this->DB->delete('reservations', array('user_id' => $user_id));
    }


    //delete reservation by car_id
    public function delete_reservation_by_car_id($car_id){

        $this->DB->delete('reservations', array('car_id' => $car_id));
    }


    //set the reservation status
    
    public function set_reservation_status($reservation_id, $reservation_status) {

        if (!empty($reservation_id)) {
            $result = $this->DB->get('reservations', array('reservation_id' => $reservation_id));
            if (!empty($result)) {
                $total = $this->DB->update_reservation_status('reservations', array('reservation_status' => $reservation_status), $reservation_id);
           }
      }
    }
}

?>