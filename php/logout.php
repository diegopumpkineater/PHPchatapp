<?php
session_start();
include_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"]) && isset($_SESSION["unique_id"])) {
    $query = "UPDATE users SET status = ? WHERE unique_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute(["Offline now", $_SESSION["unique_id"]])) {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
    }
} else if (isset($_SESSION["unique_id"])) {
    header("Location: ../users.php");
} else {
    header("Location: ../login.php");
}
