--violate.sql

/*Primary Key #1: Every movie should have a unique identification number.*/
insert into Movie Value (2,'No2','2','R','TW');
	--Duplicate entry '2' for key 'PRIMARY'

/*Primary Key #2: Every actor should have a unique identification number.*/
insert into Actor Value (10,'Tom','Jerry','M',20000101,20000202);
	--Could not run query: Duplicate entry '10' for key 'PRIMARY'

/*Primary Key #3: Every movie should have a unique record of sales.*/
insert into Sales Value (2,'2','2');
	--Could not run query: Duplicate entry '2' for key 'PRIMARY'

/*Primary Key #4: Every director should have a unique identification number.*/
insert into Director Value (16,'a','b','1','2');
	--Could not run query: Duplicate entry '16' for key 'PRIMARY'

/*Primary Key #5: Every mid+genre of a movie should be unique.*/
insert into MovieGenre Value (3,'Drama');
	--

/*Primary Key #6: Every mid and did pair in MovieDirector should be unique.*/
insert into MovieDirector Value (3,112);
	--

/* Primary Key #7: Every mid and aid pair in MovieActor should be unique.*/
insert into MovieActor Value (100,10208,'hehe');
	--

/* Primary Key #8: Every MovieRating should have a unique mid.*/
insert into MovieRating Value (2,2,2);
	--Could not run query: Duplicate entry '2' for key 'PRIMARY'





/*CHECK #1: Date of birth should be smaller than date of death*/
insert into Actor Value (10,'Tom','Jerry','M',20000101,10000202);
	--Die before Birth

/*Check #2: Tickets Sold should be non negative.*/
insert into Sales Value (7,-1,7);
	--negative amount of tickets

/*CHECK #3: Date of birth should be smaller than date of death*/
insert into Director Value (16,'a','b','2','1');
	--Die before Birth

/* Check #4: movie score should be among 0 to 100.*/
insert into MovieRating Value (2,2,-1);
	--negeative rating


/* Referential Integrity #1: Movie id should exist in table Movie in order to have sales */
insert into Sales Value (10,10,10);
	--

/* Referential Integrity #2: Movie id should exist in table Movie in order to have MovieGenre*/
insert into MovieGenre Value (10,'Drama');
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

/* Referential Integrity #3: Movie id should exist in table Movie in order to have mid in MovieDirector.*/
insert into MovieDirector Value (0,112);
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

/* Referential Integrity #4: Director id should exist in table Director in order to have did in MovieDirector.*/
insert into MovieDirector Value (3,12);
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

/* Referential Integrity #5: Movie id should exist in table Movie in order to have mid in MovieActor.*/
insert into MovieActor Value (0,1,'a');
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

/* Referential Integrity #6: Actor id should exist in table Actor in order to have did in MovieActor.*/
insert into MovieActor Value (10,0,'a');
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))


/* Referential Integrity #7: Movie id should exist in table Movie in order to have mid in MovieRating.*/
insert into MovieRating Value (0,2,2);
	--Could not run query: Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieRating`, CONSTRAINT `MovieRating_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

/* Referential Integrity #8: Movie id should exist in table Movie in order to have mid in Review.*/
insert into Review Value ('a0',0,2,'a0');
	--













