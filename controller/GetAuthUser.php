
<?php
session_start();
 include "../assets/config/conn.php";
  ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',
    'userLevel' => ""
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->UserName) && isset($userData->pasw)) {
        $userName = mysqli_real_escape_string($conn, $userData->UserName);
        $password = mysqli_real_escape_string($conn, $userData->pasw);

        $sql = "SELECT * FROM user WHERE name = '$userName' AND password = '$password'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            if ($row['type'] == 1) {
                $aResponse = [
                    'status' => true,
                    'message' => 'admin',
                    'userType' => '1'
                ];
            } else if ($row['type'] == 2) {
                $aResponse = [
                    'status' => true,
                    'message' => 'staff',
                    'userType' => '2'
                ];
            } else {
                $aResponse = [
                    'status' => true,
                    'message' => 'client',
                    'userType' => '3'
                ];
            }
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'User name or Password Incorrect'
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

?>