<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: /Game store sem v/index.php");
    exit();