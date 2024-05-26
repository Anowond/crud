<?php

require 'vendor/autoload.php';

// Définir la connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=podcasts','root','');

// Supprimer une entrée
$query = $pdo->query('DELETE FROM users where id = 3');