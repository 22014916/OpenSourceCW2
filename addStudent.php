<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

// $doubleIDCheck = mysqli_real_escape_string($conn, $_POST['studentID']);
// $sqlCheck = "SELECT studentid FROM student WHERE studentid = $doubleIDCheck";

// $resultCheck = mysqli_query($conn, $sqlCheck);

// if (isset($_POST['add']))
// {
//   $doubleIDCheck = mysqli_real_escape_string($conn, $_POST['studentID']);
//   $sqlCheck = "SELECT studentid FROM student WHERE studentid = $doubleIDCheck";

//   $resultCheck = mysqli_query($conn, $sqlCheck);
  
//   if ($resultCheck)
//   {
//   echo "<div class='center_tables_forms'><h2>Successfully inserted ID</h2></div>";
//   }
//   else
//   {

//   }
// }

if (isset($_POST['add']) && count($_FILES) > 0)
{
  if (is_uploaded_file($_FILES['studentphotos']['tmp_name'])) 
  {
      $imgData = addslashes(file_get_contents($_FILES['studentphotos']['tmp_name']));
      $imageProperties = getimageSize($_FILES['studentphotos']['tmp_name']);

      $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
      $password = $_POST['password'];
      //HASHED THE PASSWORD
      $hashPassword = mysqli_real_escape_string($conn,password_hash($password,PASSWORD_DEFAULT));
      $DOB = mysqli_real_escape_string($conn,$_POST['DateOfBirth']);
      $firstname = mysqli_real_escape_string($conn,$_POST['FName']);
      $lastname = mysqli_real_escape_string($conn, $_POST['LName']) ;
      $house = mysqli_real_escape_string($conn, $_POST['House']);
      $town = mysqli_real_escape_string($conn,$_POST['Town']) ;
      $county = mysqli_real_escape_string($conn, $_POST['County']);
      $country = mysqli_real_escape_string($conn,$_POST['Country']);
      $postcode = mysqli_real_escape_string($conn,$_POST['Postcode']);

      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentphoto)
      VALUES ('$studentID', '$hashPassword', '$DOB','$firstname', '$lastname', '$house','$town', '$county', '$country','$postcode', '{$imgData}')";
  
      $duplication_sql_id = "SELECT studentid FROM student WHERE studentid = '$studentID'";

      $result = mysqli_query($conn, $sql);
      $resultTwo = mysqli_query($conn, $duplication_sql_id);

    if ($result) 
    {
      echo "<h2>New record created successfully</h2>";
    }
        // if($resultTwo)
        // {
        //     echo "This ID is already taken please choose another";
        // }
        // else 
        // {
        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // mysqli_close($conn);
        // }
  }
}

elseif (isset($_POST['add']))
{
  $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
  $password = $_POST['password'];
  //HASHED THE PASSWORD
  $hashPassword = mysqli_real_escape_string($conn,password_hash($password,PASSWORD_DEFAULT));
  $DOB = mysqli_real_escape_string($conn,$_POST['DateOfBirth']);
  $firstname = mysqli_real_escape_string($conn,$_POST['FName']);
  $lastname = mysqli_real_escape_string($conn, $_POST['LName']) ;
  $house = mysqli_real_escape_string($conn, $_POST['House']);
  $town = mysqli_real_escape_string($conn,$_POST['Town']) ;
  $county = mysqli_real_escape_string($conn, $_POST['County']);
  $country = mysqli_real_escape_string($conn,$_POST['Country']);
  $postcode = mysqli_real_escape_string($conn,$_POST['Postcode']);

  $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentphoto)
  VALUES ('$studentID', '$hashPassword', '$DOB','$firstname', '$lastname', '$house','$town', '$county', '$country','$postcode', '')";

  $result = mysqli_query($conn, $sql);

  if ($result) 
  {
   echo "<h2>New record created successfully</h2>";
  }
}
?>

<div class='center_tables_forms'>
<form name="frmLogin" action="addStudent.php" method="post" enctype= "multipart/form-data" required>
  <div class="mb-3">
    <label>StudentID</label>
    <input name="studentID" type="text" placeholder = "e.g.20000001, 50000000" maxlength ="8" class="form-control" aria-describedby="emailHelp" required>
  <div class="mb-3">
    <label>Student Password</label>
    <input name="password" type="text" placeholder = "e.g.password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student DOB:</label>
    <input name="DateOfBirth" type="date" placeholder = "e.g. 01/02/2000" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student FirstName:</label>
    <input name="FName" type="text" placeholder = "e.g. John" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student Lastname:</label>
    <input name="LName" type="text" placeholder = "e.g. Doe" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student House & Street:</label>
    <input name="House" type="text" placeholder = "e.g. 10 Richmond Lane" class="form-control" required> 
  </div>
  <div class="mb-3">
    <label>Student Town</label>
    <input name="Town" type="text" placeholder = "e.g. Slough" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student County</label>
    <input name="County" type="text" placeholder = "e.g. Berkshire" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student Country</label>
    <input name="Country" type="text" placeholder = "e.g. United Kingdom" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student Postcode</label>
    <input name="Postcode" type="text" placeholder = "e.g. SL2 2PA" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Insert photo ID file:</label>
    <input name="studentphotos" type="file" accept="image/png, image/jpeg" value = "Browse"  class="form-control" >
  </div>
  <button type="submit" name='add' value='Add' class="btn btn-primary">Add</button>
</form>
</div>