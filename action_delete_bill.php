<?php
    session_start();
    require_once 'dbconnection.php';

    if (isset($_POST['delete'])) {
        $billid = (int)$_POST['billid'];
        $userid = $_SESSION["id"];
        $sql = "DELETE FROM bill WHERE bill_id = $billid AND bill_userid = $userid";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Order Deleted');</script>";
            echo "<script>window.location.href = 'profile.php';</script>";
        } else {
            header("location: /Game store sem v/profile.php?error=delete failed");
            exit();
        }
    }