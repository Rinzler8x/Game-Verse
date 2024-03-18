<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameVerse - Profile</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  <header>
    <h1>User Profile</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <!-- <li><a href="#games">Games</a></li> -->
        <?php
          if(isset($_SESSION["username"])){
            if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]);
              echo "<li><a href='cart.php'>Cart $count</a></li>";
            }
            else{
              echo "<li><a href='cart.php'>Cart 0</a></li>";
            }
            echo "<li><a href='logout.php'>Logout</a></li>";
          }
          else{
            echo "<li><a href='login.php'>Login</a></li>
                  <li><a href='signup.php'>Sign Up</a></li>";
          }
        ?>
      </ul>
    </nav>
  </header>

  <main class="profile-page">
    <section class="profile-info">
      <!-- <h2>User Profile</h2> -->
      <div class="user-details">
        <div class="avatar">
          <img src="profileAvatar.svg" alt="User Avatar">
        </div>
        <div class="user-data">
          <?php
            require_once 'dbconnection.php';

            if(isset($_SESSION["username"])){
              $sql = "SELECT * FROM users WHERE users_id = ?;";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: profile.php?error=stmt failed");
                exit();
              }

              mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
              mysqli_stmt_execute($stmt);
              $resultData = mysqli_stmt_get_result($stmt);
              $str = "";  
              while($row = mysqli_fetch_assoc($resultData)){
                $str .= "<h3>".$row['users_name']."</h3>
                        <p>Username: ".$row['users_username']."</p>
                        <p>Email: ".$row['users_email']."</p>";
              }
              echo $str;
            }

          ?>
          <!-- Other user details -->
          <a href="editprofile.php"><button style='background-color: black; color: white;'>Edit Button</button></a>
        </div>
      </div>
    </section>

    <section class="order-history">
      <h2>Order Details</h2>
      <div class="orders">
        <!-- Display order history -->
        
        <?php
          require_once 'component.php';
          $userid = (int)$_SESSION["id"];
          $sql = "SELECT * FROM bill, games WHERE bill_gameid = games_id AND bill_userid = $userid";
          $resultData = mysqli_query($conn, $sql);
          $currentBillid = null;
          $currentDate = null;
          $total = 0;
          while($row = mysqli_fetch_assoc($resultData)){
            if($userid == (int)$row["bill_userid"]){
              if($currentBillid !== $row["bill_id"]){
                if($currentBillid !== null){
                  echo "<p>Bill Id: $currentBillid</p>
                        <p>Purchase Date: $currentDate</p>
                        <p>Total Amount: $total </p>
                        <div class='orders'></div>
                        </div>";
                }
                $currentBillid = $row["bill_id"];
                $currentDate = $row['bill_date'];
                $total = 0;
              }
              profileRecord($row["games_name"], $row["games_genre"], $row["games_price"]);
              $total += $row["games_price"];
            }
          }
          if ($currentBillid !== null) {
            echo "<p>Bill Id: $currentBillid</p>
                  <p>Purchase Date: $currentDate</p>
                  <p>Total Amount: $total </p>
                  <div class='orders'></div>
                  <div>
                  <form method='POST' action='action_delete_bill.php'>
                  <label for='billid'>Enter Bill ID to Delete:</label>
                  <input type='text' name='billid' required>
                  <button type='submit' name='delete'>Delete</button>
                  </form>
                  </div>
                  </div>";        
          }
        ?>
        <!-- More orders -->
      </div>
    </section>
  </main>

  <!-- <footer>
    
  </footer> -->

</body>
</html>
