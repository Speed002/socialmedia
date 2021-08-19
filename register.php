<?php
    //Requires
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php';
    require 'includes/form_handlers/login_handler.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/register.js"></script>
    <title>Register|SocialMedia</title>
</head>
<body>

    <?php
        if(isset($_POST['register_button'])){
            echo "
                <script>
                    $(document).ready(function(){
                        $('#first').hide();
                        $('#second').show();
                    });
                </script>
            ";
        }
    ?>

    <!-- //wrapper -->
    <div class="wrapper">
        <div class="login_box">

            <div id="first" class="first">
                <form action="register.php" method="post">
                    <input type="email" name="log_email" placeholder="Email Address" value="<?php echo isset($_SESSION['log_email']) ? $_SESSION['log_email'] : '' ;?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Password">
                    <br>
                    <?php echo in_array("Email or password was incorrect<br>", $error_array) ? "Email or password was incorrect<br>" : '' ;?>

                    <a href="#" id="signup" class="signup">Need an account? Sign Up Here!</a>
                    <input type="submit" name="login_button" value="Login">
                </form>
            </div>

            <div id="second" class="second">
                <form action="register.php" method="post">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php echo isset($_SESSION['reg_fname']) ? $_SESSION['reg_fname'] : '' ;?>" required>
                    <br>
                    <!-- display errors -->
                    <?php echo in_array("First Name must be between 2 - 25 characters<br>", $error_array) ? "First Name must be between 2 - 25 characters<br>" : '' ;?>

                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php echo isset($_SESSION['reg_lname']) ? $_SESSION['reg_lname'] : '' ;?>" required>
                    <br>
                    <!-- display the errors -->
                    <?php echo in_array("Last Name must be between 2 - 25 characters<br>", $error_array) ? "Last Name must be between 2 - 25 characters<br>" : '' ;?>

                    <input type="email" name="reg_email" placeholder="Email" value="<?php echo isset($_SESSION['reg_email']) ? $_SESSION['reg_email'] : '' ;?>" required>
                    <br>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php echo isset($_SESSION['reg_email2']) ? $_SESSION['reg_email2'] : '' ;?>" required>
                    <br>
                    <!-- display the errors -->
                    <?php echo in_array("Email already exists<br>", $error_array) ? "Email already exists<br>" : '' ;?>
                    <?php echo in_array("Invalid Email<br>", $error_array) ? "Invalid Email<br>" : '' ;?>
                    <?php echo in_array("Emails Mismatch<br>", $error_array) ? "Emails Mismatch<br>" : '' ;?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <!-- display errors -->
                    <?php echo in_array("Passwords do not match<br>", $error_array) ? "Passwords do not match<br>" : '' ;?>
                    <?php echo in_array("Password can only contain English Characters and Numbers<br>", $error_array) ? "Password can only contain English Characters and Numbers<br>" : '' ;?>
                    <?php echo in_array("Password must be between 5 - 30 characters<br>", $error_array) ? "Password must be between 5 - 30 characters<br>" : '' ;?>
                    <?php echo in_array("<span style='color:green'>You're all set, go ahead an login!</span><br>", $error_array) ? "<span style='color:green'>You're all set, go ahead an login!</span><br>" : '' ;?>
                    
                    <input type="submit" value="Register" name="register_button">
                    <br>
                    <a href="#" id="login" class="login">Have an account? Login Here!</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>