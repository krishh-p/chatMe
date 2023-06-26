<?php
  session_start();
  include ("../functions.php");
  accessCheck();
?>
<!--
  Krish Patel and Mika Vohl
  2/20/2023
  New Chat Page
  This is the PHP and HTML code to choose a user to chat with
-->
<html>
  <head>
    <!-- The following links the page to the stylesheet and font website -->
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../style.css">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
    <title>
      Chat
    </title>
  </head>
  
  <body>
    <div id="mySidenav" class="sidenav"> <!-- Div that holds all navigation buttons on the sidebar -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><br>
      <img id='logo' src="../images/logo.png" height="60px">
      <?php
        echo "<h3 id='loggedin'>".displayLogin()."</h3>";
      ?>
      <div id="links">
        <a href="../menu/menu.php">Menu</a>
        <a href="../logout/logout.php">Logout</a>
      </div>
    </div>
    
    <span style="font-size:100px;cursor:pointer;position:fixed;" onclick="openNav()">&#9776;</span>
    
    <script>
      function openNav() { // Creates a function that expands the sidebar
        document.getElementById("mySidenav").style.width = "230px";
      }
      
      function closeNav() { // Creates a function that collapses the sidebar
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
    
    <h1>Chat</h1>
    <center>
      <form class="startChat" action="chatBox.php" method="post"> <!-- Form to chat with another user -->
        Select a User to Chat With:
        <br><br>
        <?php

                                                //    Array
//***********************************************************************************************************************************
          $chattableNames = [];                                                                                      //             *
          $filePath = "../userInfo/accounts.txt";                                                                    //             *
          $userFile = explode("\n",file_get_contents($filePath));                                                    //             *
                                                                                                                     //             *
          foreach($userFile as $userLine){ // goes through each user                                                                *
            $userLine = explode(",",$userLine);                                                                      //             *
            $currentName = "$userLine[0] $userLine[1]"; //gets the full name of the user                                            *
            if($currentName != $username)                                                                            //             *
            {                                                                                                        //             *
              array_push($chattableNames, $currentName); //adds the name to the chattableNames array                                *
            }                                                                                                        //             *
          }                                                                                                          //             *
//***********************************************************************************************************************************

        ?>
        
        <select id="options" name="options">
          <?php
            $username = $_SESSION["userFull"];
            foreach ($chattableNames as $name) {
              if($name!=$username)
              {
                echo "<option value='$name'>$name</option>"; // Displays the options of who you can chat with
              }
            }
          ?>
        </select>
  
        <br><br><br><br>
        <input type="submit" name="submit">
      </form>
    </center>
  </body>
</html>