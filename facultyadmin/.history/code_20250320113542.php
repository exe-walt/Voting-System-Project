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

CODE.PHP


<?php
//Updating into the database
if(isset($_POST['updatebtn'])){
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertypeupdate = $_POST['edit_usertype'];

    $query = "UPDATE register_table SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE user_id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Your Data is Updated";
        header("Location: register.php");
        // echo "alert('User Wasn\'t updated')";
    }else{
        $_SESSION['status'] = "Your Data is NOT Updated";
        header("Location: register.php");
    }
}

?>

<?php
//Deleting Data from the database

if(isset($_POST['deletebtn'])){

    $id = $_POST['delete_id'];

    $sql = "DELETE FROM register_table WHERE user_id='$id'";
    $query = mysqli_query($connection, $sql);

    if($query){
        $_SESSION['success'] = "Your Data is Deleted";
        header("Location: register.php");
    }else{
        $_SESSION['status'] = "Your Data is NOT Deleted";
        header("Location: register.php");
    }
}

?>