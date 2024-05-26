<?php

require 'vendor/autoload.php';

// Définir la connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=podcasts', 'root', '');

// Mise à jour d'un enregistrement d'une table
$query = $pdo->query('UPDATE podcasts SET name = "Podcast n°1" WHERE id = 1');
