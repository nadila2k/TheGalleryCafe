<?php include '../assets/config/conn.php'; ?>
<?php
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $userData = json_decode($data);

    if (isset($userData->catName) && isset($userData->food_beverage)) {
        $categoryName = mysqli_real_escape_string($conn, $userData->catName);
        $foodOrBeverage = mysqli_real_escape_string($conn, $userData->food_beverage);


        $sql = "INSERT INTO category (name,food_or_beverage)VALUES ('$categoryName', '$foodOrBeverage')";
                                          
        $res = mysqli_query($conn, $sql);

        if ($res === true) {
            $aResponse = [
                'status' => true,
                'message' => 'Category saved Successfully'
            ];
        }else{
            $aResponse = [
                'status' => true,
                'message' => 'Category saved Unsuccessfully'
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
