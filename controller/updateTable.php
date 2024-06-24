<?php
include '../assets/config/conn.php';
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',

];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];


    if (!empty($_FILES['image']['name'])) {

        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];
        $imageType = $image['type'];

        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageExt, $allowedTypes)) {
            if ($imageError === 0) {
                if ($imageSize <= 500000000) {
                    $imageNewName = uniqid('', true) . "." . $imageExt;
                    $imagePath = '../upload/' . $imageNewName;

                    if (move_uploaded_file($imageTmpName, $imagePath)) {
                        $imageQuery = mysqli_query($conn, "SELECT image FROM cafetable WHERE id='$id'");
                        $imageRow = mysqli_fetch_assoc($imageQuery);
                        $oldImage = $imageRow['image'];
                        unlink("../upload/$oldImage");
                
                        $sql = "UPDATE cafetable SET name='$name', qty='$quantity',  image='$imageNewName', description='$description' WHERE id='$id'";
                
                        if (mysqli_query($conn, $sql)) {
                            $aResponse = [
                                'status' => true,
                                'message' => 'Table updated successfully.'
                            ];
                        } else {
                            $aResponse = [
                                'status' => false,
                                'message' => "Failed to update Table item."
                            ];
                        }
                    } else {
                        $aResponse = [
                            'status' => false,
                            'message' => 'Image upload failed!'
                        ];
                    }
                } else {
                    $aResponse = [
                        'status' => false,
                        'message' => 'Sorry, your file is too large.'
                    ];
                }
            } else {
                $aResponse = [
                    'status' => false,
                    'message' => 'There was an error uploading your file.'
                ];
            }
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed.'
            ];
        }
    } else {

        $imageQuery = mysqli_query($conn, "SELECT image FROM cafetable WHERE id='$id'");
        $imageRow = mysqli_fetch_assoc($imageQuery);
        $image = $imageRow['image'];

        $sql = "UPDATE cafetable SET name='$name', qty='$quantity',  image='$image', description='$description' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            $aResponse = [
                'status' => true,
                'message' => 'Table updated successfully.'
            ];
        } else {
            $aResponse = [
                'status' => false,
                'message' => "Failed to update Table."
            ];
        }
    }
    header('Content-Type: application/json');
    echo json_encode($aResponse);
}
