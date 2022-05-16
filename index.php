<?php

  //Includes
  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");
  
  //Header
  echo template("templates/partials/header.php");

  //Failed login
  if (isset($_GET['return'])) {

    $msg = "";
    if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
    $data['message'] = "<p><center>$msg<center></p>";

  }

  //Content
  if (isset($_SESSION['id'])) {
    $data['content'] .= "<div class='center_tables_forms'>";
    $data['content'] .= "<h1><center>Welcome to the dashboard<center></h1>";
    echo template("templates/partials/nav.php");
    // $data['content'] .= "<script src='js/globe.js'></script>";
    echo template("templates/default.php", $data);
    $data['content'] .= "</div>";


  } else {

    echo template("templates/login.php", $data);

  }

  //Footer
  echo template("templates/partials/footer.php");

?>
