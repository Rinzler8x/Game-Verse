<?php
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "dbmsproject";
            
    // Create connection
    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword);
            
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
            
    // Create database if it doesn't exist
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
            
    if (!mysqli_query($conn, $createDatabaseQuery)) {
        echo "Error creating database: " . mysqli_error($conn) . "\n";
    }
            
    // Connect to the newly created or existing database
    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
            
    // Check if the 'games' table exists
    $tableExistsQuery = "SHOW TABLES LIKE 'games'";
    $tableExistsResult = mysqli_query($conn, $tableExistsQuery);
            
    if (mysqli_num_rows($tableExistsResult) == 0) {
        // 'games' table doesn't exist, create the tables
        $createTablesQuery = "
                CREATE TABLE games(
                    games_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    games_name varchar(128) NOT NULL,
                    games_publisher varchar(128) NOT NULL,
                    games_genre varchar(128) NOT NULL,
                    games_price varchar(128) NOT NULL,
                    games_publishdate varchar(128) NOT NULL
                );
                
                CREATE TABLE users(
                    users_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    users_username varchar(128) NOT NULL,
                    users_email varchar(128) NOT NULL,
                    users_password varchar(128) NOT NULL,
                    users_name varchar(128) NOT NULL
                );
                
                CREATE TABLE bill(
                    bill_count int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    bill_id int(11) NOT NULL,
                    bill_userid int(11) NOT NULL,
                    bill_gameid int(11) NOT NULL,
                    bill_date varchar(128) NOT NULL,
                    bill_amount varchar(128) NOT NULL,
                );
                
                INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Forza Horizon 5', 'Xbox Games Studios', 'Racing', '3499', '5 November 2021');
                INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Microsoft Flight Simulator 2020', 'Aerosoft', 'Simulator', '5999', '18 August 2020');
                INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Grand Theft Auto V', 'Rockstar Games', 'RPG', '2599', '17 September 2013');
                INSERT INTO games (games_name, games_publisher, games_genre, games_price, games_publishdate) VALUES('Fallout 76', 'Bethesda Softworks', 'Strategy', '2000', '23 October 2018');";
            
        if (!mysqli_multi_query($conn, $createTablesQuery)) {
            echo "Error creating tables: " . mysqli_error($conn);
        } 
    }