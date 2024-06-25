<?php include '../assets/config/conn.php'; ?>


<?php 
function index($conn) {

    $categoryData = [];

    
    $sql = "SELECT item.*, category.name AS category_name, category.food_or_beverage 
    FROM item 
    JOIN category ON item.category_id = category.id"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $categoryData[] = $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($categoryData);

}

index($conn); 

?>