<?php
session_start();
include_once 'config/config.php';

echo $_SESSION["unique_id"];

if (isset($_SESSION["unique_id"])) {
    echo "how are you";
    $incoming_id = $_POST["incoming_id"];
    $outgoing_id = $_POST["outgoing_id"];
    $message = $_POST["message"];
    if (!empty($message) && !empty($incoming_id) && !empty($outgoing_id)) {
        $query = "INSERT INTO messages (incoming_msg_id,outgoing_msg_id,msg) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute([$incoming_id, $outgoing_id, $message])) {
        } else {
            echo "something wrong happened";
        };
    } else {
        echo "something bad happend";
    }
} else {
    header("Location: ../login.php");
}
