<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";



$id = 4;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // select all forms from the form table where the userID matches id recieved
    $sth = $conn->prepare("SELECT * FROM form WHERE userID = '$id'");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    if($result != false) {

        // var_dump($result);
        // $result = stripslashes(json_encode($result));
                    // $result = json_decode($result);

                    // loop and reutn each?
    // foreach ($result as $key) {
        $item = json_encode($result);
        // implode(" ", $key);
        echo $item;
        // echo str_replace('\\/', '/', $item);
    // }
                    // fetch assoc get all results in array
                    // echo $result;


        // echo str_replace('\\/', '/', json_encode($result));
        //regex to remove all slashes

        // echo($result[0]);
        // echo "<br>";
        // var_dump($result[1]);
        // echo "<br>";
        // var_dump($result[2]);

        // echo $result
    }
}
catch(PDOException $e) {
    echo '<b>Operation that failed:</b> ' . $sql . "<br><b>Error Message:</b> " . $e->getMessage();
}




?>
