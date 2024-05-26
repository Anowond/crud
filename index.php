<?php
require './vendor/autoload.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=podcasts', 'root', '');

if (!empty($_POST)) {
    $errors = [];
    // Validation des données
    if (empty($_POST['name'])) {
        $errors['name'] = 'Le nom est obligatoire';
    } elseif (strlen($_POST['name']) < 3) {
        $errors['name'] = 'Le nom doit contenir au moins 3 caractéres';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'L\'email est obligatoire';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Le mot de passe est obligatoire';
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = 'Le mot de passe doit contenir au moins 8 caractéres';
    } elseif ($_POST['password'] !== $_POST['password_confirmation']) {
        $errors['password'] = 'Les mots de passes ne correspondent pas';
    }

    if (empty($errors)) {
        // Hashage du password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Insertion en base de données
        $query = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $query->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $query->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
        $query->execute();
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire de création</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
  </head>
  <body class="container mt-5">
  <form method="POST" action="#" novalidate>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
    <?php if (!empty($errors['name'])) : ?>
    <p class="text-danger"><?= $errors['name'] ?></p>
    <?php endif ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email">
    <?php if (!empty($errors['email'])) : ?>
    <p class="text-danger"><?= $errors['email'] ?></p>
    <?php endif ?>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <?php if (!empty($errors['password'])) : ?>
    <p class="text-danger"><?= $errors['password'] ?></p>
    <?php endif ?>
  </div>
  <div class="mb-3">
    <label for="password_confirmation" class="form-label">Password Confirmation</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </body>
</html>