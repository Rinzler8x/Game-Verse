<?php

    if(isset($_POST["submit"])){
        $name = $_POST["fullname"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once 'dbconnection.php';
        require_once 'function.php';

        if(emptyInputSignup($name, $email, $username, $password) !== false){
            header("location: /Game store sem v/signup.php?error=Fill all fields");
            exit();
        }
        if(invalidEmail($email) !== false){
            header("location: /Game store sem v/signup.php?error=Invalid email");
            exit();
        }
        if(usernameExists($conn, $username, $email) !== false){
            header("location: /Game store sem v/signup.php?error=Username or email already exists");
            exit();
        }

        createUser($conn, $name, $email, $username, $password);
    }
    else{
        header("location: /Game store sem v/signup.php?error=Try again");
        exit();
    }

