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
        $time = mysqli_real_escape_string($conn, $cartData->time);
        $dineInOrTakeaway =mysqli_real_escape_string($conn, $cartData->dineInOrTakeaway);
        $res = saveDataReservation($conn, $_SESSION['user_id'], $date, $total,$time,$dineInOrTakeaway);
        

        if ($res === true) {
            $reservation_id = mysqli_insert_id($conn);
            $res = saveCartItem($conn, $itemArray, $reservation_id, );
            if ($res === true) {
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
    } else if (isset($cartData->itemArray) && isset($cartData->tableArray) && isset($cartData->cartTotal)) {
        $total = mysqli_real_escape_string($conn, $cartData->cartTotal);
        $itemArray = $cartData->itemArray;
        $tableArray = $cartData->tableArray;
        $date = $tableArray[0]->date;
        $time = mysqli_real_escape_string($conn, $cartData->time);
        $dineInOrTakeaway = "dineIn";
        $res = saveDataReservation($conn, $_SESSION['user_id'], $date, $total,$time,$dineInOrTakeaway);

        if ($res === true) {
            $reservation_id = mysqli_insert_id($conn);
            $resItems = saveCartItem($conn, $itemArray, $reservation_id);
            $resTable = saveTableArray($conn, $tableArray, $reservation_id);
            if ($resItems === true && $resTable === true) {
                $aResponse = [
                    'status' => true,
                    'message' => 'Reservation, cart items, and table data saved successfully.',
                ];
            } else {
                $aResponse = [
                    'status' => false,
                    'message' => 'Failed to insert cart items or table data.',
                ];
            }
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'Failed to save reservation.',
            ];
        }

    } else if (isset($cartData->tableArray)) {
        $tableArray = $cartData->tableArray;
        $date = $tableArray[0]->date;
        $total = 0;
        $time = mysqli_real_escape_string($conn, $cartData->time);
        $dineInOrTakeaway = "dineIn";
        $res = saveDataReservation($conn, $_SESSION['user_id'], $date, $total,$time,$dineInOrTakeaway);
        if ($res === true) {
            $reservation_id = mysqli_insert_id($conn);
            $resTable = saveTableArray($conn, $tableArray, $reservation_id);
            if ($resTable === true) {
                $aResponse = [
                    'status' => true,
                    'message' => 'Reservation  and table data saved successfully.',
                ];
            } else {
                $aResponse = [
                    'status' => false,
                    'message' => 'Failed to insert  table data.',
                ];
            }
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'Failed to save reservation.',
            ];
        }

    } else {
        $aResponse = [
            'status' => false,
            'message' => 'Invalid input.',
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($aResponse);
}

function saveDataReservation($conn, $user_id, $date, $total,$time,$dineInOrTakeaway)
{
    $sql = "INSERT INTO reservation (client_id, status, date, total,time,dineInOrTakeaway) VALUES ('$user_id', 'No', '$date', '$total','$time','$dineInOrTakeaway')";
    return mysqli_query($conn, $sql);
}

function saveCartItem($conn, $itemArray, $reservation_id, )
{

    foreach ($itemArray as $item) {
        $item_id = mysqli_real_escape_string($conn, $item->id);
        $price = mysqli_real_escape_string($conn, $item->price);
        $quantity = mysqli_real_escape_string($conn, $item->quantity);

        $sql = "INSERT INTO cart_item (reservation_id, item_id, price, quantity) VALUES ('$reservation_id', '$item_id', '$price', '$quantity')";

        if (!mysqli_query($conn, $sql)) {
            return false;
        }
    }
    return true;
}

function saveTableArray($conn, $tableArray, $reservation_id)
{
    foreach ($tableArray as $table) {
        $table_id = mysqli_real_escape_string($conn, $table->id);
        $quantity = mysqli_real_escape_string($conn, $table->quantity);

        $sql = "INSERT INTO cart_table (reservation_id, table_id,quantity) VALUES ('$reservation_id', '$table_id','$quantity')";

        if (!mysqli_query($conn, $sql)) {
            return false;
        }
    }
    return true;
}
