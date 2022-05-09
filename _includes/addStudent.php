<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

function AddStudentButton()
{
    if  (isset($_POST['addstudent']))
    {
        $studentID = $_POST['studentid'];
        //HASH THE PASSWORD
        $password = $_POST['password'];
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        //Turn it into DOB data type not string
        $stringDOB = $_POST['DOB'];
        $DOB = strtotime($stringDOB);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $house = $_POST['house'];
        $town = $_POST['town'];
        $county = $_POST['county'];
        $country = $_POST['country'];
        $postcode = $_POST['postcode'];

        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
        VALUES ('$studentID', '$password', '$DOB','$firstname', '$lastname', '$house','$town', '$county', '$country','$postcode')";

        if (mysqli_query($conn, $sql)) 
        {
        echo "New record created successfully";
        } 
        else 
        {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        }
    }
}

?>

<form name="frmLogin" action="addStudent.php" method="post">
   Student ID:
   <input name="studentID" type="text" value = "studentid"/>
   <br/>
   Student Password:
   <input name="password" type="text" value = "password"/>
   <br/>
   Student DOB:
   <input name="DOB" type="text" value = "DOB"/>
   <br/>
   Student FirstName:
   <input name="FName" type="text" = value = "firstname" />
   <br/>
   Student Lastname:
   <input name="LName" type="text" value = "lastname"/>
   <br/>
   Student House:
   <input name="House" type="text" value = "house"/>
   <br/>
   Student Town
   <input name="Town" type="text" value = "town" />
   <br/>
   Student County
   <input name="County" type="text" value = "county"/>
   <br/>
   Student Country
   <input name="Country" type="text" value = "country"/>
   <br/>
   Student Postcode
   <input name="Postcode" type="text" value = "postcode"/>
   <br/>
   
   <label for = "Image">Upload Image</label>
   <input type="file" id="myFile" name="filename">

   <label for="Add">Add</label>
   <button name="AddingStudent" type="button" value="addstudent" onclick = AddStudentButton()>Add</button>
</form>
