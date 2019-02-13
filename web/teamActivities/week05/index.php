<!DOCTYPE html>
<html>
<header> Scripture Resources </header>
<body>
    <form name="searchScripture" action="insertScripture.php" method="POST">
        <!-- Which book do you want to display?<br> -->
        Book:<br>
        <input type="text" name="book"><br>
        Chapter:<br>
        <input type="text" name="chapter"><br>
        Verse:<br>
        <input type="text" name="verse"><br>
        <textarea cols="40" name="content"></textarea><br>
        <input type="submit" value="send">
        <?php
         try
         {
           $dbUrl = getenv('DATABASE_URL');
         
           $dbOpts = parse_url($dbUrl);
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
         foreach ($db->query("SELECT * FROM Topics") as $row)
         {
           echo '<input type="checkbox" name="topic[]" value="'.$row["id"].'">'.$row["name"];
           echo '<br/>';
         }
         ?>
    </form>
</body>
</html>