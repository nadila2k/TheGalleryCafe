<?php include '../assets/config/conn.php'; ?>


<?php 
function index($conn) {

    $userData = [];

    
    $sql = "SELECT * FROM user"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $userData[] = $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($userData);

}

index($conn); 

?>