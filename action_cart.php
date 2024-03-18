<?php
    session_start();
    if(isset($_POST["buy"])){
        if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0){
            require_once 'dbconnection.php';
            require_once 'component.php';

            $total = 0;
            $games_id = array_column($_SESSION["cart"], "games_id");
            $sql1 = "SELECT * FROM games";
            $resultData1 = mysqli_query($conn, $sql1);
            while($row = mysqli_fetch_assoc($resultData1)){
                foreach($games_id as $id){
                    if($row["games_id"] == $id){
                        $total += (int)$row["games_price"];
                    }
                }
            }
            $games_id = array_column($_SESSION["cart"], "games_id");
            $resultData1 = mysqli_query($conn, $sql1);
            $userid = (int)$_SESSION["id"];
            $billid = (int)$_SESSION["billid"] + 1;
            $_SESSION["billid"] = $billid;
            $date = date("jS \of F Y");
            while($row = mysqli_fetch_assoc($resultData1)){
                foreach($games_id as $id){
                    if($row["games_id"] == $id){
                        $gameid = (int)$row["games_id"];
                        $sql = "INSERT INTO bill (bill_id, bill_userid, bill_gameid, bill_date, bill_amount) VALUES ($billid, $userid, $gameid, '$date', '$total');";
                        mysqli_query($conn, $sql);
                    }
                }
            }
            foreach($_SESSION["cart"] as $key => $value){
                unset($_SESSION["cart"][$key]);
                echo "<script>window.location = 'index.php';</script>";
            }
            mysqli_close($conn);
            echo "<script>alert('Payment Successful...');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
        else{
            echo "<script>alert('cart is empty');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
    }