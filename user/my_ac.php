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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
</head>
<body>

    <?php echo "<h2>$message</h2>" ?>
    
    <?php include('../navbar.php') ?>

    <?php include ('leftnavbar.php') ?>

    <h1 class="align"> Your Account </h1>

    <table class="align">
    <tr>
        <th>Attribute</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>Username</td>
        <td><?php echo $_SESSION['username']; ?></td>
    </tr>
    <tr>
        <td>Full Name</td>
        <td><?php echo $_SESSION['firstname']; ?></td>
    </tr>
    </table>
    

</body>
</html>
