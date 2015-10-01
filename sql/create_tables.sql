-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Reader (
  id SERIAL PRIMARY KEY,
  reader_name VARCHAR(50) NOT NULL,
  reader_password VARCHAR(50) NOT NULL
);

CREATE TABLE Book (
  id SERIAL PRIMARY KEY,
  book_name VARCHAR(50) NOT NULL ,
  writer VARCHAR(50),
  publisher VARCHAR(50),
  published INTEGER,
  genre VARCHAR(50)
);