<?php include "db.php";?>

<?php 
$message = "";
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query_insert = "INSERT INTO users(username,full_name,password,user_role) VALUES ('{$username}','{$full_name}','{$password}', 'user')";

    $stmt = mysqli_prepare($connection,$query_insert);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    if ($stmt){
        $message = "<h1 style=\"color:green; text-align: center;\">User Created Successfully!</h1>";
    }
    else{
        $message = "<h1 style=\"color:red; text-align: center;\">There was some error creating the user!</h1>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include('navbar.php'); ?>

    <div id="empty"></div>

    <?php echo $message; ?>
    <nav class="box">
        <form role="form" action="register.php" method="post" class="form">
            <h1 class="center"> Register </h1>
            <input type="text" id="username" name="username" placeholder="Create a username"><br>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name"><br>
            <input type="password" id="password" name="password" placeholder="Enter a password"><br>
            <input type="password" id="conf_password" name="conf_password" placeholder="Confirm password"><br>
            <button class="submit"  type="submit" name="submit">Register</button>
        </form>
    </nav>

    <div class="smol-box">
        or <a href="login.php" id="link">Log In</a>
    </div>
    
</body>
</html>