<!DOCTYPE html>
<html>
<header> Scripture Resources </header>

<body>

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
    $topics = $_POST["topic"];
    echo "$topic";

    $statement = $db->prepare("INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES (:book, :chapter, :verse, :content);");
    $statement->execute(array('book' => $book, 'chapter' =>$chapter, 'verse' => $verse, 'content' => $content));
    $lastId = $db->lastInsertId('scripture_Id_seq');

    

    foreach ($topics as $topic){ 
        //insert query inside ScriptureTopic for each flagged topic
        $topicId = $topic["id"];
        $statement = $db->prepare("INSERT INTO ScriptureTopic (IDTopic, IDScripture) VALUES (':IDTopic, :IDScripture");
        $statement->bindValue(':IDScripture', $lastId);
		$statement->bindValue(':IDTopic', $topicId);
        $statement.execute();

        }
    } catch (PDOException $ex)
        {
        echo 'Error!: ' . $ex->getMessage();
        die();
        }

$statement = $db->prepare('SELECT Scripture.book, Scripture.chapter, Scripture.verse, Scripture.content, Topic.name
                      FROM ScriptureTopic As ST
                      ON Scripture AS S WHERE ST.IDScripture=S.ID
                      ON Topic As T WHERE ST.IDTopic = T.ID');

    //$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scripture');
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $dbBook = $row["book"];
        $dbChapter = $row["chapter"];
        $dbVerse = $row["verse"];
        $dbTopic = $row["name"];
        $dbContent = $row["content"];
        echo "Topic: $dbTopic<br>";
        echo " $dbBook $dbChapter:$dbVerse<br>";
        echo " $dbContent<br><br>";
    }
?>

</body>

</html>