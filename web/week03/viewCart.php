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
        <h2>Your Cart</h2>
        <table>
          <tr>
            <th>Item</th>
            <th>QTY</th>
            <th>Price</th>
            <th></th>
          </tr>
        <?php
        foreach ($_SESSION as $key => $value) {
          if ($value > 0) {
            $itemPrice = $prices[$key] * $value;
            $totalPrice += $itemPrice;
            $itemName = str_replace("_", " ", $key);
            echo "<tr><td>$itemName</td><td>$value</td><td>\$".number_format($itemPrice, 2)."</td><th><button onclick=\"remove('$key')\">Remove</button></th></tr>";
          }
        }
        echo "</table><br>";
        echo "<h3>Total Price: \$".number_format($totalPrice, 2)."</h3>";
        ?>
        <a href="store.php" class="nav-link">
          <div id="shopping-link" class="nav-button">Continue Shopping</div>
        </a>
        <a href="checkout.php" class="nav-link">
          <div id="checkout-link" class="nav-button">Check Out</div>
        </a>
      </div>
    </div>
    <div class="col-3">&nbsp;</div>
    </div>
  </div>
  
</body>
</html>