<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not Delete!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->name) && isset($userData->type) && isset($userData->password) && isset($userData->id) && isset($userData->tp_number) && isset($userData->address)) {

        
        $id = mysqli_real_escape_string($conn, $userData->id);
        $name = mysqli_real_escape_string($conn, $userData->name);
        $type = mysqli_real_escape_string($conn, $userData->type);
        $password = mysqli_real_escape_string($conn, $userData->password);
        $tp_number = mysqli_real_escape_string($conn, $userData->tp_number);
        $address = mysqli_real_escape_string($conn, $userData->address);

        $sql = "SELECT id FROM user WHERE name='$name'";
        $checkRes = mysqli_query($conn, $sql);

        if (mysqli_num_rows($checkRes) > 0) {
            $aResponse = [
                'status' => false,
                'message' => 'Username already exists',
            ];
        }else{

            $sql = "UPDATE user SET name='$name', type='$type', password='$password' ,tp_number='$tp_number',address ='$address' WHERE id='$id'";
                       
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