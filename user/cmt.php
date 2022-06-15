<?php

    session_start();
    include('../db.php');

    $username = $_SESSION['username'];
    $postid = $_POST['postid'];
    $content = $_POST['content'];

    $query1 = "INSERT INTO `comments`(`username`, `comment`, `post_id`) VALUES ('$username','$content',$postid)";
    $query2 = "UPDATE post SET `comments` = `comments` + 1 WHERE id='$postid'";
    mysqli_query($connection, $query2);
    mysqli_query($connection, $query1);

    $query = "SELECT full_name from users where username='$username'";
    $result = mysqli_query($connection, $query);
    $firstname = mysqli_fetch_array($result);
    $firstname = $firstname['full_name'];

    $query = "SELECT comments from post where id='$postid'";
    $result = mysqli_query($connection, $query);
    $res = mysqli_fetch_array($result);
    $comments = $res['comments'];


    $return_arr = array("firstname"=>$firstname,"content"=>$content,"postid"=>$postid, "date"=>date("m.d.Y"), "comments"=>$comments);

    echo json_encode($return_arr);

?>