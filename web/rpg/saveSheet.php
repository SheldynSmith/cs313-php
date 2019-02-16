<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sanitizedArray = array();
foreach($_POST as $key => $value) {
    $cleanKey = htmlspecialchars($key);
    $cleanValue = htmlspecialchars($value);
    $sanitizedArray[$cleanKey] = $cleanValue;
}
$statsJSON = json_encode($sanitizedArray);
$characterID = $_SESSION["characterID"];

$cleanName = $sanitizedArray["character-name"];
$cleanClass = $sanitizedArray["character-class"];
$cleanLevel = $sanitizedArray["level"];
$cleanRace = $sanitizedArray["race"];


require ("dbConnect.php");
$db = get_db();

$statement = $db->prepare("UPDATE charactersheets
                           SET jsonstring     = :cleanJson
                               charactername  = :cleanName
                               characterclass = :cleanClass
                               characterlevel = :cleanLevel
                               characterrace  = :cleanRace
                           WHERE id = :cleanID");
$statement->bindValue(":cleanJson", $statsJSON, PDO::PARAM_STR);
$statement->bindValue(":cleanName", $cleanName, PDO::PARAM_STR);
$statement->bindValue(":cleanClass", $cleanClass, PDO::PARAM_STR);
$statement->bindValue(":cleanLevel", $cleanLevel, PDO::PARAM_STR);
$statement->bindValue(":cleanRace", $cleanRace, PDO::PARAM_STR);
$statement->bindValue(":cleanID", $characterID, PDO::PARAM_STR);
$statement.execute();

// update charactername, characterclass, characterlevel, and characterrace in db
?>