<?php
  session_start();
  include ("../functions.php");
  accessCheck();
?>
<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Forum Page
  This is the HTML and PHP code to view and add to the forum
-->
<html>
  <head>
    <meta http-equiv="refresh" content="10"> <!-- refreshes page every 10 seconds -->
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../images/logo.png">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'> <!-- adds an external font sheet -->
    <title>
      Forum
    </title>
  </head>
  <body>

    <div id="mySidenav" class="sidenav"> <!-- Div that holds all navigation buttons on the sidebar -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><br>
      <img id='logo' src="../images/logo.png" height="60px"> <!-- Adds the website logo to sidebar -->
      <?php
        echo "<h3 id='loggedin'>".displayLogin()."</h3>"; // Displays the currently logged in user
      ?>
      <div id="links">
        <a href="../menu/menu.php">Menu</a>
        <a href="../logout/logout.php">Logout</a>
      </div>
    </div>
    
    <span style="font-size:100px;cursor:pointer;position:fixed;" onclick="openNav()">&#9776;</span> <!-- Includes a hamburger menu that opens the nav bar when clicked -->
    
    <script>
      function openNav() { // Creates a function that expands the sidebar
        document.getElementById("mySidenav").style.width = "230px";
      }
      
      function closeNav() { // Creates a function that collapses the sidebar
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
    
    <h1>Forum</h1>

    <form class="forum" action="forum.php" method="post">
      <br>
      <textarea id="forumTextBox" name="post" rows="5" cols="80" placeholder="Share your thoughts here!"></textarea> <!-- Adds an area for the user to input text -->
      <br><br><br>
      <center><input type="submit" name="submit" value="POST" class=button style="background-color: gray;"></center> <!-- Submit button -->
      <br><br><br>
    </form>
    <script src="../script.js"></script>
    <?php
      if($_POST["submit"] == "POST"){
        echo "<script>document.getElementById('forumTextBox').value = ''</script>";
        echo "<script>localStorage.setItem('forumTextBox', '')</script>";
      }
      date_default_timezone_set("America/New_York"); // Sets timezone (used for the date functionality supported by the date() function)
      $post = $_POST["post"];
      $post = cleanUpText($post); // Applies on of our functions which clears the text of new line spaces and profanity
      $username = $_SESSION["userFull"];
      $fullPost = "\n$username | | $post | | ".date('g:ia j M, Y'); // Organizes the post to include username, text, and date
      $file = "timeline.txt";
      if($_POST["submit"] == "POST" && $post != ""){
        file_put_contents($file, $fullPost, FILE_APPEND); // Writes to the forum file if the user submits
      }
      $discussionFull = explode("\n",file_get_contents($file));
      $discussion = array_reverse($discussionFull); // array of each post, starting with latest
      ?>

    
      <table class=forumOutput>
        <thead>
          <tr> <!-- The following styles the headings for the table -->
            <th style="width:20%;"></th>
            <th style="text-align:left; width:20%;">Name</th>
            <th style="width:10%"></th>
            <th style="text-align:left;">Message</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($discussion as $currentPost) // Loops through each post
            {
              if($currentPost!="")
              {
                $postInfo=explode(" | | ", $currentPost); // Turns the current post into an array
                $name=$postInfo[0];
                $message=$postInfo[1];
                $time=$postInfo[2];
          ?>
          <tr> <!-- The following adds post information to the table -->
            <td id="date"><?php echo $time?></td>
            <td id="name"><?php echo "<b>$name</b>"?></td>
            <td id="bullet"><?php echo "<b><span style='font-size:30px;'>•</span></b>"?></td>
            <td id="message"><?php echo $message?></td>
          </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>

  </body>
</html>