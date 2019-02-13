<?php
    try
    {
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);
    $book = $_GET["book"];
    $id = $_GET["id"];
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');
    
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $book = $_POST["book"];
    $chapter = $_POST["chapter"];
    $verse = $_POST["verse"];
    $content = $_POST["content"];

    $statement = $db->prepare("INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES (:book, :chapter, :verse, :content);");
    $statement->execute(array('book' => $book, 'chapter' =>$chapter, 'verse' => $verse, 'content' => $content));
    $statement = $db->lastInsertId('scripture_Id_seq');

    foreach ($topic as $topics){ 
        //insert query inside ScriptureTopic for each flagged topic
        $topicid = $topic["id"];
        $statement = $db->prepare("INSERT INTO ScriptureTopics (IDTopic, IDScripture) VALUES ('$topicid,$newid");

    }
}
catch (PDOException $ex)
    {
    echo 'Error!: ' . $ex->getMessage();
    die();
    }
?>

