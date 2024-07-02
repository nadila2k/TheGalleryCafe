<?php include '../assets/config/conn.php';?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $catData = json_decode($data);
    $reservationItem = [];
    $reservationTable = [];
    if (isset($catData->id)) {
        $id = mysqli_real_escape_string($conn, $catData->id);

        $sql = "select
	r.id as 'reservation_id',
	r.`date` as 'reservation_date',
	r.status as 'reservation_status',
	r.total as 'total_cost',
	ci.id as 'cart_item_id',
	ci.price as 'item_price',
	ci.quantity as 'cart_qty',
	i.name as 'item_name'
from reservation r
inner join cart_item ci on ci.reservation_id = r.id
inner join item i on ci.item_id = i.id
where r.id = $id";

        $res = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_assoc($res)) {
            $reservationItem[] = $rows;
        }

        $sqlTbl = "select
	r.id as 'reservation_id',
	r.`date` as 'reservation_date',
	r.status as 'reservation_status',
	r.total as 'total_cost',
	ct.id as 'cart_table_id',
	ct.quantity as 'table_qty',
	c.name as 'table_name'
from reservation r
inner join cart_table ct on ct.reservation_id = r.id
inner join cafetable c on c.id = ct.table_id
where r.id = '$id'";
          
$resTbl = mysqli_query($conn, $sqlTbl);
while ($rows = mysqli_fetch_assoc($resTbl)) {
    $reservationTable[] = $rows;
}

    }

    header('Content-Type: application/json');
    echo json_encode(['reservationItem' => $reservationItem, 'reservationTable' => $reservationTable]);
}
