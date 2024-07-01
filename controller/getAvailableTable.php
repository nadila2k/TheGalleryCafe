<?php include '../assets/config/conn.php';?>
<?php
$availableTableData = [];
$tableData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->date)) {
        $date = mysqli_real_escape_string($conn, $userData->date);

        $sql = "select
r.id as 'reservation_id',
r.`date` as 'reservation_date',
ct.table_id,
sum(ct.quantity) as 'total_table_booking',
c.qty,
c.qty - sum(ct.quantity) as 'remaing'
from reservation r
left join cart_table ct on ct.reservation_id = r.id
left join cafetable c on c.id = ct.table_id
where r.`date` = '$date'
group by ct.table_id ";

        $res = mysqli_query($conn, $sql);

        while ($rows = mysqli_fetch_assoc($res)) {
            $availableTableData[$rows['table_id']] = [
                'total_table_booking' => $rows['total_table_booking'],
                'remaing' => $rows['remaing']
                
            ];
        }
       

        $sql = "SELECT * FROM cafetable";
        $res = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_assoc($res)) {
            $table_id = $rows['id'];
            $qty = isset($availableTableData[$table_id]) ? $availableTableData[$table_id]['remaing'] : $rows['qty'];

            

            $tableData[] = [
                'id' => $rows['id'],
                'name' => $rows['name'],
                'description' => $rows['description'],
                'qty' => $qty,
                'image' => $rows['image'],
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($tableData);
    }

}
