<?php
  session_start();
  require_once 'dbconnection.php';
  if(isset($_POST["add"])){
    
    if(isset($_SESSION["cart"])){
      $item_array_id = array_column($_SESSION["cart"], "games_id");

      if(in_array($_POST["games_id"], $item_array_id)){
        echo "<script>alert('Game is already added in cart...!');</script>";
        echo "<script>window.location = 'index.php'</script>";
      }
      else{
        $count = count($_SESSION["cart"]);
        $item_array = array(
          'games_id' => $_POST["games_id"]
        );

        $_SESSION["cart"][$count] = $item_array;
      }
    }
    else{
      $item_array = array(
        'games_id' => $_POST["games_id"]
      );

      $_SESSION["cart"][0] = $item_array;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameVerse - Your Ultimate Gaming Destination</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto:wght@300&family=Vina+Sans&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <div class="logo">
      <h1>GameVerse</h1>
    </div>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
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
    <section id="home">
        <h2>Featured Games</h2>
        <div class="games-container">
          <form action="index.php" method="post">
          <div class="game">
            <img src="https://cdn.akamai.steamstatic.com/steam/apps/1551360/header.jpg?t=1699624973" alt="Game 1">
            <h3>Forza Horizon 5</h3>
            <p>Your Ultimate Horizon Adventure awaits! Explore the vibrant and ever-evolving open world landscapes of Mexico with limitless, fun driving action in hundreds of the world’s greatest cars.Lead breathtaking expeditions across the vibrant and ever-evolving open world landscapes of Mexico with limitless, fun driving action in hundreds of the world’s greatest cars.Explore a world of striking contrast and beauty. Discover living deserts, lush jungles, historic cities, hidden ruins, pristine beaches.</p>
            <h1>Rs 3499.00</h1><br>
            <button type="submit" name="add">Add to Cart</button>
            <input type="hidden" name="games_id" value="1">
          </div>
          </form>
          <form action="index.php" method="post">
          <div class="game">
            <img src="https://cdn.akamai.steamstatic.com/steam/apps/1250410/header.jpg?t=1700500143" alt="Game 2">
            <h3>Microsoft Flight Simulator 2020</h3>
            <p>From light planes to wide-body jets, fly highly detailed and accurate aircraft in the next generation of Microsoft Flight Simulator. Test your piloting skills against the challenges of night flying, real-time atmospheric simulation and live weather in a dynamic and living world. Create your flight plan to anywhere on the planet. The world is at your fingertips.

                HDR: HDR functionality available with supported games and TVs.</p>
                <h1>Rs 5999.00</h1><br>
            <button type="submit" name="add">Add to Cart</button>
            <input type="hidden" name="games_id" value="2">
          </div>
          </form>
          <form action="index.php" method="post">
          <div class="game">
            <img src="https://cdn.akamai.steamstatic.com/steam/apps/271590/header.jpg?t=1695060909" alt="Game 1">
            <h3>Grand Theft Auto V</h3>
            <p>Grand Theft Auto V for PC offers players the option to explore the award-winning world of Los Santos and Blaine County in resolutions of up to 4k and beyond, as well as the chance to experience the game running at 60 frames per second.

                The game offers players a huge range of PC-specific customization options, including over 25 separate configurable settings for texture quality, shaders, tessellation, anti-aliasing and more, as well as support and extensive customization for mouse and keyboard controls.</p>
                <h1>Rs 2599.00</h1><br>
            <button type="submit" name="add">Add to Cart</button>
            <input type="hidden" name="games_id" value="3">
          </div>
          </form>
          <form action="index.php" method="post">
          <div class="game">
            <img src="https://cdn.akamai.steamstatic.com/steam/apps/1151340/header.jpg?t=1698245440" alt="Game 1">
            <h3>Fallout 76</h3>
            <p>Rejoice in the American Dream and earn patriotic rewards with the Season 14 scoreboard. Celebrate your victories with the Carved Eagle Weapon Rack, Brewery Fermenter and Deep Spacewalk Power Armor Paint, plus decorate your C.A.M.P. with Oval Office themed furnishings. Additional patch features include improvements like lower-level requirements for Perk Cards, streamlined Workbench changes, and a new free cam feature in Photomode.</p>
            <h1>Rs 2000.00</h1><br>
            <button type="submit" name="add">Add to Cart</button>
            <input type="hidden" name="games_id" value="4">
          </div>
        </form>
        </div>
      </section>
  </main>
</body>
</html>
