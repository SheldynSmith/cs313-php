<?php
session_start();
if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}

// make sure that the sheet belongs to the correct user

require "dbConnect.php";
$db = get_db();
$userName = $_SESSION["username"];
$characterID = $_GET['id'];
$statement = $db->prepare("SELECT jsonstring, charactername, ut.username FROM charactersheets cs, usertable ut 
                           WHERE cs.userid = ut.id AND ut.username = :cleanUsername AND cs.id = :cleanCharacterID");
$statement->bindValue(":cleanUsername", $userName, PDO::PARAM_STR);
$statement->bindValue(":cleanCharacterID", $characterID, PDO::PARAM_STR);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
if ($row == false) {
    echo "This character sheet does not belong to you.";
    die;
}
else {
    $_SESSION["characterID"] = $characterID;
}

$jsonString = $row["jsonstring"];
$stats = json_decode($jsonString, false);
var_dump($row);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/sheet.css">
    <title>Pathfinder Character Sheet</title>
</head>
<body>
    <h1>Pathfinder Character Sheet</h1>
    <form action="saveSheet.php" method="POST">
        <input type="submit" id="save-sheet" value="Save">
        <div id="general" class="stat-section">
            <h2>General</h2>
            <div id="character-name" class="stat-container">
                <label>Character name</label><br>
                <input type="text" name="character-name" value="<?php echo $row["charactername"]?>">
            </div>
            <div id="alignment" class="stat-container">
                <label>Alignment</label><br>
                <input type="text" name="alignment" value="<?php echo $stats->{"alignment"}?>">
            </div>
            <div id="player-name" class="stat-container">
                <label>Player Name</label><br>
                <input type="text" name="player-name">
            </div>
            <div id="character-class" class="stat-container">
                <label>Character Class</label><br>
                <input type="text" name="character-class" value="<?php echo $stats->{"characterclass"}?>">               
            </div>
            <div id="level" class="stat-container">
                <label>Level</label><br>
                <select name="level">
                    <?php
                        for ($i = 1; $i <= 20; $i++) {
                            echo "<option value=\"$i\"";
                            if($i == $stats->{"level"}) {
                                echo " selected";
                            }
                            echo ">$i</option>";
                        }
                    ?>
                </select>
            </div>
            <div id="deity" class="stat-container">
                <label>Deity</label><br>
                <input type="text" name="deity">
            </div>
            <div id="homeland" class="stat-container">
                <label>Homeland</label><br>
                <input type="text" name="homeland">
            </div>
            <div id="race" class="stat-container">
                <label>Race</label><br>
                <input type="text" name="race" value="<?php echo $stats->{"race"}?>">
            </div>
            <div id="size" class="stat-container">
                <label>Size</label><br>
                <select name="size">
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                </select>
            </div>
            <div id="gender" class="stat-container">
                <label>Gender</label><br>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div id="age" class="stat-container">
                <label>Age</label><br>
                <input type="text" name="age">
            </div>
            <div id="Height" class="stat-container">
                <label>Height</label><br>
                <input type="text" name="height">
            </div>
            <div id="weight" class="stat-container">
                <label>Weight</label><br>
                <input type="text" name="weight">
            </div>
            <div id="hair" class="stat-container">
                <label>Hair Color</label><br>
                <input type="text" name="hair">
            </div>
            <div id="eyes" class="stat-container">
                <label>Eye Color</label><br>
                <input type="text" name="eyes">
            </div>
        </div> <!--general section-->

    </form>
</body>
</html>