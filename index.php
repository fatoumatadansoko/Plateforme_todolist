<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valider les données du formulaire (ne pas oublier de le faire !)
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT user_id, email FROM user WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        header('Location: todolist.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    <title>Connexion</title>
</head>
<body>
<div class="circle"></div>
    <div class="card">
        <div class="logo">
        </div>
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form class= "form" action="index.php" method="post">
        <label for="email">Nom d'utilisateur:</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Se Connecter</button>
    </form>

<footer>
            Pas de compte, s'inscrire
            <a href="#">Here</a>
        </footer>
    </div>
    </body>
</html>


