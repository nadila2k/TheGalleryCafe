<?php
include '../assets/config/conn.php';
include './../controller/check_session.php';

$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $cartData = json_decode($data);

    if (isset($cartData->date) && isset($cartData->cartTotal) && isset($cartData->itemArray)) {
        $date = mysqli_real_escape_string($conn, $cartData->date);
        $total = mysqli_real_escape_string($conn, $cartData->cartTotal);
        $itemArray = $cartData->itemArray;

        $res = saveDataReservation($conn, $_SESSION['user_id'], $date, $total);

        if ($res === true) {
            $reservation_id = mysqli_insert_id($conn);
            $res = saveCartItem($conn,$itemArray, $reservation_id,);
            if ($res===true) {
                $aResponse = [
                    'status' => true,
                    'message' => 'Reservation and cart items saved successfully.',
                ];
            } else {
                $aResponse = [
                    'status' => false,
                    'message' => 'Failed to insert cart items.',
                ];
            }
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'Failed to save reservation.',
            ];
        }
    }else if(isset($cartData->itemArray) && isset($cartData->tableArray) && isset($cartData->cartTotal)){
        $total = mysqli_real_escape_string($conn, $cartData->cartTotal);
        $itemArray = $cartData->itemArray;
        $tableArray = $cartData->tableArray;
       
    }else if(isset($cartData->tableArray)){
        $tableArray = $cartData->tableArray;
    }else{
        $aResponse = [
            'status' => false,
            'message' => 'Invalid input.',
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($aResponse);
}

function saveDataReservation($conn, $user_id, $date, $total) {
    $sql = "INSERT INTO reservation (client_id, status, date, total) VALUES ('$user_id', 'No', '$date', '$total')";
    return mysqli_query($conn, $sql);
}

function saveCartItem($conn,$itemArray, $reservation_id,) {

    foreach ($itemArray as $item) {
        $item_id = mysqli_real_escape_string($conn, $item->id);
        $price = mysqli_real_escape_string($conn, $item->price);
        $quantity = mysqli_real_escape_string($conn, $item->quantity);

        $sql = "INSERT INTO cart_item (reservation_id, item_id, price, quantity) VALUES ('$reservation_id', '$item_id', '$price', '$quantity')";
        
        if (!mysqli_query($conn, $sql)) {
            return false; // If any query fails, return false
        }
    }
    return true; // If all queries succeed, return true

    
}
?>
