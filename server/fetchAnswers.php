<?php
//constants
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";


// if(isset($_POST['formID'])){
    $url = 1; // $_POST['formID'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sth = $conn->prepare("SELECT answer FROM answer WHERE formID='$url'");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($result != false) {

            // var_dump($result);
            // $result = stripslashes(json_encode($result));
                        // $result = json_decode($result);
            echo str_replace('\\/', '/', json_encode($result));
            //regex to remove all slashes

            // var_dump($result[0]);
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
// }



?>
