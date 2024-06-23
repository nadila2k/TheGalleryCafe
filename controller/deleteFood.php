<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $catData = json_decode($data);

    if (isset($catData->catId)) {
        
        $id = mysqli_real_escape_string($conn, $catData->catId);

        $imageQuery = mysqli_query($conn, "SELECT image FROM item WHERE id='$id'");
        $imageRow = mysqli_fetch_assoc($imageQuery);
        $oldImage = $imageRow['image'];
        unlink("../upload/$oldImage");
        

        $sql = "DELETE FROM item WHERE id = '$id';";

        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'Food Delate Successfully'
            ];
        } else {
            $aResponse = [
                'status' => true,
                'message' => 'Food Delate Unsuccessfully'
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
