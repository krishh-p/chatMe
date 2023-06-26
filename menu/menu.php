<?php
  session_start();
  include ("../functions.php");
  accessCheck();
?>
<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Menu Page
  This is the PHP and HTML code for a menu that allows the user to navigate to different sections of the website
-->
<html>
  <head>
    <!-- The following links the page to the stylesheet and font website -->
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
    <title>
      Menu
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
        <a href="../logout/logout.php">Logout</a>
        <a href="../../index.php">About Assignment</a>
      </div>
    </div>
    
    <div class="content">
      
      <h1>Menu</h1>
      
      <br><br><br><br>
      
      <center>
        <table class=menuTable>
          <tr>
            <td onclick="location.href='../chats/newChat.php'"> <!-- Button for chatting with people -->
              <img src="../images/chatIcon.png">
              <br><br>
              CHAT WITH SOMEONE!
            </td>
            <td onclick="location.href='../forum/forum.php'"> <!-- Button for entering the forum -->
              <img src="../images/forumIcon.png">
              <br><br>
              FORUM!
            </td>
          </tr>
        </table>
      </center>
    </div>
  </body>
</html>