<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/loginpage.css">
</head>

<form name="frmLogin" action="authenticate.php" method="post">
<div class="container">
  <div class="header">
    <h1>Student Login</h1>
  </div>
<div class="input_area">
 <input type="text" name = "txtid" placeholder="StudentID" />
 <input type="password" name="txtpwd" placeholder="Password" />
</div>
<div class="actions">
 <button type="submit" value="Login">Login</button>
</div>
</div>
  
</form>

</body>
</html>

<?php  echo $message;
?>




