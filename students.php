<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   $totalStudentCount = intval("SELECT COUNT (DISTINCT studentid) FROM student");
   
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      $sql = "SELECT * FROM student";
      $result = mysqli_query($conn,$sql);
      
      $data['content'] .= "<div class='center_tables_forms'>";
      $data['content'] .= "<form action = 'deletestudents.php' method = 'POST'>";
      $data['content'] .= "<table class='table table-dark table-striped-columns'";
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr>
        <th>Student Photo</th>
        <th>Student ID</th>
        <th>Password</th>
        <th>Date Of Birth</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>House Address</th>
        <th>Town</th>
        <th>County</th>
        <th>Country</th>
        <th>Postcode</th>
        <th>Select</th>
        </tr>";

      while($row = mysqli_fetch_array($result)) 
      {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td><img src='getimages.php?id=" . $row['studentid'] . "'height='100' width='100'></td>";
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
        $data['content'] .= "<td> <input type= 'checkbox' name='students[]' value='$row[studentid]'> </td>";

        $data['content'] .= "</tr>";
      }
      
      $data['content'] .= "</table>";
      $data['content'] .= "<input type='submit' name='deleteButton' value='Delete' class='btn btn-primary'/>";
      $data['content'] .= "</form>";
        
        echo template("templates/default.php", $data);
    } 
    else 
    {
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>
