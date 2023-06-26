<?php
  session_start();
  include ("../functions.php");
  if($_SESSION["userFull"] != ""){
    // Redirects user to menu if logged in
    echo "<script>window.location.href = '../menu/menu.php';</script>";
  }
?>

<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Login Page
  This is the HTML and PHP code to login to your account
-->

<html>
  <head>
    <!-- The following links the page to the stylesheet and font website -->
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
    <title>
      Login
    </title>
    <link rel="icon" href="../images/logo.png">
  </head>
  
  <body>
    <div class="sidebar"> <!-- Div that holds all navigation buttons on the sidebar -->
      <img id='logo' src="../images/logo.png" height="60px">
      <?php
        echo "<h3 id='loggedin'>".displayLogin()."</h3>";
      ?>
      <div id="links">
        <a href="register.php">Register</a>
        <a href="../../index.php">About Assignment</a>
      </div>
    </div>

    <div class="content"> <!-- This div holds the main content of the website (not sidebar) -->
      <h1>LOGIN</h1>
      <center><span style='color: red; font-size:24px; font-family:Noto Sans JP; font-weight:bold;' class=opacity1>Incorrect Credentials</span></center> <!-- Styles text that tells the user that credentials are incorrect -->
      <br><br>
      <center>
        <div class=loginBox>
          <form class="loginRegistration" action="index.php" method="post">
            Enter your first name:
            <br>
            <input type="text" name="firstName" required>
            <br><br>
            Enter your last name:
            <br>
            <input type="text" name="lastName" required>
            <br><br>
            Enter your password:
            <br>
            <input type="password" name="pass" required>
            <br>
            <br>
            <input type="submit" name="submit" class="button" value="Login" style='background-color:blue';>
          </form>
          <br>
          <p>Don't Have an Account?</p>
          <button type="button" class="button"><a href=register.php>Register</a></button><br><br>
        </div>
      </center>
      <br><br><br><br>

      <?php
        echo "<style>.opacity1{opacity:0;}</style>"; // Sets opacity of incorrect credential message to 0 (invisible)
        $loggedInUser = "";
        $userFound;
        $inputFirst = ucfirst(trim(strtolower($_POST["firstName"])));
        $inputLast = ucfirst(trim(strtolower($_POST["lastName"])));
        $inputPass = trim($_POST["pass"]);
        $file = "../userInfo/accounts.txt";

                                  //                  File Output
//*************************************************************************************************************************
                                                                                                               //         *
        $accountsTextInfo = file_get_contents($file);                                                          //         *
                                                                                                               //         *
//*************************************************************************************************************************
  
        $accountsInfo = explode("\n",$accountsTextInfo); // each user's information is in a new array
  
        foreach($accountsInfo as $currentLine){ // iterate's through each user
          $userInfoArray = explode(",", $currentLine); // splits first name, last name, password, and gender into seperate elements in an array
          if(strcasecmp($userInfoArray[0], $inputFirst) == 0 && strcasecmp($userInfoArray[1], $inputLast) == 0 && $userInfoArray[0] != ""){ // if first name and last name entered match
                                                                                                                                           
            if(strcasecmp($userInfoArray[2], $inputPass) == 0) // if the password is matches to the corresponding user
            {
              $userFound = true;
              echo "Login successful"; 
              // sets the user's information in the session variables 
              $loggedInUser = "$inputFirst $inputLast";
              $_SESSION["userFirst"] = $inputFirst;
              $_SESSION["userLast"] = $inputLast;
              $_SESSION["userFull"] = $loggedInUser;
              $_SESSION["test"] = "test from login page";
              echo "<script>window.location.href = '../menu/menu.php';</script>"; //redirects them to the menu page
            }
            else
            {
              echo "<style>.opacity1{opacity:1;}</style>"; // if the password does not match, it tells the user they have entered invalid credentials 
            }
          }
        }
        if($loggedInUser == "" && $userFound!=true && $_POST["submit"]=="Login"){ // if the entered first and last name is not registered 
          echo "<style>.opacity1{opacity:1;}</style>"; // it tells the user they have entered invlid credentials
        }
      ?>
    </div>
  </body>
</html>