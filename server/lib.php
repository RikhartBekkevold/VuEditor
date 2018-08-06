<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";

$conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// database utility
class DBU {

    public static function insertIntoDB($arrayOfValues) {
        $success; // boolean

        //iterate
        foreach ($arrayOfValues as $key => $value) {
            // code...
            // insert $key, $key AS $value, $value
        }

        return $success;
    }

    public static function fetchFromDB() {

    }

    public static function deleteFromDB() {

    }

}

?>
