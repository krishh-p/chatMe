/*
  Krish Patel and Mika Vohl
  2/20/2023
  Javascript To Keep Text
  This is the Javascript code to keep the text that the user entered in the chat box every time they refresh or come back to the page.
*/

let id = "";
if(document.getElementById('forumTextBox') != null){
  id = "forumTextBox";
}
else if(document.getElementById('chatTextBox') != null){
  id = "chatTextBox";
}
// Get the textbox element
let textbox = document.getElementById(id);
textbox.focus();
// Check if there's a saved value in the storage
let savedValue = localStorage.getItem(id);
if (savedValue) {
  // Set the saved value as the value of the textbox
  textbox.value = savedValue;
}
// Save the value of the textbox to the storage whenever it changes
textbox.addEventListener('input', function() {
  localStorage.setItem(id, textbox.value);
});