<?php

require 'vendor/autoload.php';

// Définir la connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=podcasts','root','');

// Créer des données dans une table
$query = $pdo->query('INSERT INTO users (name, avatar) VALUES ("Marc Bichon", "http://www.avatar.com")');