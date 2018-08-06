

<?php

// header("Access-Control-Allow-Origin: *");
// // "Access-Control-Allow-Origin" : "*",
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// echo 'da';
// $data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
// echo $data[0];
$data = file_get_contents('php://input');

//constants
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vue-form-editor";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO answer (answer) VALUES ('$data')";
    $conn->exec($sql);

    $last_id = $conn->lastInsertId();
    echo $last_id;

}
catch(PDOException $e) {
    echo '<b>Operation that failed:</b> ' . $sql . "<br><b>Error Message:</b> " . $e->getMessage();
}



//
// if(isset($_POST['formID'])){
//     $url = $_POST['formID'];
//
//     try {
//         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//         //insert into db
//         $sth = $conn->prepare("SELECT form FROM form WHERE url='$url'");
//         $sth->execute();
//         $result = $sth->fetch();
//         if($result != false) {
//             echo($result['form']);
//         }
//     }
//     catch(PDOException $e) {
//         echo '<b>Operation that failed:</b> ' . $sql . "<br><b>Error Message:</b> " . $e->getMessage();
//     }
// }



?>
