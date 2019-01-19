<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="homeData/homeStyle.css">
  <script type="text/javascript" src="homeData/homeScripts.js"></script>
  <title>Sheldyn Smith's Homepage</title>
</head>

<body>
  <header>
    <div class="row">
      <div class="col-3">&nbsp;</div>
      <h1 class="col-3">Sheldyn Smith</h1>
      <nav class="col-3">
        <a href="index.php" class="nav-link">
          <div id="home-link" class="nav-button">Home</div>
        </a>
        <a href="assignments.html" class="nav-link">
          <div id="assign-link" class="nav-button">Assignments</div>
        </a>
      </nav>
      <div class="col-3">&nbsp;</div>
    </div>
  </header>
  <div id="content">
    <div class="row">
      <div class="col-3">&nbsp;</div>
      <div class="col-6">
        <img id="family-pic" src="homeData/Family Photo.jpeg" alt="Smith Family Photo">
        <div id="photo-nav">
          <button id="photo-left" class="photo-cycler" onclick="cycleLeft()">&lt;</a>
          <button id="photo-right" class="photo-cycler" onclick="cycleRight()">&gt;</a>
        </div>
        <h2>Sheldyn Smith</h2>
        <h3>Major: Software Engineering</h3><br>
        <hr><br>
        <p>Sheldyn is currently taking classes from BYU-Idaho working on his second Bachelor's degree. His first degree was
          a Bachelor of Music in Sound Recording Technology. He and his wife Sarah will have been married for three years
          at the end of January 2019. Their only son Evan will be two years old in March.
        </p><br>
        <hr><br>
        <h3>Classes</h3><br>
        <table>
          <tr>
            <th>Course #</th>
            <th>Course Description</th>
            <th>Sec #</th>
            <th>Class Location</th>
          </tr>
          <tr>
            <td>CS 246</td>
            <td>Software Design & Development</td>
            <td>04</td>
            <td>Online</td>
          </tr>
          <tr>
            <td>CS 313</td>
            <td>Web Engineering II</td>
            <td>02</td>
            <td>Online</td>
          </tr>
        </table><br>
        <h3>Server Time</h3>
        <?php
          echo date("D M d, Y G:i a");
        ?>
      </div>
      </div>
      <div class="col-3">&nbsp;</div>
    </div>
  </div>
</body>
</html>
