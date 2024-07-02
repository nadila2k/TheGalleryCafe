<?php include '../assets/config/conn.php'; ?>


<?php 
function index($conn) {

    $reservationData = [];

    
    $sql = "SELECT
    reservation.id AS reservation_id,
    reservation.client_id,
    user.name AS client_name,
    reservation.status,
    reservation.date,
    reservation.total,
    reservation.time,
    reservation.dineInOrTakeaway
FROM
    reservation
INNER JOIN
    user
ON
    reservation.client_id = user.id;
"; 
    $res = mysqli_query($conn,$sql);
    while ($rows=mysqli_fetch_assoc($res)) {
        $reservationData[] = $rows;
    }

    header('Content-Type: application/json');
        echo json_encode($reservationData);

}

index($conn); 

?>