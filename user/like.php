<?php
    session_start();
    include('../db.php');
    $postid = $_POST['postid'];

    if (!isset($_SESSION['user_role'])){
        header('location: ../login.php');
    }
    else{
        $user = $_SESSION['username'];
        $query = "SELECT count(*) as cnt FROM likes WHERE username='$user' and post_id='$postid'";
        $result = mysqli_query($connection, $query);
        $fetchliked = mysqli_fetch_array($result);
        $liked = $fetchliked['cnt'];

        if ($liked == 1){
            $query = "DELETE FROM likes WHERE username='$user' and post_id='$postid'";
            $query2 = "UPDATE post SET likes=likes-1 WHERE id='$postid'";
            mysqli_query($connection, $query2);
            mysqli_query($connection, $query);
            $liked = 0;
        }
        else{
            $query = "INSERT INTO likes(post_id,username) VALUES('$postid','$user')";
            $query2 = "UPDATE post SET likes=likes+1 WHERE id='$postid'";
            mysqli_query($connection, $query);
            mysqli_query($connection, $query2);
            $liked = 1;
        }

        $query = "SELECT likes FROM post WHERE id='$postid'";
        $result = mysqli_query($connection, $query);
        $fetchliked = mysqli_fetch_array($result);
        $likes = $fetchliked['likes'];

        $return_arr = array("likes"=>$likes,"liked"=>$liked);

        echo json_encode($return_arr);

    }


?>