<?php include "db.php";?>

<?php session_start(); ?>

<?php 

$message = "";
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection,$username);

    $query_retrieve = "SELECT * FROM users WHERE username='$username'";

    $login_user_query = mysqli_query($connection,$query_retrieve);
    
    while($row = mysqli_fetch_assoc($login_user_query)){
        $db_username = $row['username'];
        $db_full_name = $row['full_name'];
        $db_password = $row['password'];
        $db_user_role = $row['user_role'];

        if(password_verify($password,$db_password)){
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_full_name;
            $_SESSION['user_role'] = $db_user_role;

            header("location: userverify.php");
        }
        else{
            $message = "Wrong password provided!";
        }
    }
    if (!$login_user_query){
        $message = "Username does not exist!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include('navbar.php'); ?>

    <div id="empty"></div>

    <?php echo "<h1 style=\"color:red; text-align: center;\">$message</h1>"; ?>

    <nav class="box">
        <form role="form" action="login.php" method="post" class="form">
            <h1 class="center"> Log In </h1>
            <input type="text" id="username" name="username" placeholder="Enter your username" ><br>
            <input type="password" id="password" name="password" placeholder="Enter your password" class="input-reg"><br>
            <button class="submit"  type="submit" name="login">Log In</button>
        </form>
    </nav>

    <div class="smol-box">
        or <a href="register.php" id="link">Register</a>
    </div>
    
</body>
</html>