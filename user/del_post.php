<?php

session_start();
include('../db.php');
  $postid = $_POST['postid'];

  $query1 = "DELETE FROM post where id = $postid";
  $query2 = "DELETE FROM likes where post_id = $postid";
  $query3 = "DELETE FROM comments where post_id = $postid";

  mysqli_query($connection, $query1);
  mysqli_query($connection, $query2);
  mysqli_query($connection, $query3);

  $rar = array("del"=> "1");
  echo json_encode($rar);

?>