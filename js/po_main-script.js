"use strict";

function showadditem() {
  //set the width and height of the
  //pop up window in pixels
  var width = 1700;
  var height = 800;

  //Get the TOP coordinate by
  //getting the 50% of the screen height minus
  //the 50% of the pop up window height
  var top = parseInt(screen.availHeight / 2 - height / 2);

  //Get the LEFT coordinate by
  //getting the 50% of the screen width minus
  //the 50% of the pop up window width
  var left = parseInt(screen.availWidth / 2 - width / 2);

  //Open the window with the
  //file to show on the pop up window
  //title of the pop up
  //and other parameter where we will use the
  //values of the variables above
  window.open(
    "main/addrecord/addpo.php",
    "Contact The Code Ninja",
    "menubar=no,resizable=no,width=1900,height=1000,scrollbars=yes,left=" +
      left +
      ",top=" +
      top +
      ",screenX=" +
      left +
      ",screenY=" +
      top
  );
}
