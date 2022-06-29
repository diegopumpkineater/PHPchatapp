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
        <section class="form signup">
            <header>Realtime Chat App Project</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt">This is an Error Text</div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" placeholder="First Name" name="fname">
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name" name="lname">
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" placeholder="Your Email" name="email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" placeholder="Your Password" name="password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="img">
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already Signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
</body>
<script src="assets/js/pass-show-hide.js"></script>
<script src="assets/js/signup.js"></script>

</html>