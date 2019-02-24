<?php
session_start();

if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}
$_SESSION["characterID"] = NULL;

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
    <link rel="stylesheet" href="styles/sheet.css">
    <title>Home</title>
</head>
<body>
    <div id="content">
        <h1>Pathfinder Character Sheets</h1>
        <h2>Welcome <?php echo htmlspecialchars($_SESSION["username"])?></h2>
        <a href="logout.php" class="button">Logout</a>
        <h3>Characters</h3>
        <ul>
            <form action="newSheet.php">
                <input type="submit" value="Create a New Character">
            </form>
            <?php
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $charName = $row["charactername"];
                    $charClass = $row["characterclass"];
                    $level = $row["characterlevel"];
                    $charRace = $row["characterrace"];
                    $id = $row["id"];

                    $string = "";
                    if($level != "") {
                        $string = "the level";
                    }

                    echo "<li><a href=\"sheet.php?id=$id\">View</a> <a href=\"deleteSheet.php?id=$id\">Delete</a> $charName $string $level $charRace $charClass</li>";
                }
                // echo "</ul>";
            ?>
        </ul>
    </div>
</body>
</html>