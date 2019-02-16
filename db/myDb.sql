CREATE SCHEMA myschema;

SHOW search_path;

SET search_path TO myschema,public;

SHOW search_path;

CREATE TABLE userTable (
    id SERIAL PRIMARY KEY,
    username VARCHAR(30) UNIQUE NOT NULL,
    passwordHash VARCHAR(80) UNIQUE NOT NULL
);

INSERT INTO usertable (username, passwordhash)
  VALUES ('testUser', '$2y$10$vNl6sAAqI9ZsCMTOG1A/OeNJ09C0h.roS1euzwWph4yHP54iu9h7i');

CREATE TABLE characterSheets (
    id SERIAL PRIMARY KEY,
    userID INT REFERENCES userTable(id) NOT NULL,
    campaign VARCHAR(80),
    jsonString TEXT,
    characterName VARCHAR(80),
    characterClass VARCHAR(80),
    characterLevel INT,
    characterRace VARCHAR(80)
);

SELECT * FROM userTable;

SELECT * FROM characterSheets;

INSERT INTO charactersheets (userid, jsonstring, charactername)
  VALUES (1, '{"character-name":"Retoll", "alignment":"CN", "race":"Half-Orc"}', 'Retoll');

INSERT INTO charactersheets (userid, jsonstring, charactername, characterclass, characterlevel, characterrace)
  VALUES (1, '{"character-name":"Boric Riverstride", "alignment":"CG", "race":"Human"}', 'Boric Riverstride', 'Fighter', 1, 'Human');

SELECT jsonstring, charactername, characterlevel, username
  FROM charactersheets cs,  usertable ut 
  WHERE cs.userid = ut.id AND ut.username = 'seconduser' AND cs.id = 1;

