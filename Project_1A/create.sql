CREATE TABLE IF NOT EXISTS Movie (
id INT PRIMARY KEY NOT NULL, 
/*Primary Key #1: Every movie should have a unique identification number.*/
title VARCHAR(100) NOT NULL,
year INT NOT NULL,
rating VARCHAR(10) NOT NULL,
company VARCHAR(50) NOT NULL
)ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS Actor (
id INT PRIMARY KEY NOT NULL,
/*Primary Key #2: Every actor should have a unique identification number.*/
last VARCHAR(20) NOT NULL,
first VARCHAR(20) NOT NULL,
sex VARCHAR(6) NOT NULL,
dob DATE NOT NULL,
dod DATE,
CHECK (dob <= dod)
/*CHECK #1: Date of birth should be smaller than date of death*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS Sales (
mid INT PRIMARY KEY NOT NULL,
/*Primary Key #3: Every movie should have a unique record of sales.*/
ticketsSold INT NOT NULL,
totalIncome INT NOT NULL,
FOREIGN KEY fk_mid(mid) 
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
/* Referential Integrity #1: Movie id should exist in table Movie in order to have sales */
CHECK (ticketsSold >= 0)
/*Check #2: Tickets Sold should be non negative.*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS Director (
id INT PRIMARY KEY NOT NULL,
/*Primary Key #4: Every director should have a unique identification number.*/
last VARCHAR(20) NOT NULL,
first VARCHAR(20) NOT NULL,
dob DATE NOT NULL,
dod DATE,
CHECK (dob <= dod)
/*CHECK #3: Date of birth should be smaller than date of death*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MovieGenre (
mid INT NOT NULL,
genre VARCHAR(20) NOT NULL,
PRIMARY KEY(mid,genre),
/*Primary Key #5: Every mid+genre of a movie should be unique.*/
FOREIGN KEY fk_mid(mid)
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE
/* Referential Integrity #2: Movie id should exist in table Movie in order to have MovieGenre*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MovieDirector (
mid INT NOT NULL, 
did INT NOT NULL,
PRIMARY KEY(mid,did),
/*Primary Key #6: Every mid and did pair in MovieDirector should be unique.*/
FOREIGN KEY fk_mid(mid)
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
/* Referential Integrity #3: Movie id should exist in table Movie in order to have mid in MovieDirector.*/
FOREIGN KEY fk_did(did)
REFERENCES Director(id)
ON UPDATE CASCADE
ON DELETE CASCADE
/* Referential Integrity #4: Director id should exist in table Director in order to have did in MovieDirector.*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MovieActor (
mid INT NOT NULL, 
aid INT NOT NULL, 
role VARCHAR(50) NOT NULL,
PRIMARY KEY(mid,aid),
/* Primary Key #7: Every mid and aid pair in MovieActor should be unique.*/
FOREIGN KEY fk_mid(mid)
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
/* Referential Integrity #5: Movie id should exist in table Movie in order to have mid in MovieActor.*/
FOREIGN KEY fk_aid(aid)
REFERENCES Actor(id)
ON UPDATE CASCADE
ON DELETE CASCADE
/* Referential Integrity #6: Actor id should exist in table Actor in order to have did in MovieActor.*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MovieRating (
mid INT PRIMARY KEY NOT NULL, 
/* Primary Key #8: Every MovieRating should have a unique mid.*/
imdb INT NOT NULL, 
rot INT NOT NULL,
FOREIGN KEY fk_mid(mid)
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
/* Referential Integrity #7: Movie id should exist in table Movie in order to have mid in MovieRating.*/
CHECK (imdb >= 0 and imdb <= 100 and rot >= 0 and rot <= 100)
/* Check #4: movie score should be among 0 to 100.*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS Review (
name VARCHAR(20)  NOT NULL,
time TIMESTAMP  NOT NULL,
mid INT  NOT NULL,
rating INT  NOT NULL,
comment VARCHAR(500)  NOT NULL,
PRIMARY KEY(name,time,mid),
/*Primary Key #9: Every reviewer's name, time and movie id are unique in the table.*/
FOREIGN KEY fk_mid(mid)
REFERENCES Movie(id)
ON UPDATE CASCADE
ON DELETE CASCADE
/* Referential Integrity #8: Movie id should exist in table Movie in order to have mid in Review.*/
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MaxPersonID (
id INT NOT NULL
)ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS MaxMovieID (
id INT NOT NULL
)ENGINE = INNODB;



