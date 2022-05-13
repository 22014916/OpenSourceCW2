<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_POST['add']) && count($_FILES) > 0)
{
    if (is_uploaded_file($_FILES['studentphotos']['tmp_name'])) 
    {
        $imgData = addslashes(file_get_contents($_FILES['studentphotos']['tmp_name']));
        $imageProperties = getimageSize($_FILES['studentphotos']['tmp_name']);

        $studentID = $_POST['studentID'];
        $password = $_POST['password'];
        //HASHED THE PASSWORD
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $DOB = $_POST['DateOfBirth'];
        $firstname = $_POST['FName'];
        $lastname = $_POST['LName'];
        $house = $_POST['House'];
        $town = $_POST['Town'];
        $county = $_POST['County'];
        $country = $_POST['Country'];
        $postcode = $_POST['Postcode'];

        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentphoto)
        VALUES ('$studentID', '$hashPassword', '$DOB','$firstname', '$lastname', '$house','$town', '$county', '$country','$postcode', '{$imgData}')";
  
        $duplication_sql_id = "SELECT studentid FROM student WHERE studentid = $studentID";

        $result = mysqli_query($conn, $sql);
        $resultTwo = mysqli_query($conn, $duplication_sql_id);

        if ($result) 
        {
        echo "New record created successfully";
        }
        elseif($resultTwo)
        {
            echo "This ID is already taken please choose another";
        }
        else 
        {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        }
    }
}
?>

<form name="frmLogin" action="addStudent.php" method="post" enctype= "multipart/form-data">
   Student ID:
   <input name="studentID" type="text" placeholder = "e.g.20000001, 50000000"/>
   <br/>
   Student Password:
   <input name="password" type="text" placeholder = "e.g.password"/>
   <br/>
   Student DOB:
   <input type="date" name="DateOfBirth" placeholder ="e.g. 01/02/2000"/>
   <br/>
   Student FirstName:
   <input name="FName" type="text"  placeholder = "e.g. John" />
   <br/>
   Student Lastname:
   <input name="LName" type="text" placeholder = "e.g. Doe"/>
   <br/>
   Student House & Street:
   <input name="House" type="text" placeholder = "e.g. 10 Richmond Lane"/>
   <br/>
   Student Town
   <input name="Town" type="text" placeholder = "e.g. Slough" />
   <br/>
   Student County
   <input name="County" type="text" placeholder = "e.g. Berkshire"/>
   <br/>
   Student Country
   <input name="Country" type="text" placeholder = "e.g. United Kingdom"/>
   <br/>
   Student Postcode
   <input name="Postcode" type="text" placeholder = "e.g. SL2 2PA"/>
   <br/>
   Insert photo ID file: 
   <input type="file" name = "studentphotos" id="studentphotos" accept="image/png, image/jpeg">
   <br/>
   <input type='submit' name='add' value='Add' class='submitButton'/>
</form>
