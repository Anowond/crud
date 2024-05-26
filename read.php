<?php

require 'vendor/autoload.php';

// Définir la connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=podcasts','root','');

// Créer une requête a partir de PDO
$query = $pdo->query('SELECT 
content, users.name AS username, podcasts.name AS podcastname FROM COMMENTS 
JOIN USERS ON user_id = users.id 
JOIN PODCASTS ON podcast_id = podcasts.id 
WHERE user_id = 2', 
PDO::FETCH_ASSOC);
// Récupération des résultats
$response = $query->fetchAll();
dump($response);
