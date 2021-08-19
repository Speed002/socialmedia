<?php
if(isset($_POST['login_button'])){

    $email = filter_var($_POST['log_email'], FILTER_VALIDATE_EMAIL); // Sanitize email
    $_SESSION['log_email'] = $email; //Store email into the session

    $password = md5($_POST['log_password']); //Get password and hash it

    //check database query
    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password ='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);
    // After checking the number of rows, now fetch them
    //mysqli_num_rows, mysqli_fetch_array
    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        // open closed account
        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email ='$email' AND user_closed = 'yes'");
        if(mysqli_num_rows($user_closed_query) == 1){
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email='$email'");
        }

        // Setting username as a session
        $_SESSION['username'] = $username;
        header('Location:index.php');
        exit();//Why do we exit a function or a condition
    }else{
        array_push($error_array, "Email or password was incorrect<br>");
    }

}