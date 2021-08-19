<?php
    require 'config/config.php'; 

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }else{
        header("Location:register.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- js -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <title>Social Media</title>
</head>
<body>

    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Feeder</a>
        </div>

        <nav>
            <a href="<?php echo $userLoggedIn; ?>"><?php echo $user['username']; ?></a>
            <a href="#">Home</a>
            <a href="#">messages</a>
            <a href="#">notis</a>
            <a href="#">requests</a>
            <a href="#">setngs</a>
            <a href="includes/handlers/logout.php">logout</a>
        </nav>
    </div>

    <!-- wrapper -->
    <div class="wrapper">