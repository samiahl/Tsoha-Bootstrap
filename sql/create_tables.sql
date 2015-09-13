-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Reader (
  id SERIAL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

CREATE TABLE Book (
  id SERIAL PRIMARY KEY,
  reader_id INTEGER REFERENCES Reader(id),
  name VARCHAR(50) NOT NULL,
  writer VARCHAR(50) NOT NULL,
  publisher VARCHAR(50) NOT NULL,
  published INTEGER NOT NULL,
  genre VARCHAR(50),
  readornot boolean DEFAULT FALSE
);