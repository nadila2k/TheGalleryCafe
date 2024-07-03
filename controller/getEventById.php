<?php
include '../assets/config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM events WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $table = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'image' => $row['image']
            ];

            header('Content-Type: application/json');
            echo json_encode($table);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Event not found']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request, ID parameter missing']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
