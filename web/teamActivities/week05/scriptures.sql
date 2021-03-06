CREATE TABLE Scripture (
    ID SERIAL PRIMARY KEY NOT NULL,
    Book varchar(80) NOT NULL,
    Chapter INT NOT NULL,
    Verse INT NOT NULL, 
    Content TEXT NOT NULL
);

INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES ('John', 1, 5, 'And the ligth shineth in darkness; and the darkness comprehended it not.');
INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES ('Doctrine and Covenants', 88, 49, 'The light shineth in darkness, and the darkness comprehendeth it not; nevertheless, the day shall come when you shall comprehend even God, being quickened in him and by him.');
INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.' );
INSERT INTO Scripture (Book, Chapter, Verse, Content) VALUES ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');

CREATE TABLE Topic (
    ID SERIAL PRIMARY KEY NOT NULL,
    Name varchar(80) NOT NULL
);

ALTER TABLE Scripture ADD PRIMARY KEY(ID);

INSERT INTO Topic (Name) VALUES ('Faith');
INSERT INTO Topic (Name) VALUES ('Sacrifice');
INSERT INTO Topic (Name) VALUES ('Charity');

CREATE TABLE ScriptureTopic (
    IDTopic INT NOT NULL REFERENCES Topic(ID),
    IDScripture INT NOT NULL REFERENCES Scripture(ID)
);

SELECT Scripture.book, Scripture.chapter, Scripture.verse, Scripture,content, Topic.name
FROM ScriptureTopic AS ST
ON Scripture AS S WHERE ST.IDScripture=S.ID
ON Topic AS T WHERE ST.IDTopic = T.ID;


