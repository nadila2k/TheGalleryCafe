<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->name) && isset($userData->type) && isset($userData->password)) {
        $id = mysqli_real_escape_string($conn, $userData->nidme);
        $name = mysqli_real_escape_string($conn, $userData->name);
        $type = mysqli_real_escape_string($conn, $userData->type);
        $password = mysqli_real_escape_string($conn, $userData->password);


        $sql = "INSERT INTO user (name,type,password)VALUES ('$name','$type','$password')";
                                          
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
    } else {
        $aResponse = [
            'status' => false,
            'message' => 'Invalid input'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($aResponse);
}
