CREATE TABLE teamstats (Team VARCHAR(50), FirstYear INT , G INT , W INT , L INT , Pennants INT , WS INT , R INT , AB INT , H INT , HR INT , AVG FLOAT , RA INT , ERA FLOAT );

LOAD DATA INFILE 'c:/xampp/htdocs/Stenden-PHP2/team_stats.txt' INTO TABLE teamstats FIELDS TERMINATED BY '	';

SELECT Team FROM teamstats WHERE FirstYear BETWEEN '1900' AND '1920';