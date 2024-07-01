<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $catData = json_decode($data);

    if (isset($catData->id)&&isset($catData->status) ) {
        $id = mysqli_real_escape_string($conn, $catData->id);
        $status = mysqli_real_escape_string($conn, $catData->status);
       
        $sql = "UPDATE reservation SET status = '$status' WHERE id = '$id';";
                       
        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'Reservation Cancel Successfully'
            ];
        }else{
            $aResponse = [
                'status' => false,
                'message' => 'Reservation Cancel Unsuccessfully'
            ];
        }
    } else {
        $aResponse = [
            'status' => false,
            'message' => 'Invalid input'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($aResponse);
}