<nav class="left-nav">
  <ul id="mainmenu">
    <li><a href="my_ac.php">Your Account</a></li>
    <li><a href="#" id="submenu">Update Account Details</a>
      <ul id = "submenusub" style="display: none">
        <li><a href="upd_user.php" style="font-size: 18px;">Update username</a></li>
        <li><a href="upd_fname.php" style="font-size: 18px;">Update Full name</a></li>
      </ul>
    </li>
</nav>

<script>
  document.getElementById("submenu").onclick = function(){
    if (document.getElementById("submenusub").style.display == 'none'){
      document.getElementById("submenusub").style.display = 'block';
    }
    else{
      document.getElementById("submenusub").style.display = 'none'
    }
  }
</script>