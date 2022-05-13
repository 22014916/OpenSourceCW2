<?php
include ("students.php");

if (isset($_SESSION['id'])) 
{
   if (empty($_POST['students']))
      {
         die("<h2> PLEASE SELECT A RECORD</h2>");
      }

   foreach ($_POST['students'] as $studentId) 
   {
       $sql = "DELETE FROM student WHERE studentid = $studentId";
       $result = mysqli_query($conn, $sql);

       if ($result)
       {
          echo "<h2> YOU HAVE DELETED THE RECORDS PLEASE REFRESH FOR CHANGES</h2>";
       }
   }
}
?>