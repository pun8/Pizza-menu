<?php

if(isset($_POST['signup-sub'])){

    require '../config/db_connect.php';

    $username = $_POST['uname'];
    $email = $_POST['emailid'];
    $pass = $_POST['pwd'];
    $repass = $_POST['pwd2'];

    if(empty($username) || empty($email) || empty($pass) || empty($repass) ){
        header("Location: ../signup.php?error=emptyfields&uname=".$username."&emailid=".$email);
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !(preg_match("/^[a-zA-Z0-9]*$/", $username))){
        header("Location: ../signup.php?error=invalid");
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidemail&uname=".$username);
        exit();
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidusername&emailid=".$email);
        exit();
    } else if($pass != $repass){
        header("Location: ../signup.php?error=passwrdcheck&uname=".$username."emailid=".$email);
    } else{
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result_check = mysqli_stmt_num_rows($stmt);
            
            if($result_check>0){
                header("Location: ../signup.php?error=usernametaken&emailid=".$email);
                exit();
            } else{
                $sql = "INSERT INTO users(username, email, passwords) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit(); 
                } else{
                    $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../login.php?signup=success");
                    exit();
                }
            }
        }
        mysqlli_stmt_close($stmt);
        mysqli_close($close);
    }
} else{
    header("Location:../signup.php");
    exit();
}