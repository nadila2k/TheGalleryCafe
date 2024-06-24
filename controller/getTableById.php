<?php include '../assets/config/conn.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM cafetable WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $table = [
            'id' => $row['id'],
            'name' => $row['name'],
            'quantity' => $row['qty'],
            'description' => $row['description'],
            'image' => $row['image']
        ];
        header('Content-Type: application/json');
        echo json_encode($table);
    } 
}
?>