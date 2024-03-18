<?php
    session_start();
    if(isset($_POST["submit"])){
        $name = $_POST["fullname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $userid = $_SESSION["id"];

        require_once 'dbconnection.php';
        require_once 'function.php';

        if(emptyInputSignup($name, $email, $username, $password) !== false){
            header("location: /Game store sem v/editprofile.php?error=Fill all fields");
            exit();
        }
        if(invalidEmail($email) !== false){
            header("location: /Game store sem v/editprofile.php?error=Invalid email");
            exit();
        }
        if(editExists($conn, $username, $email) !== false){
            header("location: /Game store sem v/editprofile.php?error=Username already exists");
            exit();
        }

        editUser($conn, $name, $email, $username, $password, $userid);
    }
    else{
        header("location: /Game store sem v/signup.php?error=Try again");
        exit();
    }