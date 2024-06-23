<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $catData = json_decode($data);

    if (isset($catData->id)&&isset($catData->name)) {
        $id = mysqli_real_escape_string($conn, $catData->id);
        $name = mysqli_real_escape_string($conn, $catData->name);
        $sql = "UPDATE category SET name = '$name' WHERE id = '$id';";
                       
        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'Category Update Successfully'
            ];
        }else{
            $aResponse = [
                'status' => false,
                'message' => 'Category Update Unsuccessfully'
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