--queries 1
--Give me the names of all the actors in the movie 'Death to Smoochy'

select distinct concat("<",first,"> <",last,">")
from Actor,Movie,MovieActor
where MovieActor.aid = Actor.id 
		and Movie.id = MovieActor.mid 
		and Movie.title = 'Death to Smoochy';


--queries 3 
--give the name of actor born after 2000

SELECT distinct concat("<",first,"> <",last,">")
FROM Actor 
WHERE Actor.dob>20000000;
