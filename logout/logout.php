<?php
/*
  Krish Patel and Mika Vohl
  2/20/2023
  Logout Page
  This is the PHP code to logout of your account, every time the user logs out, they are redirected to this page
*/
  session_start();
  session_destroy(); // Resets all the session variables (user's information)
  header("Location: ../loginAndRegister/index.php"); // Redirect to a login page or another page
  exit;
?>
