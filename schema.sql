CREATE DATABASE dbmsproject;

CREATE TABLE games(
    games_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    games_name varchar(128) NOT NULL,
    games_publisher varchar(128) NOT NULL,
    games_genre varchar(128) NOT NULL,
    games_price varchar(128) NOT NULL,
    games_publishdate varchar(128) NOT NULL
);

DESCRIBE games;

CREATE TABLE users(
    users_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    users_username varchar(128) NOT NULL,
    users_email varchar(128) NOT NULL,
    users_password varchar(128) NOT NULL,
    users_name varchar(128) NOT NULL
);

DESCRIBE users;

CREATE TABLE bill(
    bill_count int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    bill_id int(11) NOT NULL,
    bill_userid int(11) NOT NULL,
    bill_gameid int(11) NOT NULL,
    bill_date varchar(128) NOT NULL,
    bill_amount varchar(128) NOT NULL,
);

DESCRIBE bill;

INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Forza Horizon 5', 'Xbox Games Studios', 'Racing', '3499', '5 November 2021');
INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Microsoft Flight Simulator 2020', 'Aerosoft', 'Simulator', '5999', '18 August 2020');
INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Grand Theft Auto V', 'Rockstar Games', 'RPG', '2599', '17 September 2013');
INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Fallout 76', 'Bethesda Softworks', 'Strategy', '2000', '23 October 2018');