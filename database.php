<?php

try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=slownls_sas", "root", "root");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $databaseUser = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255),
            `password` VARCHAR(255) NOT NULL,
            `register_at` DATETIME NOT NULL,
            PRIMARY KEY (`id`)
        );
    ";

    $db->query($databaseUser);
} catch (PDOException $e) {
    print "Error Database : " . $e->getMessage() . " <br/>";
    die();
}