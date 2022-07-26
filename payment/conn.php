<?php
 
// Starting the session, necessary
// for using session variables
session_start();
  
// Declaring and hoisting the variables
$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";
  
// DBMS connection code -> hostname,
// username, password, database name
$db = mysqli_connect('localhost', 'root', '', 'payment');
  
// Registration code
if (isset($_POST['submit'])) {
  
    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);
    $cardname = mysqli_real_escape_string($db, $_POST['cardname']);
    $cardno = mysqli_real_escape_string($db, $_POST['cardno']);
    $expmonth = mysqli_real_escape_string($db, $_POST['expmonth']);
    $expyear = mysqli_real_escape_string($db, $_POST['expyear']);
    $cvv = mysqli_real_escape_string($db, $_POST['cvv']);

  
    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($address)) { array_push($errors, "Address is required"); }
    if (empty($city)) { array_push($errors, "city is required"); }
    if (empty($state)) { array_push($errors, "state is required"); }
    if (empty($zipcode)) { array_push($errors, "zipcode is required"); }
    if (empty($cardname)) { array_push($errors, "cardname is required"); }
    if (empty($cardno)) { array_push($errors, "cardno is required"); }
    if (empty($expmonth)) { array_push($errors, "expmonth is required"); }
    if (empty($expyear)) { array_push($errors, "expyear is required"); }
    if (empty($cvv)) { array_push($errors, "cvv is required"); }

  
    
  
    // If the form is error free, then register the user
    if (count($errors) == 0) {
         
         
        // Inserting data into table
        $query = "INSERT INTO details (username, email, address, city, state, zipcode, cardname, cardno, expmonth, expyear, cvv)
                  VALUES('$username', '$email', '$address','$city','$state','$zipcode','$cardname' '$cardno, '$expmonth', '$expyear','$cvv')";
         
        mysqli_query($db, $query);
  
        // Storing username of the logged in user,
        // in the session variable
        $_SESSION['username'] = $username;
         
        // Welcome message
        $_SESSION['success'] = "Your Transection is successfull";
         
        // Page on which the user will be
        // redirected after logging in
        header('location: index.php');
    }
}
  