
<?php
include '../assets/config/conn.php';
$aResponse = [
    'status' => false,
    'message' => 'Data not saved!',

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name'], $_POST['price'],  $_POST['category'], $_POST['available'], $_FILES['image'], $_POST['itemtype'], $_POST['description'])) {
        $name =  $_POST['name'];
        $price =  $_POST['price'];
        $category = $_POST['category'];
        $available = $_POST['available'];
        $itemtype = $_POST['itemtype'];
       
        $description = $_POST['description'];



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

                        $sql = "INSERT INTO item (name, price, image, availability, category_id, type, description) 
                        VALUES ('$name', '$price', '$imageNewName', '$available', '$category', '$itemtype', '$description')";
                        $res = mysqli_query($conn, $sql);



                        if ($res === true) {
                            $aResponse = [
                                'status' => true,
                                'message' => 'Food saved Successfully'
                            ];
                        } else {
                            $aResponse = [
                                'status' => false,
                                'message' => 'Food saved UnSuccessfully!'
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
        $aResponse = [
            'status' => false,
            'message' => 'Invalid input!.'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($aResponse);
}

?>
