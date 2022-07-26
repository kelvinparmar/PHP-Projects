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
$db = mysqli_connect('localhost', 'root', '', 'data');
  
// Registration code
if (isset($_POST['reg_user'])) {
  
    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $age = mysqli_real_escape_string($db, $_POST['age']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $message = mysqli_real_escape_string($db, $_POST['message']);

  
    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($age)) { array_push($errors, "Age is required"); }
    if (empty($contact)) { array_push($errors, "contact is required"); }
    if (empty($address)) { array_push($errors, "address is required"); }
    if (empty($message)) { array_push($errors, "message is required"); }
  
    
  
    // If the form is error free, then register the user
    if (count($errors) == 0) {
         
        // Password encryption to increase data security
        $password = $password_1;
         
        // Inserting data into table
        $query = "INSERT INTO details (username, email, password, age, contact, address, message)
                  VALUES('$username', '$email', '$password','$age','$contact','$address','$message')";
         
        mysqli_query($db, $query);
  
        // Storing username of the logged in user,
        // in the session variable
        $_SESSION['username'] = $username;
         
        // Welcome message
        $_SESSION['success'] = "You have logged in";
         
        // Page on which the user will be
        // redirected after logging in
        header('location: index.php');
    }
}
  
// User login
if (isset($_POST['login_user'])) {
     
    // Data sanitization to prevent SQL injection
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    // Error message if the input field is left blank
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    // Checking for the errors
    if (count($errors) == 0) {
         
        // Password matching
    
         
        $query = "SELECT * FROM details WHERE username=
                '$username' AND password='$password'";
        $results = mysqli_query($db, $query);
  
        // $results = 1 means that one user with the
        // entered username exists
        if (mysqli_num_rows($results) == 1) {
             
            // Storing username in session variable
            $_SESSION['username'] = $username;
             
            // Welcome message
            $_SESSION['success'] = "You have logged in!";
             
            // Page on which the user is sent
            // to after logging in
            header('location: index.php');
        }
        else {
             
            // If the username and password doesn't match
            array_push($errors, "Username or password incorrect");
        }
    }
}
  
?>