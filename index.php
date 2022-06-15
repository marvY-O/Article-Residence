<?php include('db.php');  session_start(); ?>

<?php if (isset($_SESSION['user_role'])){
    header('location: user/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <?php include('navbar.php') ?>
    
    <div style="height: 100px;"></div>

    <?php include('showallposts.php') ?>

</body>
</html>
