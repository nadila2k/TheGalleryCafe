<?php include '../assets/config/conn.php';?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $catData = json_decode($data);

    if (isset($catData->id) && isset($catData->status)) {
        $id = mysqli_real_escape_string($conn, $catData->id);
        $status = mysqli_real_escape_string($conn, $catData->status);

        $sql = "UPDATE reservation SET status = '$status' WHERE id = '$id';";

        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            if ($status == 1) {
                $aResponse = [
                    'status' => true,
                    'message' => 'Reservation Confirm Successfully',
                ];

            } else {
                $aResponse = [
                    'status' => true,
                    'message' => 'Reservation Cancel Successfully',
                ];

            }
        } else {

            if ($status == 1) {
                $aResponse = [
                    'status' => false,
                    'message' => 'Reservation confirm Unsuccessfully',
                ];

            } else {
                $aResponse = [
                    'status' => false,
                    'message' => 'Reservation Cancel Unsuccessfully',
                ];

            }

        }
    } else if (isset($catData->cartItemId) && isset($catData->reservationId) && isset($catData->total)) {
        $cartItemId = mysqli_real_escape_string($conn, $catData->cartItemId);
        $reservationId = mysqli_real_escape_string($conn, $catData->reservationId);
        $total = mysqli_real_escape_string($conn, $catData->total);
        $sql = "UPDATE reservation SET total = '$total' WHERE id = '$reservationId';";
        $res = mysqli_query($conn, $sql);
        if ($res === true) {
            $sql = "DELETE FROM cart_item WHERE id = '$cartItemId';";
            $res = mysqli_query($conn, $sql);
            if ($res === true) {

                $aResponse = [
                    'status' => true,
                    'message' => 'Cart Removed Successfully',
                ];

            } else {

                $aResponse = [
                    'status' => false,
                    'message' => 'Cart Removed Unsuccessfully',
                ];

            }

        }

    } else if(isset($catData->tableId) && isset($catData->reservationId)){
        $reservationId = mysqli_real_escape_string($conn, $catData->reservationId);
        $tableId = mysqli_real_escape_string($conn, $catData->tableId);

        $sql = "DELETE FROM cart_table WHERE id = '$tableId';";
        $res = mysqli_query($conn, $sql);
        if ($res === true) {

            $aResponse = [
                'status' => true,
                'message' => 'Table Removed Successfully',
            ];

        } else {

            $aResponse = [
                'status' => false,
                'message' => 'Table Removed Unsuccessfully',
            ];

        }

    }else{

    }

    header('Content-Type: application/json');
    echo json_encode($aResponse);
}
