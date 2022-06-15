<?php 
$message = "";
if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $username = $_SESSION['username'];
    $likes = 0;
    $time = date("Y-m-d H:i:s");
    $content = $_POST['content'];
    $image = $_FILES['fileToUpload']['name'];

    $folder = "../images/".basename($_FILES['fileToUpload']['name']);

    if (file_exists($folder)) {
        $r_temp = mysqli_query($connection, "SELECT max(id) as id from post where 1");
        while ($row = mysqli_fetch_assoc($r_temp)){
            $post_id = $row['id'];
        }
        $post_id = (int)$post_id + 1;
        $path_parts = pathinfo($folder);

        $folder = "../images/".$path_parts['filename']."$post_id.".$path_parts['extension'];
        $image = $path_parts['filename']."$post_id.".$path_parts['extension'];
    }

    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $folder);

    $query_insert = "INSERT INTO `post`(`title`, `username`, `likes`, `time`, `content`, `img`, `comments`) VALUES ('$title','$username','$likes','$time','$content','$image','0')";

    $result = mysqli_query($connection, $query_insert);

    if (mysqli_errno($connection)){
        echo "<h3 style=\"color: red; text-align: center; margin-top: 50px;\">Error Posting!</h3>";
    }
    else{
        echo "<h3 style=\"color: #88f588; text-align: center; margin-top: 50px;\">Posted Successfully!</h3>";
    }
}

?>

<div class="post">
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <h1>New Post</h1>
        <div class="title">
            <h3>Title</h3>
            <input type="text" name="title" placeholder="Enter the title of the post">
        </div>

        <div class="title img">
            <h4>Image</h4>
            <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*"/>
        </div>

        <div class="title content">
            <h3>Content</h3>
            <textarea name="content" cols="10" rows="10"></textarea>
        </div>
        <button type="submit" name="submit" class="btn-post">Post</button>
    </form>
</div>