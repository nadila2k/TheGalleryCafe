<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->name) && isset($userData->type) && isset($userData->password) && isset($userData->tp_number) && isset($userData->address)) {
        
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
        } else {

            $sql = "INSERT INTO user (name,type,password,tp_number,address)VALUES ('$name','$type','$password','$tp_number','$address')";
                                          
        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'User saved Successfully'
            ];
        }else{
            $aResponse = [
                'status' => true,
                'message' => 'User saved Unsuccessfully'
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
