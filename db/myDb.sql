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
    jsonString TEXT
);

SELECT * FROM userTable;

SELECT * FROM characterSheets;