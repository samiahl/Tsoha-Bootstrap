-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Reader (
  id SERIAL PRIMARY KEY,
  reader_name VARCHAR(15),
  reader_password VARCHAR(15)
);

CREATE TABLE Book (
  id SERIAL PRIMARY KEY,
  book_name VARCHAR(50),
  writer VARCHAR(50),
  publisher VARCHAR(50),
  published INTEGER,
  genre VARCHAR(50),
  reader_id INTEGER REFERENCES Reader(id) ON DELETE CASCADE
);