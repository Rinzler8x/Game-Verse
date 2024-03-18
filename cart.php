<?php
  session_start();
  require_once 'component.php';

  if(isset($_POST["remove"])){
    if($_GET["action"] == "remove"){
      foreach($_SESSION["cart"] as $key => $value){
        if($value["games_id"] == $_GET["id"]){
          unset($_SESSION["cart"][$key]);
          echo "<script>alert('Game removed from cart');</script>";
          echo "<script>window.location = 'cart.php';</script";
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameVerse - Cart</title>
  <link rel="stylesheet" href="cart.css">
  <!-- Link your CSS file or add styles directly here for the cart page -->
</head>
<body>

  <header>
    <h1>Shopping cart</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <!-- <li><a href="#games">Games</a></li> -->
        <?php
          if(isset($_SESSION["username"])){
            // if(isset($_SESSION["cart"])){
            //   $count = count($_SESSION["cart"]);
            //   echo "<li><a href='cart.php'>Cart $count</a></li>";
            // }
            // else{
            //   echo "<li><a href='cart.php'>Cart 0</a></li>";
            // }
            echo "<li><a href='profile.php'>Profile</a></li>
                  <li><a href='logout.php'>Logout</a></li>";
          }
          else{
            echo "<li><a href='login.php'>Login</a></li>
                  <li><a href='signup.php'>Sign Up</a></li>";
          }
        ?>
      </ul>
    </nav>
  </header>
  <main>
    <!-- <section id="cart"> -->
      <!-- <h2>Your Shopping Cart</h2> -->
      <!-- <div class="cart-items"> -->
        <!-- Cart items dynamically generated based on user selections -->
        <!-- Example cart item structure -->
        <!-- <div class="cart-item">
          <img src="https://cdn.akamai.steamstatic.com/steam/apps/1551360/header.jpg?t=1699624973" alt="Game 1">
          <h3>Forza Horizon 5</h3>
          <p>Description: Your Ultimate Horizon Adventure awaits!...</p>
          <h1>Rs 3499.00</h1>
          <button>Remove</button>
        </div> -->
        <!-- Repeat this structure for each item in the cart -->
      <!-- </div>
      <div class="cart-total">
        <h3>Total:</h3> -->
        <!-- Display the total price of all items in the cart -->
        <!-- <h1>Rs Total Amount</h1>
      </div>
      <div class="checkout">
        <button>Proceed to Checkout</button>
      </div>
    </section> -->
    <section class="cart">
      <h2>Order Details</h2>
      <div class="orders">
        <?php
          require_once 'dbconnection.php';
          
          $total = 0;
          if(isset($_SESSION["cart"])){
            $games_id = array_column($_SESSION["cart"], "games_id");
            $sql = "SELECT * FROM games";
            $resultData = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($resultData)){
              foreach($games_id as $id){
                if($row["games_id"] == $id){
                  cartItem($row["games_name"], $row["games_publisher"], $row["games_genre"], $row["games_price"], $row["games_id"]);
                  $total += (int)$row["games_price"];
                }
              }
            }
            mysqli_close($conn);
          }
          else{
            echo "<h5>Cart Empty</h5>";
          }
        ?>
        <form action="action_cart.php" method="post">
          <div class="cart-item">
            <h3>Total Amount: <?php echo $total; ?></h3>
            <button type="submit" name="buy">Buy</button>
          </div>
        </form>
        <!-- More orders -->
      </div>
    </section>
  </main>

  <!-- <footer>
  </footer> -->

</body>
</html>
