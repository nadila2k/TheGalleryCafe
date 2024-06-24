<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->name) && isset($userData->type) && isset($userData->password) && isset($userData->id)) {

        $id = mysqli_real_escape_string($conn, $userData->id);
        $name = mysqli_real_escape_string($conn, $userData->name);
        $type = mysqli_real_escape_string($conn, $userData->type);
        $password = mysqli_real_escape_string($conn, $userData->password);

        $sql = "UPDATE user SET name='$name', type='$type', password='$password' WHERE id='$id'";
                       
        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'User Update Successfully'
            ];
        }else{
            $aResponse = [
                'status' => false,
                'message' => 'User Update Unsuccessfully'
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