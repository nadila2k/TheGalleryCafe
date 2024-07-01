<?php include '../assets/config/conn.php'; ?>
<?php include './../controller/check_session.php';?>


<?php 



function index($conn) {

    $reservationData = [];
    $client_id = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM reservation where client_id = '$client_id'"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $reservationData[]= $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($reservationData);

}

index($conn); 

?>