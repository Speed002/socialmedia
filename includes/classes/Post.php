<?php
class Post{
    private $con;
    private $user_obj;

    public function __construct($con, $user){
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to){
        $body = strip_tags($body); // Strip any html tags
        $body = mysqli_real_escape_string($this->con, $body); // Escape any ' wc could be a new query

        $body = str_replace('\r\n', '\n', $body); // replace new line breaks with new line
        $body = nl2br($body); //line breaks
        $check_empty = preg_replace('/\s+/', '', $body); // Look spaces and remove them

        if($check_empty != ""){
            //current date and time
            $date_added = date('Y-m-d H:i:s');
            $added_by = $this->user_obj->getUsername();
            // if user is on own profile, user_to = none
            if($user_to == $added_by){
                $user_to = 'none';
            }

            // insert post
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES ('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            // this returns the id of the post that has just gone in
            $returned_id = mysqli_insert_id($this->con);

            //Insert notification

            //Update post count for user
            $num_posts= $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username = '$added_by'");
        }
    }

    public function loadPostsFriends(){
        $str = "";//String to return 
        $data = mysqli_query($this->con, "SELECT * FROM posts WHERE delete='no' ORDER BY id DESC");

        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            //prepare user_string so it can be included even if not posted to a user
            if($row['user_to'] == 'none'){
                
            }else{
                $user_to_obj = new User($this->con, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "<a href='".$row['user_to']."'>".$user_to_name."</a>";
            }
        }
    }
}