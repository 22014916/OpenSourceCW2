<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   $totalStudentCount = intval("SELECT COUNT (DISTINCT studentid) FROM student");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
    //   $sql = "select * from studentmodules sm, module m where m.modulecode = sm.modulecode and sm.studentid = '" . $_SESSION['id'] ."';";

      $sql = "SELECT * FROM student";
      $result = mysqli_query($conn,$sql);

      // prepare page content
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='5' align='center'>Students</th></tr>";
      $data['content'] .= "<tr><th>Studentid</th><th>Password</th><th>DOB</th><th>Firstname</th>
      <th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th></tr>";

      
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td> {$row["studentid"]} </td>";
        $data['content'] .= "<td> {$row["password"]} </td>";
        $data['content'] .= "<td> {$row["dob"]} </td>";
        $data['content'] .= "<td> {$row["firstname"]} </td>";
        $data['content'] .= "<td> {$row["lastname"]} </td>";
        $data['content'] .= "<td> {$row["house"]} </td>";
        $data['content'] .= "<td> {$row["town"]} </td>";
        $data['content'] .= "<td> {$row["county"]} </td>";
        $data['content'] .= "<td> {$row["country"]} </td>";
        $data['content'] .= "<td> {$row["postcode"]} </td>";

        $data['content'] .= "</tr>";

      }
      $data['content'] .= "</table>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");
?>
