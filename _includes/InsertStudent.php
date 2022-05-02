<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';
   
   $faker = Faker\Factory::create();


   for ($i = 0; $i <5; $i++)
   {
      $studentid = $faker->numberBetween(20000001, 99999999);
      $password = password_hash($faker->password(), PASSWORD_DEFAULT);
      $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
      $firstname = $faker->firstName($gender = null | 'male'|'female');
      $lastname = $faker->lastName();
      $streetAdress = $faker->streetAddress();
      $town = "High Wycombe";
      $county = "Buckinghamshrie";
      $country = "United Kingdom";
      $postcode =  "HP1" . $faker->numberBetween(0, 1) . " " . 
      $faker->randomNumber(2, false) . 
      strtoupper($faker->randomLetter()) . strtoupper($faker->randomLetter());
      
      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
      VALUES ('$studentID', '$password', '$dob', '$firstName', '$lastName', '$streetAdress', '$town', '$county', '$country',
       '$postCode')";
       
       $result = mysql_query($conn,$sql);
   }
   
?>
