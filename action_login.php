<?php
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once 'dbconnection.php';
        require_once 'function.php';

        if(emptyInputLogin($username, $password) !== false){
            header("location: /Game store sem v/login.php?error=Fill all fields");
            exit();
        }
        loginUser($conn, $username, $password);
    }
    else{
        header("location: /Game store sem v/login.php?error=Try again");
        exit();
    }