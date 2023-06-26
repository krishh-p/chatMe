<?php
  session_start();
  include ("../functions.php");
  accessCheck();
?>
<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Chat Box Page
  This is the HTML and PHP code to program the chatting functionality for our unit 1 assignment, allowing users to communicate directly
-->
<html>
  <head>
    <meta http-equiv="refresh" content="10"> <!-- refreshes page every 10 seconds -->
    <!-- The following links the page to the stylesheet and font website -->
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../images/logo.png">
    <link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
    <title>
      <?php
        // The following retrieves the data from the form and puts it into corresponding variables
        if($_POST["options"] != ""){
          $_SESSION["chatter"] = $_POST["options"];
        }
        $username = $_SESSION["userFirst"];
        $chatter = $_SESSION["chatter"];
        $chatterFirst = explode(" " ,$chatter);
        echo "$username and $chatterFirst[0]"; // Displays both chatters in the title (ex. Krish Patel and Mika Vohl)
      ?>
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
        <a href="../chats/newChat.php">Select a New Chatter</a>
        <a href="../logout/logout.php">Logout</a>
      </div>
    </div>
    
    <span style="font-size:100px;cursor:pointer;position:fixed;" onclick="openNav()">&#9776;</span>  <!-- Includes a hamburger menu that opens the nav bar when clicked -->
    
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
      <form class="forum" action="chatBox.php" method="post">
        <br><br><br>
        <?php
          echo "<textarea id='chatTextBox' name='chat' rows='6' cols='80' placeholder='Send a message to $chatter:'></textarea>"; // Displays a textbox that allows you to enter the message you would like to send
        ?>
        <br><br>
        <center><input type="submit" class=button style="background-color: gray;" name="sendChat" value="SEND"><center>
        <br><br><br>
      </form>
    </center>
          
    <script src="../script.js"></script>
          
    <?php
      if($_POST["sendChat"] == "SEND"){
        echo "<script>document.getElementById('chatTextBox').value = ''</script>";
        echo "<script>localStorage.setItem('chatTextBox', '')</script>";
      }
      $username = $_SESSION["userFull"];
      date_default_timezone_set("America/New_York"); // Sets the timezone of the user to be New York through a function (used for the date and time)
      $user1 = str_replace(' ', '', $username); // Removes all spaces in the given name
      $user2 = str_replace(' ', '', $chatter); // Removes all spaces in the given name
      // The following makes the file name display the higher name alphabetically first


                      //        Selection
//**********************************************************************************
      if($user1 > $user2){                                               //        *
        $file = "../chatHistories/$user1$user2".".txt";                  //        *
      }                                                                  //        *
      else{                                                              //        *
        $file = "../chatHistories/$user2$user1".".txt";                  //        *
      }                                                                  //        *
      if(file_exists($file)==false)                                      //        *
      {                                                                  //        *
        fopen($file, "a");                                               //        *
      }                                                                  //        *
//**********************************************************************************


      $latestChat = cleanUpText($_POST["chat"]); // Applys the cleanUpText function declared in functions.php to the chat the user inputted

      if($_POST["sendChat"] == "SEND" && $latestChat != ""){ // Runs the following code if the chat is sent
        file_put_contents($file, "\n$username || $latestChat || ".date('g:ia j M, Y'), FILE_APPEND); // Adds a line to the chat history file that contains the username, chat message, and date
      }
      $chatLogsInit = explode("\n", file_get_contents($file)); // Creates an array of chats
      $chatLogs = array_reverse($chatLogsInit); // Sorts the array from latest to oldest
    ?>

    <table border="1" class=forumOutput style='background-color:rgba(102, 204, 0, 0.2);'> <!-- Creates a table for the forum output -->
      <thead>
        <tr>
          <th>Name</th>
          <th>Message</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($chatLogs as $log) // Loops through all chats
          {
            if($log!="")
            {
              $logInfo=explode(" || ", $log); // Creates array of name, message, and time from current chat
              $name=$logInfo[0];
              $message=$logInfo[1];
              $time=$logInfo[2];
        ?>
        <tr>
          <td>
            <?php
              echo $name; // Writes name to table
            ?>
          </td>
          <td>
            <?php
              echo $message; // Writes message to table
            ?>
          </td>
          <td>
            <?php
              echo $time; // Writes time to table
            ?>
          </td>
        </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
  </body>
</html>