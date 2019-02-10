CREATE SCHEMA myschema;

SHOW search_path;

SET search_path TO myschema,public;

SHOW search_path;

CREATE TABLE userTable (
    id SERIAL PRIMARY KEY,
    username VARCHAR(30),
    salt VARCHAR(80),
    passwordHash VARCHAR(80)
);

CREATE TABLE characterSheets (
    id SERIAL PRIMARY KEY,
    userID INT REFERENCES userTable(id),
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
  VALUES (2, '{"character-name":"Retoll", "alignment":"CN", "race":"Half-Orc"}', 'Retoll');

INSERT INTO charactersheets (userid, jsonstring, charactername, characterclass, characterlevel, characterrace)
  VALUES (2, '{"character-name":"Boric Riverstride", "alignment":"CG", "race":"Human"}', 'Boric Riverstride', 'Fighter', 1, 'Human');

