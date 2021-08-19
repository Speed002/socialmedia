<?php
class User{
    private $con;
    private $user;

    public function __construct($con, $user){
        $this->con = $con;
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);//Getting all user details
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getNumPosts(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function getFirstAndLastName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT firstname, lastname FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['firstname'] . " " . $row['lastname'];
    }
}