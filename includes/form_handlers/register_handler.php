<?php
    //Declaring variables
    $fname = ''; //Firstname
    $lname = '';//Lastname
    $em    = '';//Email
    $em2   = '';//Email2
    $password = ''; //Password
    $password2= ''; //Password2
    $date     = ''; //Date of registry
    $error_array = []; //Array holding errors

    if(isset($_POST['register_button'])){
        // Registration form values
        // Firstname
        $fname = strip_tags($_POST['reg_fname']);//Remove html tags
        $fname = str_replace(' ', '', $fname);//Remove empty spaces
        $fname = ucfirst(strtolower($fname)); //Upper case first
        $_SESSION['reg_fname'] = $fname; //store firstname variable in a session

        // Lastname
        $lname = strip_tags($_POST['reg_lname']);//Remove html tags
        $lname = str_replace(' ', '', $lname);//Remove empty spaces
        $lname = ucfirst(strtolower($lname)); //Upper case first
        $_SESSION['reg_lname'] = $lname; //store lastname variable in a session

        // Email
        $em = strip_tags($_POST['reg_email']);//Remove html tags
        $em = str_replace(' ', '', $em);//Remove empty spaces
        $em = ucfirst(strtolower($em)); //Upper case first
        $_SESSION['reg_email'] = $em; //store email variable in a session

        // Email2
        $em2 = strip_tags($_POST['reg_email2']);//Remove html tags
        $em2 = str_replace(' ', '', $em2);//Remove empty spaces
        $em2 = ucfirst(strtolower($em2)); //Upper case first
        $_SESSION['reg_email2'] = $em2; //store email2 variable in a session

        // Password
        $password  = strip_tags($_POST['reg_password']);//Remove html tags
        $password2 = strip_tags($_POST['reg_password2']);//Remove html tags

        // Date
        $date = date('Y-m-d');

        //Email match check
        if($em == $em2){
            //validate email
            if(filter_var($em, FILTER_VALIDATE_EMAIL)){
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                //Check if email already exists
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
                $num_rows = mysqli_num_rows($e_check);

                if($num_rows > 0){
                    array_push($error_array, "Email already exists<br>");
                }

            }else{
                array_push($error_array, "Invalid Email<br>");
            }

        }else{
            array_push($error_array, "Emails Mismatch<br>");
        }

        //checking the length of names
        if(strlen($fname) > 25 || strlen($fname) < 2){
            array_push($error_array, "First Name must be between 2 - 25 characters<br>");
        }
        if(strlen($lname) > 25 || strlen($lname) < 2){
            array_push($error_array, "Last Name must be between 2 - 25 characters<br>");
        }

        //password length check
        if($password != $password2){
            array_push($error_array, "Passwords do not match<br>");
        }else{
            if(preg_match('/[^A-Za-z0-9]/', $password)){
                array_push($error_array, "Password can only contain English Characters and Numbers<br>");
            }
        }

        //Check the length of passwords
        if(strlen($password) > 30 || strlen($password) < 5){
            array_push($error_array, "Password must be between 5 - 30 characters<br>");
        }

        if(empty($error_array)){
            $password = md5($password); //Encrypt the password

            //Generate username by concatenating firstname and lastname
            $username = strtolower($fname.'-'.$lname);
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

            //Adding a number to the username that has been generated
            $i = 0;
            while(mysqli_num_rows($check_username_query) != 0){
                $i++;
                $username = $username.'_'.$i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }

            //Profile picture assignment
            $rand = rand(1,2); // Random Number Between 1 and 2
            if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/24.jpg";
            if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/41.jpg";

            // insert into database
            $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

            array_push($error_array, "<span style='color:green'>You're all set, go ahead an login!</span><br>");

            // clear all fields
            $_SESSION['reg_fname'] = '';
            $_SESSION['reg_lname'] = '';
            $_SESSION['reg_email'] = '';
            $_SESSION['reg_email2'] = '';

        }

    }