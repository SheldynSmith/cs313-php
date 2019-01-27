<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
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
      <div class="col-6">
        <h1>Drum Sets</h1>
        <hr>
        <div class="listing">
          <img id="tama-drums" src="data/tamaDrums.jpg" class="instrument-pics" alt="Black Tama Drum Set">
          <div class="product-name">Tama Drum Set</div>
          <div class="price">$869.99<br>
            <button onclick="addItem('Tama_Drum_Set')">Add to Cart</button>
          </div>
        </div>
        <hr>
        <div class="listing">
          <img id="ludwig-drums" src="data/ludwigDrums.jpg" class="instrument-pics" alt="Blue Ludwig Drum Set">
          <div class="product-name">Ludwig Drum Set</div>
          <div class="price">$699.00<br>
            <button onclick="addItem('Ludwig_Drum_Set')">Add to Cart</button>
          </div>
        </div>
        <hr>
        <h1>Guitars</h1>
        <div class="listing">
          <img id="fender-guitar" src="data/fenderGuitar.jpg" class="instrument-pics" alt="Blue Fender Guitar">
          <div class="product-name">Fender Guitar</div>
          <div class="price">$799.99<br>
            <button onclick="addItem('Fender_Guitar')">Add to Cart</button>
          </div>
        </div>
        <hr>
        <div class="listing">
          <img id="martin-guitar" src="data/martinGuitar.jpg" class="instrument-pics" alt="Natural Martin Guitar">
          <div class="product-name">Martin Guitar</div>
          <div class="price">$699.00<br>
            <button onclick="addItem('Martin_Guitar')">Add to Cart</button>
          </div>
        </div>
        <hr>
        
        <div id="response"></div>
      </div>
    </div>
    <div class="col-3">&nbsp;</div>
    </div>
  </div>
  
</body>
</html>