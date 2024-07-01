<?php include '../assets/config/conn.php'; ?>
<?php include './../controller/check_session.php';?>


<?php 



function index($conn) {

    $userData = null;
    $id = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM user where id = '$id'"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $userData= $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($userData);

}

index($conn); 

?>