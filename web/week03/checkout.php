<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$prices = array("Tama_Drum_Set" => 869.99, "Ludwig_Drum_Set" => 699.00,
                "Fender_Guitar" => 799.99, "Martin_Guitar" => 699.00);
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="data/storeStyle.css">
    <script type="text/javascript" src="data/storeScripts.js"></script>
    <title>Music Store</title>
</head>
<body>
  <header>
    <div class="row">
      <div class="col-3">&nbsp;</div>
      <h1 class="col-3">Music Store</h1>
      <nav class="col-3">
        <a href="viewCart.php" class="nav-link">
          <div id="assign-link" class="nav-button">View Cart</div>
        </a>
      </nav>
      <div class="col-3">&nbsp;</div>
    </div>
  </header>
  <div id="content">
    <div class="row">
      <div class="col-3">&nbsp;</div>
      <div class="col-6" style="padding-top: 10px">
        <h2>Shipping Info</h2>
        <form action="confirmation.php" method="POST">
          Name:<br>
          <input type="text" name="name" class="shippingField"><br>
          Street Address:<br>
          <input type="text" name="street" class="shippingField"><br>
          City:<br>
          <input type="text" name="city" class="shippingField"><br>
          State:<br>
          <input type="text" name="state" class="shippingField"><br>
          Zip:<br>
          <input type="text" name="zip" class="shippingField"><br>
          <a href="viewCart.php" class="nav-link">
            <div id="cart-link" class="nav-button">Back to Cart</div>
          </a>
          
          <input type="submit" id="confirm-link" class="nav-button" value="Confirm Order" style="color: rgb(41, 102, 194);">
          
        </form>
      </div>
    </div>
    <div class="col-3">&nbsp;</div>
    </div>
  </div>
  
</body>
</html>