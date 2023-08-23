<?php
require_once '../db.php'; 

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $full_name = $_POST["full_name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  // Hash du mot de passe 
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  // Insertion dans la base de données 
  $query = "INSERT INTO utilisateurs (full_name, email, password_hash) VALUES (:full_name, :email, :password_hash)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'full_name' => $full_name,
    'email' => $email,
    'password_hash' => $password_hash,
  ]);

  header('Location: /pages/login-user.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Bienvenue sur la page d'inscription du votant</h1>
  <h2>Inscription Votant</h2>
  <form method="post" action="/pages/register-user.php">

    <div>
      <label for="full_name"> full_name </label>
      <input id="full_name" type="text" name="full_name" placeholder="Nom du votant" required>
    </div>
    
    <div>
      <label for="email"> email </label>
      <input type="email" name="email" placeholder="Adresse e-mail" required>
    </div>
    <div>
      <label for="password"> password </label>
      <input type="password" name="password" placeholder="Mot de passe" required>
    </div>
    <button type="submit" name="register">S'inscrire en tant que votant</button>

  </form>

</body>

</html>
