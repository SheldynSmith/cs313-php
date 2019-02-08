<?php
require "dbConnect.php";
$db = get_db();
$userName = "testUser";
$statement = $db->prepare("SELECT jsonstring, charactername FROM charactersheets cs, usertable ut WHERE cs.userid = ut.id AND ut.username = '$userName'");
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
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
    <h1>Pathfinder Character Sheet</h1>
    <form>
        <div id="general" class="stat-section">
            <h2>General</h2>
            <div id="character-name" class="stat-container" value="<?php $row["charactername"]?>">
                <label>Character name</label><br>
                <input type="text" name="character-name">
            </div>
            <div id="alignment" class="stat-container" value="<?php $stats->{"alignment"}?>">
                <label>Alignment</label><br>
                <input type="text" name="alignment">
            </div>
            <div id="player-name" class="stat-container">
                <label>Player Name</label><br>
                <input type="text" name="player-name">
            </div>
            <div id="character-class" class="stat-container">
                <label>Character Class</label><br>
                <input type="text" name="character-class">
            </div>
            <div id="level" class="stat-container">
                <label>Level</label><br>
                <select name="level">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
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
                <input type="text" name="race" value="<?php $stats->{"race"}?>">
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