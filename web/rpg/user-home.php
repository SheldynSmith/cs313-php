<?php
session_start();

if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}

require "dbConnect.php";

$userName = $_SESSION["username"];

$db = get_db();
$statement = $db->prepare("SELECT charactername, characterclass, characterlevel, characterrace, cs.id
                           FROM charactersheets cs, usertable ut 
                           WHERE ut.username = '$userName' AND cs.userid = ut.id");
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Pathfinder Character Sheets</h1>
    <h2>Welcome <?php echo $_SESSION["username"]?></h2>
    <h3>Characters</h3>
    <ul>
        <?php
            echo "made it here";
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>in loop";
                // $charName = $row["charactername"];
                // echo $charName;
                // $charClass = $row["characterclass"];
                // $level = $row["characterlevel"];
                // $charRace = $row["characterrace"];
                // $id = $row["id"];

                // echo "<li><a href=\"sheet.php?id=$id>View</a> $charName the level $level $charRace $charClass</li>";
            }
            echo "</ul>";
        ?>
</body>
</html>