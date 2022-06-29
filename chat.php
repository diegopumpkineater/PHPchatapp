<?php
session_start();
if (!isset($_SESSION["unique_id"])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chat Anyone</title>
</head>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/config/config.php";
                $query = "SELECT * FROM users where unique_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->execute([$_GET["msg_id"]]);
                $result = $stmt->fetch();
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="assets/images/<?php echo htmlspecialchars($result['img']) ?>" alt="">
                <div class="details">
                    <span><?php echo htmlspecialchars($result["fname"]) . " " . htmlspecialchars($result["lname"]) ?></span>
                    <p><?php echo htmlspecialchars($result["status"]); ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" class="typing-area">
                <input type="hidden" name="outgoing_id" value="<?php echo htmlspecialchars($_SESSION['unique_id']) ?>">
                <input type="hidden" name="incoming_id" value="<?php echo htmlspecialchars($_GET['msg_id']) ?>">
                <input type="text" name="message" class="input-field" placeholder="Sent Message">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
</body>
<script src="assets/js/chat.js"></script>

</html>