<?php 
  if (isset($_SESSION['user_role']) ){
    if ($_SESSION['user_role'] == 'user'){
      $is_user = True;
      $is_admin = False;
    }
    else{
      $is_user = False;
      $is_admin = True;
    }
  }

  if (empty($_SESSION['user_role'])){
      $is_user = False;
      $is_admin = True;
  }
?>

<link rel="stylesheet" href="main.css">
<nav class="top_nav">
  <p><span>Article</span>Residence</p>
  <ul>
    <li>
      <a href="index.php">Home</a>

      <?php 
        if ($is_user){
          echo "<a href=\"my_ac.php\">Your Account</a>";
        }
        if ($is_user){
          echo "<form action=\"../logout.php\" method=\"get\">
          <button type=\"submit\" name=\"logout\" class=\"btn register\"> Log Out </button>
          </form>";
        }
      
        else{
          echo "<button class=\"btn register\" onclick=\"window.location.href = 'register.php'\">Register</button>
          <button class=\"btn login\" onclick=\"window.location.href = 'login.php'\">Log In</button>";
        }
      ?>

      
    </li>
  </ul>
</nav>