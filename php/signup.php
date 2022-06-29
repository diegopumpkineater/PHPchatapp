<?php
session_start();
include_once "config/config.php";


$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    //----------check if email is valid----------
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //----------check if email is taken----------
        $query = "SELECT * FROM users where email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetchAll();
        if ($result) {
            echo "Email Already exists";
        } else {
            //----------check if file is uploaded----------
            if (isset($_FILES["img"])) { //if file is uploaded
                $image_name = $_FILES["img"]["name"]; //get file name
                $tmp_name = $_FILES["img"]["tmp_name"]; //get tmp_name to save image in our folder

                //get image extension and check if it is valid
                $image_explode = explode(".", $image_name); //explode image to get its extension
                $image_ext = end($image_explode); // here we get exploded images extension

                $extensions = ["png", "jpeg", "jpg"]; //this is valid extensions for image


                if (in_array($image_ext, $extensions)) { // if true image is valid
                    $time = time(); //current time will be our images name once we will move it to our folder

                    //move uploaded image to our folder
                    $new_image_name = $time . $image_name;
                    if (move_uploaded_file($tmp_name, "../assets/images/" . $new_image_name)) { //this will move uploaded image to new folder
                        $status = "Active now"; //once user is registered or logged in his status will be active now
                        $new_id = rand(time(), 10000000); //creating random id for user
                        $check = true;
                        //this will check if id is already taken
                        while ($check) {
                            $query = "SELECT * FROM users where unique_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->execute([$new_id]);
                            $result = $stmt->fetchAll();
                            if ($result) {
                                $new_id = rand(time(), 10000000); //creating random id for user
                                $check = true;
                            } else {
                                $check = false;
                            }
                        }

                        if (!$check) {
                            $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
                            $query = "INSERT INTO users (unique_id,fname,lname,email,password,img,status) VALUES
                            (?,?,?,?,?,?,?)";

                            $stmt = $conn->prepare($query);
                            if ($stmt->execute([$new_id, $fname, $lname, $email, $password, $new_image_name, $status])) {
                                $_SESSION["unique_id"] = $new_id;
                                echo "success";
                            } else {
                                echo "something went wrong";
                            }
                        }
                    }
                } else {
                    echo "Pls Select an image file - png, jpeg, jpg";
                }
            } else {
                echo "please upload image";
            }
        }
    }
} else {
    echo "all inputs are required";
}
