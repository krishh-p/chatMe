<!--
  Krish Patel and Mika Vohl
  2/20/2023
  Functions Page
  This is the PHP code to store the functions for the website, which can be called by any website
-->
<?php


                                        // Custom Function with Return Value
//*************************************************************************************************************************
                                                                                                               //         *
  function displayLogin(){                                                                                     //         *
      $username = $_SESSION["userFull"]; // Gets username from session and stores in variable                             *
      if($username != ""){                                                                                     //         *
        return $username; // Returns the username                                                                         *
      }                                                                                                        //         *
      else{                                                                                                    //         *
        return "Not Logged In"; // If the username is empty, returns "Not Logged In"                                      *
      }                                                                                                        //         *
  }                                                                                                            //         *
//*************************************************************************************************************************                                                                                                             


                                                                // Custom Function with Parameter
//********************************************************************************************************************************************************************************************
                                                                                                                                                                                  //         *
  function cleanUpText($textString){                                                                                                                                              //         *                
    $textString = trim($textString); // removes whitespace at beginning and end of string                                                                                                    *
    $message = str_replace(array("\r", "\n", "  "), " ", $textString); // Replaces all new paragraph spaces with a space                                                                     *
    $find = array("poopy", "stupid", "bad", "crap", "poop"); // Array of profanity that is not allowed on the website                                                                        *
    $message = str_ireplace($find, "****", $message); // Replacing all instances of the profanity words with asterisks                                                                       *
    return $message;                                                                                                                                                              //         *
  }                                                                                                                                                                               //         *
//********************************************************************************************************************************************************************************************


                                                                  // Custom Function
//********************************************************************************************************************************************************************************************
                                                                                                                                                                                  //         *
  function accessCheck(){                                                                                                                                                         //         *
    if(displayLogin() == "Not Logged In"){ // checks if logged in                                                                                                                            *
      echo "<script>window.location.href = 'https://unit1assignment1krishpatelmikavohl.krishpatel102.repl.co/chatMe/loginAndRegister/index.php';</script>"; // Redirects to login page       *
    }                                                                                                                                                                             //         *
  }                                                                                                                                                                               //         *
                                                                                                                                                                                  //         *
//********************************************************************************************************************************************************************************************
?>