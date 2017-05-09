DESCRIBE countrydata;

SELECT * FROM countrydata ORDER BY country;

SELECT * FROM countrydata WHERE population = (SELECT max(population) FROM countrydata);

SELECT * FROM countrydata WHERE population = (SELECT min(population) FROM countrydata);

SELECT * FROM countrydata WHERE language LIKE '%dutch%';