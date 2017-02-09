-- create a database. this can have a general name

CREATE DATABASE LighthouseDB;


-- create a table. this is a specific place for data
CREATE TABLE Users
(
userId int NOT NULL AUTO_INCREMENT,
name varchar(255) UNIQUE NOT NULL,
pass varchar(255) NOT NULL,
drinkCount int NOT NULL,
admin boolean NOT NULL,
approved boolean NOT NULL,
PRIMARY KEY (userId)
);

-- drop a table
DROP TABLE Users;

-- get the list of users to check for existing usernames
SELECT * FROM Users
WHERE name=<givenUsername>;


-- Orders Table
-- ID, drink, user, (op)ingredients(probs not)
-- if we want to populate the ingredients, there are some options
-- 		1) read the ingredients from the drinks database when populating; could be time intensive?
--		2) create drink objects, serialize them and store them; probably would be obnoxious and not work
--		3) they got on the menu somehow, just transfer them over, maybe put them in this database
-- I like Number 1 the most
CREATE TABLE Orders
(
orderId int NOT NULL UNIQUE AUTO_INCREMENT,
drinkName varchar(50) NOT NULL,
user varchar(255) NOT NULL,
confirmed boolean NOT NULL,
PRIMARY KEY (orderId)
);


-- Drinks Table
-- drinkName, description, picture, ingredients
-- how to do ingredients? would prefer them bulleted and also garnish and optional things italicized
-- timesOrdered probably isnt needed, we can get that info from Orders table
-- *** consider adding a category column

CREATE TABLE Drinks
(
drinkName varchar(50) UNIQUE NOT NULL,
description varchar(255) NOT NULL,
picture varchar(20) UNIQUE NOT NULL,
ingredients varchar(255) NOT NULL,
category varchar(255) NOT NULL
);

-- put in two drinks just for development purposes
INSERT INTO Drinks (
drinkName,
description,
picture,
ingredients
)
VALUES (
'Old Fashioned',
'The Old Fashioned is an excellent drink.',
'oldfashioned',
'Bourbon or Rye Whiskey,Angostura Bitters,Simple Syrup,Garnished with orange peel and a cherry'
);

-- make user an admin
UPDATE Users
SET admin=true, approved=true
WHERE name='admin';

-- add a date column for the orders table
ALTER TABLE Orders
ADD dateOrdered DATE;

-- set all dates to the first night
-- format for dates: 'YYYY-MM-DD' 
UPDATE Orders
SET dateOrdered="2016-08-24";

-- select all orders of a particular user
SELECT drinkName, dateOrdered
FROM Orders
WHERE user=$user;

-- delete a drink from the menu in SQL
DELETE FROM Drinks
WHERE drinkName='Dusky Christmas';

-- add the Inventory table
-- this database is intended to track the remaining amount of bottled ingredients
--   bottleName (varchar(35))   : unique name of bottle, like "four roses bourbon" or "irish cream liqueur"
--   amountRemaining (real) : the volume of liquid remaining, in oz
CREATE TABLE Inventory
(
bottleName varchar(35) UNIQUE NOT NULL,
amountRemaining real NOT NULL
)

-- put something into Inventory
INSERT INTO Inventory (
bottleName,
amountRemaining
) VALUES (
"irish cream liqueur",
"25.36"
)

-- add a recipe column to hold amounts (in oz)
ALTER TABLE Drinks
ADD recipe varchar(25);

-- add the recipe for honey bee - this will be our test drink
UPDATE Drinks
SET recipe="1.5,0.5,0.25"
WHERE drinkName="Honey Bee";

-- get name of drink associated with an order id
SELECT drinkName
FROM Orders
WHERE orderId=$id;

-- get ingredients and recipe from the orders table
SELECT 
FROM Orders
WHERE orderId=$id;