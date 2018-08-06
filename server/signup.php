<?php
$data = file_get_contents('php://input');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";

$errorMsg = 'Username already exists. Try again.';


if(isset($data)) {

    $data = json_decode($data);

    $name = $data->username;
    $pass = $data->password;

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    // echo $pass;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO user (username, password) VALUES ('$name', '$pass')";
        $result = $conn->exec($sql);




        $last_id = $conn->lastInsertId();
        // echo $last_id;

        echo 'success';
        // if(username exists) {
        //     echo $errorMsg;
        // }

        // json_decode($ddd => 'OK')

        // SQLSTATE[23000]: Integrity constraint violation:
        // 1062 Duplicate entry 'test' for key 'username'

    }
    catch(PDOException $e) {
        // echo $e->getMessage();
        if($e->getCode() === '23000') {
            echo $errorMsg;
        }
    }
}
