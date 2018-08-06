<?php

$data = file_get_contents('php://input');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";



if(isset($data)) {


    try {
        $data = json_decode($data);

        $name = $data->username;
        $pass = $data->password;

        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sth = $conn->prepare("SELECT * FROM user WHERE username = '$name'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if($result != false) {
            if(password_verify($pass, $result[0]['password']) === true) {
                echo 'logged in';
                // echo 'Password correct';
            }
            else {
                echo 'Password incorrect';
            }
        }
        else {
            echo "Username doesn't exists";
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        // $e->getCode();
    }
}
