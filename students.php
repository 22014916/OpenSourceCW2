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

      $data['content'] .= "<form action = 'deletestudents.php' method = 'POST'>";
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='12' align='center'>Students</th></tr>";
      $data['content'] .= "<tr><th>StudentPhoto</th><th>Studentid</th><th>Password</th><th>DOB</th><th>Firstname</th>
      <th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th></tr>";

      // $result  = $conn->query("SELECT * FROM student") or die($conn->error);
      //   $data = $result->fetch_assoc();
      //   echo "<img src='{$data['studentphoto']}'>";

      while($row = mysqli_fetch_array($result)) 
      {
        // $result  = $conn->query("SELECT * FROM student") or die($conn->error);
        // $datas = $result->fetch_assoc();
        // echo "<img src='{$data['studentphoto']}'>";

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

        $data['content'] .= "<input type='submit' name='deleteButton' value='Delete'>";
        $data['content'] .= "</form>";
        
        echo template("templates/default.php", $data);
    } 
    else 
    {
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>
