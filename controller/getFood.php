<?php include '../assets/config/conn.php'; ?>


<?php 
function index($conn) {

    $categoryData = [];

    
    $sql = "SELECT * FROM item"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $categoryData[] = $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($categoryData);

}

index($conn); 

?>