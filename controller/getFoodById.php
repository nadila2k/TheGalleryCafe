<?php include '../assets/config/conn.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM item WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $food = [
            'id' => $row['id'],
            'name' => $row['name'],
            'category_id' => $row['category_id'],
            'type' => $row['type'],
            'description' => $row['description'],
            'price' => $row['price'],
            'availability' => $row['availability'],
            'image' => $row['image']
        ];
        header('Content-Type: application/json');
        echo json_encode($food);
    } 
}
?>


