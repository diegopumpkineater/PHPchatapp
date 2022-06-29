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
        <section class="users">
            <header>
                <?php
                include_once "php/config/config.php";
                $query = "SELECT * FROM users where unique_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->execute([$_SESSION["unique_id"]]);
                $result = $stmt->fetch();
                ?>
                <div class="content">
                    <img src="assets/images/<?php echo htmlspecialchars($result['img']) ?>" alt="">
                    <div class="details">
                        <span><?php echo htmlspecialchars($result["fname"]) . " " . htmlspecialchars($result["lname"]) ?></span>
                        <p><?php echo htmlspecialchars($result["status"]); ?></p>
                    </div>
                </div>
                <form method="POST" action="php/logout.php">
                    <input type="hidden" name="logout" value="logout">
                    <button type="submit" class="logout">Logout</button>
                </form>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>
</body>
<script src="assets/js/users.js"></script>

</html>