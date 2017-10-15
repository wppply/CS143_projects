--queries 1
--Give me the names of all the actors in the movie 'Death to Smoochy'

select distinct concat("<",first,"> <",last,">")
from Actor,Movie,MovieActor
where MovieActor.aid = Actor.id 
		and Movie.id = MovieActor.mid 
		and Movie.title = 'Death to Smoochy';


--queries 2
--Give me the count of all the directors who directed at least 4 movies.

SELECT COUNT(*)
FROM (SELECT did, COUNT(mid) as Mnum
	  FROM MovieDirector
	  GROUP BY did) as DirectorMNUM
WHERE DirectorMNUM.Mnum>=4;


--queries 3 
--Give me the name of actor born after 2000.

SELECT distinct concat("<",first,"> <",last,">")
FROM Actor 
WHERE Actor.dob>20000000;


--queries 4
--Give me the names of movies that have rating higher than 85 on imdb.

SELECT m.title 
FROM Movie m, MovieRating r
WHERE m.id=r.mid and r.imdb>85;

