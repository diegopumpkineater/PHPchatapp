<?php
session_start();
include_once "config/config.php";

$email = $_POST["email"];
$password = $_POST["password"];


if (!empty($email) && !empty($password)) { //check if email and password is not send
    //checking users entered email and password in database
    $query = "SELECT * FROM users where email = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch();
    if ($result) { //check if email is in database
        if (password_verify($password, $result["password"])) { //check if password is valid
            $_SESSION["unique_id"] = $result["unique_id"]; // session unique_id 
            $query = "UPDATE users SET status = ? WHERE unique_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute(["Active now", $result["unique_id"]]);
            echo "User exists";
        } else {
            echo "Email or Password is Incorrect";
        }
    } else {
        echo "Email or Password is Incorrect";
    }
} else {
    echo "all inputs are required";
}
