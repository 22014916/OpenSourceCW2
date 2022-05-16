<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';
   
   $faker = Faker\Factory::create();

   global $result;
   for ($i = 0; $i <5; $i++)
   {
      $studentid = $faker->numberBetween(20000001, 50000000);
      $password = password_hash($faker->password(), PASSWORD_DEFAULT);
      $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
      $firstname = $faker->firstName($gender = 'male'|'female');
      $lastname = $faker->lastName();
      $streetAddress = $faker->streetAddress();
      $town = "High Wycombe";
      $county = "Buckinghamshrie";
      $country = "United Kingdom";
      $postcode =  "HP1" . $faker->numberBetween(0, 1) . " " . 
      $faker->randomNumber(2, false) . 
      strtoupper($faker->randomLetter()) . strtoupper($faker->randomLetter());
      
      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
      VALUES ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$streetAddress', '$town', '$county', '$country',
       '$postcode')";
       
       $result = mysqli_query($conn, $sql);
   }

   if ($result)
   {
      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");
      echo "<div class='center_tables_forms'><h2>You have successfully generated 5 random records</h2></div>";
      
   }
?>

