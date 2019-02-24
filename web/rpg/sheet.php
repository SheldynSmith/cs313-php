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
        <a href="logout.php" class="button">Logout</a>
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
                    <div class="ability-grid ability-label">INT</div>
                    <div id="int-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="int-score" maxlength="4" size="4" value="<?php echo $stats->{"int-score"}?>">
                    </div>
                    <div id="int-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="int-mod" maxlength="4" size="4" value="<?php echo $stats->{"int-mod"}?>">
                    </div>
                    <div id="int-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="int-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"int-temp-score"}?>">
                    </div>
                    <div id="int-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="int-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"int-temp-mod"}?>">
                    </div>
                    <div class="ability-grid ability-label">WIS</div>
                    <div id="wis-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="wis-score" maxlength="4" size="4" value="<?php echo $stats->{"wis-score"}?>">
                    </div>
                    <div id="wis-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="wis-mod" maxlength="4" size="4" value="<?php echo $stats->{"wis-mod"}?>">
                    </div>
                    <div id="wis-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="wis-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"wis-temp-score"}?>">
                    </div>
                    <div id="wis-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="wis-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"wis-temp-mod"}?>">
                    </div>
                    <div class="ability-grid ability-label">CHA</div>
                    <div id="cha-score" class="ability-grid">
                        <label>Ability Score</label><br>
                        <input type="text" name="cha-score" maxlength="4" size="4" value="<?php echo $stats->{"cha-score"}?>">
                    </div>
                    <div id="cha-mod" class="ability-grid">
                        <label>Ability Modifier</label><br>
                        <input type="text" name="cha-mod" maxlength="4" size="4" value="<?php echo $stats->{"cha-mod"}?>">
                    </div>
                    <div id="cha-temp-score" class="ability-grid">
                        <label>Temp Score</label><br>
                        <input type="text" name="cha-temp-score" maxlength="4" size="4" value="<?php echo $stats->{"cha-temp-score"}?>">
                    </div>
                    <div id="cha-temp-mod" class="ability-grid">
                        <label>Temp Modifier</label><br>
                        <input type="text" name="cha-temp-mod" maxlength="4" size="4" value="<?php echo $stats->{"cha-temp-mod"}?>">
                    </div>
                </div>
            </div> <!--ability section-->
            <div id="defense" class="stat-section">
                <h2>Defense</h2>
                <div class="defense-grid-container">
                    <div class="defense-grid defense-label">AC</div>
                    <div id="ac-total" class="defense-grid">
                        <label>Total</label><br>
                        <input type="text" name="ac-total" maxlength="4" size="4" value="<?php echo $stats->{"ac-total"}?>">
                    </div>
                    <div id="plus-10" class="defense-grid">
                        <label>10+</label>
                    </div>
                    <div id="armor-bonus" class="defense-grid">
                        <label>Armor Bonus</label><br>
                        <input type="text" name="armor-bonus" maxlength="4" size="4" value="<?php echo $stats->{"armor-bonus"}?>">
                    </div>
                    <div id="shield-bonus" class="defense-grid">
                        <label>Shield Bonus</label><br>
                        <input type="text" name="shield-bonus" maxlength="4" size="4" value="<?php echo $stats->{"shield-bonus"}?>">
                    </div>
                    <div id="ac-dex-mod" class="defense-grid">
                        <label>Dex Modifier</label><br>
                        <input type="text" name="ac-dex-mod" maxlength="4" size="4" value="<?php echo $stats->{"ac-dex-mod"}?>">
                    </div>
                    <div id="size-mod" class="defense-grid">
                        <label>Size Modifier</label><br>
                        <input type="text" name="size-mod" maxlength="4" size="4" value="<?php echo $stats->{"size-mod"}?>">
                    </div>
                    <div id="natural-armor" class="defense-grid">
                        <label>Natural Armor</label><br>
                        <input type="text" name="natural-armor" maxlength="4" size="4" value="<?php echo $stats->{"natural-armor"}?>">
                    </div>
                    <div id="deflection" class="defense-grid">
                        <label>Deflection</label><br>
                        <input type="text" name="deflection" maxlength="4" size="4" value="<?php echo $stats->{"deflection"}?>">
                    </div>
                    <div id="ac-misc-mod" class="defense-grid10-16">
                        <label>Misc Modifier</label><br>
                        <input type="text" name="ac-misc-mod" maxlength="4" size="15" value="<?php echo $stats->{"ac-misc-mod"}?>">
                    </div>
                    <div class="defense-grid defense-label">Touch</div>
                    <div id="touch" class="defense-grid">
                        <label>Touch AC</label><br>
                        <input type="text" name="touch" maxlength="4" size="4" value="<?php echo $stats->{"touch"}?>">
                    </div>
                    <div id="flat-footed" class="defense-grid">
                        <label>Flat-Footed</label><br>
                        <input type="text" name="flat-footed" maxlength="4" size="4" value="<?php echo $stats->{"flat-footed"}?>">
                    </div>
                    <div id="other-ac-mod" class="defense-grid5-16">
                        <label>Other AC Modifiers</label><br>
                        <input type="text" name="other-ac-mod" maxlength="65" size="65" value="<?php echo $stats->{"other-ac-mod"}?>">
                    </div>
                    <div class="defense-grid defense-label">Hit Points</div>
                    <div id="hp" class="defense-grid">
                        <label>HP Total</label><br>
                        <input type="text" name="hp" maxlength="4" size="4" value="<?php echo $stats->{"hp"}?>">
                    </div>
                    <div id="current-hp" class="defense-grid3-5">
                        <label>Current/Wounds</label><br>
                        <input type="text" name="current-hp" maxlength="16" size="16" value="<?php echo $stats->{"current-hp"}?>">
                    </div>
                    <div id="non-leathal" class="defense-grid5-7">
                        <label>Non-Leathal Damage</label><br>
                        <input type="text" name="non-leathal" maxlength="8" size="8" value="<?php echo $stats->{"non-leathal"}?>">
                    </div>
                    <div id="dr" class="defense-grid7-9">
                        <label>Damage Reduction</label><br>
                        <input type="text" name="dr" maxlength="8" size="8" value="<?php echo $stats->{"dr"}?>">
                    </div>
                    <div id="sr" class="defense-grid9-11">
                        <label>Spell Resistance</label><br>
                        <input type="text" name="sr" maxlength="8" size="8" value="<?php echo $stats->{"sr"}?>">
                    </div>
                </div>
            </div> <!-- defense section -->
            <div id="offence" class="stat-section">
                <h2>Offence</h2>
                <div class="offence-grid-container">
                    <div class="offence-grid offence-label">Melee</div>
                    <div id="melee-weapon" class="offence-grid">
                        <label>Weapon</label><br>
                        <input type="text" name="melee-weapon" maxlength="15" size="15" value="<?php echo $stats->{"melee-weapon"}?>">
                    </div>
                    <div id="melee-attack-bonus" class="offence-grid">
                        <label>Attack Bonus</label><br>
                        <input type="text" name="melee-attack-bonus" maxlength="15" size="15" value="<?php echo $stats->{"melee-attack-bonus"}?>">
                    </div>
                    <div id="melee-attack-damage" class="offence-grid">
                        <label>Attack Damage</label><br>
                        <input type="text" name="melee-attack-damage" maxlength="15" size="15" value="<?php echo $stats->{"melee-attack-damage"}?>">
                    </div>
                    <div id="melee-attack-critical" class="offence-grid">
                        <label>Critical</label><br>
                        <input type="text" name="melee-attack-critical" maxlength="15" size="15" value="<?php echo $stats->{"melee-attack-critical"}?>">
                    </div>
                    <div id="melee-attack-type" class="offence-grid">
                        <label>Type</label><br>
                        <input type="text" name="melee-attack-type" maxlength="15" size="15" value="<?php echo $stats->{"melee-attack-type"}?>">
                    </div>
                    <div id="melee-attack-notes" class="offence-grid">
                        <label>Notes</label><br>
                        <input type="text" name="melee-attack-notes" maxlength="15" size="15" value="<?php echo $stats->{"melee-attack-notes"}?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>