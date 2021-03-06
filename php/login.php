<?php
/* User login process, checks if user exists and password is correct */
 $_SESSION['email'] = '';
        $_SESSION['active'] = '';
        $_SESSION['lastname']='';
        $_SESSION['Role']='';
        $_SESSION['usr_id']='';
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = '';
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: php/error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['lastname']=$user['lastname'];
        $_SESSION['Role']=$user['Role'];
        $_SESSION['usr_id']=$user['usr_id'];
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        

        header("location: php/HomePage.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: php/error.php");
    }
}

