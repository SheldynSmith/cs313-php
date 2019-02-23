<?php
session_start();
if(!$_SESSION["verified"]) {
    $_SESSION["username"] = NULL;
    $_SESSION["retryLogin"] = FALSE;
    header("Location: login.php");
    exit;
}

require "dbConnect.php";
$db = get_db();
$userName = $_SESSION["username"];
$characterID = $_GET['id'];
$statement = $db->prepare("SELECT jsonstring, charactername, ut.username FROM charactersheets cs, usertable ut 
                           WHERE cs.userid = ut.id AND ut.username = :cleanUsername AND cs.id = :cleanCharacterID");
$statement->bindValue(":cleanUsername", $userName, PDO::PARAM_STR);
$statement->bindValue(":cleanCharacterID", $characterID, PDO::PARAM_STR);
$statement->execute();

// make sure that the sheet belongs to the correct user
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
    <div id="content">
        <h1>Pathfinder Character Sheet</h1>
        <form action="logout.php">
            <button id="logout-button" type="submit" value="Logout">
        </form>
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
                    <input type="text" name="player-name" value="<?php echo $stats->{"player-name"}?>">
                </div>
                <div id="race" class="stat-container">
                    <label>Race</label><br>
                    <input type="text" name="race" value="<?php echo $stats->{"race"}?>">
                </div>
                <div id="character-class" class="stat-container">
                    <label>Character Class</label><br>
                    <input type="text" name="character-class" value="<?php echo $stats->{"character-class"}?>">               
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
                    <input type="text" name="deity" value="<?php echo $stats->{"deity"}?>">
                </div>
                <div id="homeland" class="stat-container">
                    <label>Homeland</label><br>
                    <input type="text" name="homeland"  value="<?php echo $stats->{"homeland"}?>">
                </div>              
                <div id="size" class="stat-container">
                    <label>Size</label><br>
                    <select name="size">
                        <option value="Small"
                        <?php
                        if($stats->{"size"} == "Small") {
                            echo "selected";
                        }
                        ?>
                        >Small</option>
                        <option value="Medium"
                        <?php
                        if($stats->{"size"} == "Medium") {
                            echo "selected";
                        }
                        ?>
                        >Medium</option>
                    </select>
                </div>
                <div id="gender" class="stat-container">
                    <label>Gender</label><br>
                    <select name="gender">
                        <option value="Male"
                        <?php
                        if($stats->{"gender"} == "Male") {
                            echo "selected";
                        }
                        ?>
                        >Male</option>
                        <option value="Female"
                        <?php
                        if($stats->{"gender"} == "Female") {
                            echo "selected";
                        }
                        ?>
                        >Female</option>
                    </select>
                </div>
                <div id="age" class="stat-container">
                    <label>Age</label><br>
                    <input type="text" name="age" value="<?php echo $stats->{"age"}?>">
                </div>
                <div id="Height" class="stat-container">
                    <label>Height</label><br>
                    <input type="text" name="height" value="<?php echo $stats->{"height"}?>">
                </div>
                <div id="weight" class="stat-container">
                    <label>Weight</label><br>
                    <input type="text" name="weight" value="<?php echo $stats->{"weight"}?>">
                </div>
                <div id="hair" class="stat-container">
                    <label>Hair Color</label><br>
                    <input type="text" name="hair" value="<?php echo $stats->{"hair"}?>">
                </div>
                <div id="eyes" class="stat-container">
                    <label>Eye Color</label><br>
                    <input type="text" name="eyes" value="<?php echo $stats->{"eyes"}?>">
                </div>
            </div> <!--general section-->
            <div id="abilities" class="stat-section">
                <h2>Abilities</h2>
                <div class="ability-grid-container">
                    <div class="ability-grid ability-label">STR</div>
                    <div id="str-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="str-score" maxlength="4" size="4" value="<?php echo $stats->{"str-score"}?>">
                    </div>
                    <div id="str-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="str-mod" maxlength="4" size="4" value="<?php echo $stats->{"str-mod"}?>">
                    </div>
                    <div id="str-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="str-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"str-temp-score"}?>">
                    </div>
                    <div id="str-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="str-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"str-temp-mod"}?>">
                    </div>
                    <div class="ability-grid ability-label">DEX</div>
                    <div id="dex-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="dex-score" maxlength="4" size="4" value="<?php echo $stats->{"dex-score"}?>">
                    </div>
                    <div id="dex-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="dex-mod" maxlength="4" size="4" value="<?php echo $stats->{"dex-mod"}?>">
                    </div>
                    <div id="dex-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="dex-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"dex-temp-score"}?>">
                    </div>
                    <div id="dex-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="dex-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"dex-temp-mod"}?>">
                    </div>
                    <div class="ability-grid ability-label">CON</div>
                    <div id="con-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="con-score" maxlength="4" size="4" value="<?php echo $stats->{"con-score"}?>">
                    </div>
                    <div id="con-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="con-mod" maxlength="4" size="4" value="<?php echo $stats->{"con-mod"}?>">
                    </div>
                    <div id="con-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="con-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"con-temp-score"}?>">
                    </div>
                    <div id="con-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="con-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"con-temp-mod"}?>">
                    </div>
                    
                </div>
            </div> <!--ability section-->
        </form>
    </div>
</body>
</html>