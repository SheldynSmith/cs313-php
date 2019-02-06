<!DOCTYPE html>
<header> Scripture Resources </header>

<body>
    <?php
  try
  {
    $dbUrl = getenv('DATABASE_URL');
  
    $dbOpts = parse_url($dbUrl);
    $book = $_GET["book"];
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');
  
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex)
  {
    echo 'Error!: ' . $ex->getMessage();
    die();
  }
  foreach ($db->query('SELECT book,chapter,verse,content FROM scripture WHERE book='.$book) as $row)
  {
    echo '<strong>'. $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'].  '</strong> - ' . $row['content'];
    echo '<br/>';
  }
?>
</body>

</html>