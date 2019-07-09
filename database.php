<?php

include_once 'singelton.php';

class database {

    private $connection;

    public function __construct() {
        $this->connection = singelton::getInstance();
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    //function to insert values into tables

    public function insert($table, $array) {
        $sql = "INSERT INTO $table ";
        $keys = "";
        $values = "";
        foreach ($array as $key => $value) {
            $keys .= $key . ",";
            $values .= "'$value' ,";
        }
        $keys = substr_replace($keys, "", -1);
        $values = substr_replace($values, "", -1);
        $sql .= "($keys) Values ($values)";
        $this->connection->query($sql);
        return true;
    }

    //function to update values from tables

    public function update($table, $array, $user_id) {
        $sql = "Update $table set ";
        foreach ($array as $key => $value) {
            $sql .= "$key = '$value' ,";
        }

        $sql = substr_replace($sql, "", -1);
        $sql .= "Where user_id= '$user_id'";

        $this->connection->query($sql);
        return true;
    }

    //function to delete values from tables

    public function delete($table, $array) {
        $sql = " delete From $table Where ";
        foreach ($array as $key => $value) {
            $sql .= "$key = '$value' AND ";
        }
        $sql = trim($sql, "  AND");
        $result = $this->connection->query($sql);
        return true;
    }

    //function to get values from tables

    public function get($table, $array) {

        $sql = "SELECT * FROM $table WHERE ";
        if ($array != null) {
            foreach ($array as $key => $value) {
                $sql .= "$key = '$value' AND ";
            }
            $sql = trim($sql, "AND ");
        } else {
            $sql = trim($sql, "WHERE ");
        }
        $data = array();
        if ($result = $this->connection->query($sql)) {
            $row_cnt = $result->num_rows;
            for ($i = 0; $i < $row_cnt; $i++) {
                $row = $result->fetch_assoc();
                $data[$i] = $row;
            }
            $result->close();
        }
        return $data;
    }

    public function update_car($table, $array, $car_id) {
         $sql = "Update $table set ";
        foreach ($array as $key => $value) {
             $sql .= "$key = '$value' ,";
         }

         $sql = substr_replace($sql, "", -1);
         $sql .= "Where car_id= '$car_id'";

         $this->connection->query($sql);
         return true;
     }


    //reservation status options:
    // 1. "pending"
    // 2. "confirmed"
    // 3. "denied"

    public function update_reservation_status($table, $array, $reservation_id) {
        $sql = "Update $table set ";
        foreach ($array as $key => $value) {
            $sql .= "$key = '$value' ,";
        }

        $sql = substr_replace($sql, "", -1);
        $sql .= "Where reservation_id = '$reservation_id'";

        $this->connection->query($sql);
        return true;
    }

}
