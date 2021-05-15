<?php

if (isset($_POST['login-submit'])){
    require 'index.html';
    $username = $_POST['username'];
    $password=$_POST['password'];
    $host = "localhost";
    $dbusername = "root"; 
    $dbpassword = "";
    $dbname = "login_data";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname, 3307);

    if (empty($username) || empty($password)){
       
        header("location: index.html?error=emptyfields");
        exit();
    }
    else{
        $sql = "select * FROM users WHERE username=? OR password=?;";
        $stmt = mysqli_stmt_inti($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: index.html?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss",$username, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password,$row['password']);
                if($pwdCheck == false){
                    header("location: index.html?error=wrongpwd");
                    exit();                   
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION ['id'] =$pws['id'];
                    $_SESSION ['username'] =$pws['username'];
                    header("location: index.html?error=success");
                    exit();
                }
                else{
                    header("location: index.html?error=wrondpwd");
                    exit();
                }
            }
            else{
                header("location: index.html?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("location: index.html")
die();
}