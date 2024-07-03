<?php
include '../assets/config/conn.php';

$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
   

    // Check if an image is uploaded
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
                        
                        $imageQuery = mysqli_query($conn, "SELECT image FROM events WHERE id='$id'");
                        $imageRow = mysqli_fetch_assoc($imageQuery);
                        $oldImage = $imageRow['image'];
                        unlink("../upload/$oldImage");

                        
                        $sql = "UPDATE events SET name='$name', description='$description', price='$price', image='$imageNewName' WHERE id='$id'";

                        if (mysqli_query($conn, $sql)) {
                            $aResponse = [
                                'status' => true,
                                'message' => 'Event updated successfully.'
                            ];
                        } else {
                            $aResponse = [
                                'status' => false,
                                'message' => 'Failed to update event.'
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
        // No new image uploaded, update other fields only
        $sql = "UPDATE events SET name='$name', description='$description', price='$price' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            $aResponse = [
                'status' => true,
                'message' => 'Event updated successfully.'
            ];
        } else {
            $aResponse = [
                'status' => false,
                'message' => 'Failed to update event.'
            ];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($aResponse);
?>
