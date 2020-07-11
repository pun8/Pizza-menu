<?php

if(isset($_POST['login-sub'])){
    require '../config/db_connect.php';

    $mailuid = $_POST['mailuid'];
    $pswd = $_POST['pwd'];

    if(empty($mailuid)||empty($pswd)){
        header("Location:../login.php?error=emptyfields");
        exit();
    } else{
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location:../login.php?error=sqlerror");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdcheck = password_verify($pswd, $row['passwords']);
                if($pwdcheck == false){
                    header("Location:../login.php?error=wrongpwd");
                    exit();
                }else if($pwdcheck == true){
                    session_start();
                    $_SESSION['username'] = $row['username']; 
                    $_SESSION['Uid'] = $row['idUsers']; 
                    $_SESSION['email'] = $row['email']; 

                    header("Location: ../index.php?login=success");
                }else{
                    header("Location:../login.php?error=wrongpwda");
                    exit();
                }
            }else{
                header("Location:../login.php?error=nouser");
                exit();
            }
        }
        
    }
}