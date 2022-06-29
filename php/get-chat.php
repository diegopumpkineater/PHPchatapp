<?php
session_start();
include_once "config/config.php";

if (isset($_SESSION["unique_id"])) {
    $outgoing_id = $_POST["outgoing_id"];
    $incoming_id = $_POST["incoming_id"];
    $output = "";
    $query = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
    where (outgoing_msg_id = ? AND incoming_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY msg_id ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute([$outgoing_id, $incoming_id, $incoming_id, $outgoing_id]);
    $result = $stmt->fetchAll();
    if ($result) {
        foreach ($result as $message) {
            if ($message["outgoing_msg_id"] == $outgoing_id) {
                $output .=  '<div class="chat outgoing">
                    <div class="details">
                        <p>' . $message['msg'] . '</p>
                    </div>
                </div>';
            } else {
                $output .= '<div class="chat incoming">
                    <img src="assets/images/' .  $message['img'] . '" alt="">
                    <div class="details">
                        <p>' . $message["msg"] . '</p>
                    </div>
                </div>';
            }
        }
        echo $output;
    } else {
        echo $output;
    }
} else {
    header("Location: login.php");
}
