<?php


include "dbconfig.php";


//Inserting into the database 
if(isset($_POST['registerbtn'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $usertype = $_POST['usertype'];

    if($password === $confirm_password){
        $query = "INSERT INTO registration (username, email, password, usertype) VALUES('$username','$email','$password', '$usertype')";
        $query_run = mysqli_query($conn, $query);
        if($query_run)
        {
            //echo "Saved";
            $_SESSION['success'] = "Admin Profile Added";
            header('Location: register.php');
        }else{
            $_SESSION['status'] = "Admin Profile Not Added";
            header('Location: register.php'); 
        }
    }else{
        $_SESSION['success'] = "Password and Confirm Password Does Not Match";
        header('Location: register.php');
    }
}



?>