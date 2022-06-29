<?php
session_start();
if (isset($_SESSION["unique_id"])) {
    header("Location: users.php");
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
        <section class="form login">
            <header>Realtime Chat App Project</header>
            <form action="#">
                <div class="error-txt">This is an Error Text</div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" placeholder="Enter Your Email" name="email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" placeholder="Enter Your Password" name="password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet Signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>
</body>
<script src="assets/js/pass-show-hide.js"></script>
<script src="assets/js/login.js"></script>

</html>