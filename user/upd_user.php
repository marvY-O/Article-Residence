<?php   session_start();

include ('../db.php');

$message = "";
if (isset($_SESSION['user_role']) ){
    if ($_SESSION['user_role'] == 'admin'){
        header('location: ../index.php');
    }
}

if (empty($_SESSION['user_role'])){
    header('location: ../index.php');
}
?>

<?php 
$message = "";
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $cur_user = $_SESSION['username'];
    $password = $_POST['password'];

    $query_retrieve = "SELECT password FROM users WHERE username='$cur_user'";

    $login_user_query = mysqli_query($connection,$query_retrieve);
    
    while($row = mysqli_fetch_assoc($login_user_query)){
        $db_password = $row['password'];

        if(password_verify($password,$db_password)){
            $upd_username = "UPDATE users SET username='$username' WHERE username='$cur_user'";
            $res = mysqli_query($connection, $upd_username);
            if ($res){
                $_SESSION['username'] = $username;
                $message = "<h1 style=\"color: green; text-align: center;\">Username updated successfully!!</h1>";
                mysqli_query($connection, "UPDATE post SET username='$username' WHERE username='$cur_user'");
                mysqli_query($connection, "UPDATE likes SET username='$username' WHERE username='$cur_user'");
                mysqli_query($connection, "UPDATE comments SET username='$username' WHERE username='$cur_user'");
            }
            else{
                $message = "<h1 style=\"color:red; text-align: center;\">Username already exists! Please try another one!</h1>";
            }
        }
        else{
            $message = "<h1 style=\"color:red; text-align: center;\">Wrong password provided!</h1>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Username</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
</head>
<body>
    
    <?php include('../navbar.php') ?>

    <?php include ('leftnavbar.php') ?>

    <div id="empty"></div>

    <?php echo $message ?>

    <nav class="box">
        <form role="form" action="upd_user.php" method="post" class="form">
            <h1 class="center" style="text-align: center;">Update Username</h1>
            <input type="text" id="username" name="username" placeholder="Enter new username"><br>
            <input type="password" id="password" name="password" placeholder="Enter your password"><br>
            <button class="submit"  type="submit" name="submit">Update</button>
        </form>
    </nav>
    

</body>
</html>
