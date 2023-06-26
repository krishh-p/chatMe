<?php
  session_start();
  include ("../functions.php");
  if($_SESSION["userFull"] != ""){
    echo "<script>window.location.href = '../menu/menu.php';</script>";
  }
?>
<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Register Page
  This is the PHP and HTML code for the user to register their account
-->

<html>
  <head>
    <!-- The following links the page to the stylesheet and font website -->
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
    <title>
      Register
    </title>
  </head>
  
  <body>
      <div class="sidebar"> <!-- Div that holds all navigation buttons on the sidebar -->
        <img id='logo' src="../images/logo.png" height="60px">
        <?php
          echo "<h3 id='loggedin'>".displayLogin()."</h3>";
        ?>
        <div id="links">
          <a href="index.php">Login</a>
          <a href="../../index.php">About Assignment</a>
        </div>
     </div>
    <div class="content"> <!-- Div that holds all page content apart from the nav bar -->
      <center>
        <h1>REGISTER</h1><br>
      </center> <!-- The following are messages that appear according to different results (account already made, success, unsucessful) -->
        <center>
          <span style='color: red; font-size:24px; font-family:Noto Sans JP; font-weight:bold;' id=opacity1>
            Account already made under that name, registration unsuccessful
          </span>
        </center>

          <center>
            <span style='color: green; font-family:Noto Sans JP; font-size:24px; font-weight:bold;' id=opacity2>
              Your registration was successful, go to login!
            </span>
          </center>
          <form class="loginRegistration" action="register.php" method="post">

          <center>
            <span style='color: red; font-size:24px; font-family:Noto Sans JP; font-weight:bold; 'id=opacity3>
              Your passwords do not match, registration unsuccessful
            </span>
          </center><br><br>

      <center>
        <div class="loginBox"> <!-- Form to enter name and password -->
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
            <br><br>
            
            Confirm your password:
            <br>
            <input type="password" name="confirmPass" required>
            <br><br>
            
            <div id="genders"> <!-- Radio buttons for gender input -->
              Male&nbsp&nbsp<input type="radio" name="gender" value="Male" required>
              <br>
              Female&nbsp<input type="radio" name="gender" value="Female" required>
              <br>
              Other&nbsp&nbsp<input type="radio" name="gender" value="Other" required>
            </div>
        
            <br>
            <input type="submit" class="button" name="submit" value="Register">
          </form><br>
          <p>Already Have an Account?</p>
          <button type="button" class="button" style="background-color:blue;"><a href=index.php>Login</a></button><br>
        </div>
      </center>
      <br><br><br><br>
    </div>
      

    <?php
      echo "<style> #opacity1 {opacity: 0;} #opacity2 {opacity: 0;} #opacity3 {opacity: 0;}</style>"; // Styling the three messages to be invisible
      $alreadyRegistered=false;
      if($_POST["submit"] == "Register") // If the user has pressed the register button
      {
        if($_POST["pass"] == $_POST["confirmPass"]) // If the password matches with the confirmed password
        {
          

                                        //        ALL 3 STRING FUNCTIONS
//*************************************************************************************************************************
                                                                                                               //         *      
          // Format the first and last name with uppercase first letter, rest lowercase, and no whitespace                *
          $firstName = ucfirst(strtolower(trim($_POST["firstName"])));                                         //         *
          $lastName = ucfirst(strtolower(trim($_POST["lastName"])));                                           //         *
                                                                                                               //         *
          $accountData = file_get_contents("../userInfo/accounts.txt");                                        //         *
          $accountDataArray = explode("\n", $accountData);                                                     //         *
                                                                                                               //         *
//*************************************************************************************************************************

          
                                                     //        Repetition
//*********************************************************************************************************************************************
          foreach ($accountDataArray as $account) // Loop through user accounts                                                               *
            {                                                                                                                      //         *
              $accountInfo = explode(",", $account);                                                                               //         *
              if("$accountInfo[0],$accountInfo[1]"=="$firstName,$lastName")                                                        //         *
              {                                                                                                                    //         *
                $alreadyRegistered=true; // If the user has already registered, set alreadyRegistered to true and break the loop              *
                break;                                                                                                             //         *
              }                                                                                                                    //         *
            }                                                                                                                      //         *
//*********************************************************************************************************************************************

          
          if($alreadyRegistered==true)
          {
            echo "<style> #opacity1 {opacity: 1;} #opacity2 {opacity: 0;} #opacity3 {opacity: 0;}</style>"; // if the info entered already exists, a message to the user appears telling them the error, 
          }

          else
          {
            echo "<style> #opacity1 {opacity: 0;} #opacity2 {opacity: 1;} #opacity3 {opacity: 0;}</style>"; // if all the info entered is okay, it tells the user that their account has been created
            $file = "../userInfo/accounts.txt";
            $password = $_POST["pass"];
            $gender = $_POST["gender"];
            $userInfo = "$firstName,$lastName,$password,$gender";

                                             //        File Input
//*********************************************************************************************************************************************
                                                                                                                                   //         *
            file_put_contents($file, "\n".$userInfo, FILE_APPEND); // Write the user information to the text file                             *
                                                                                                                                   //         *
//*********************************************************************************************************************************************
          }
        }
        else
        {
          echo "<style> #opacity1 {opacity: 0;} #opacity2 {opacity: 0;} #opacity3 {opacity: 1;}</style>"; // if their confirm password is different from the entered password, it tells them the error
        }
      }
    ?>
        
  </body>
</html>