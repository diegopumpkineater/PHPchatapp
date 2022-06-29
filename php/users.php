<?php
session_start();
include_once 'config/config.php';

//fetch users from users table
$query = "SELECT * FROM users where unique_id != ?"; //fetch every user except logged in 
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION["unique_id"]]);
$result = $stmt->fetchAll();
$output = "";

if ($result) { //if there are users to chat with
    foreach ($result as $user) {
        $quer = "SELECT * FROM messages WHERE (incoming_msg_id = ? or incoming_msg_id = ?) AND 
        (outgoing_msg_id = ? or outgoing_msg_id =?) ORDER BY msg_id DESC LIMIT 1";
        $stat = $conn->prepare($quer);
        $stat->execute([$user["unique_id"], $_SESSION["unique_id"], $_SESSION["unique_id"], $user["unique_id"]]);
        $res = $stat->fetch();
        if ($res) {
            $msg = $res["msg"];
        } else {
            $msg = "no message Available";
        }
        //trimm message if it is too long
        (strlen($msg) > 28 ? $msg = substr($msg, 0, 28) : $msg = $msg);
        //adding You: to message if it is sent by you
        ($user["unique_id"] == $res["outgoing_msg_id"] ? $you = "" : $you = "You: ");

        ($user["status"] == "Offline now") ? $offline = "offline" : $offline = "";

        $output .= '<a href="chat.php?msg_id=' . $user['unique_id'] . '">
                    <div class="content">
                        <img src="assets/images/' . $user['img'] . '" alt="">
                        <div class="details">
                            <span>' . $user['fname'] . " " . $user['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '">
                        <i class="fas fa-circle"></i>
                    </div>
                </a>';
    }
} else {
    $output = "No users are available to chat with";
}

echo $output;
