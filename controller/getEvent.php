<?php include '../assets/config/conn.php'; ?>

<?php 
function index($conn) {
    $tableData = [];
    
    $sql = "SELECT * FROM events"; 
    $res = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($res)) {
        $tableData[] = $rows;
    }

    header('Content-Type: application/json');
    echo json_encode($tableData);
}

index($conn); 
?>
