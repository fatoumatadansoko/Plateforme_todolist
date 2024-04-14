<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
</head>
<body>
    <h2>Bienvenue, <?php echo $_SESSION['email']; ?>!</h2>
    <a href="logout.php">Se Déconnecter</a>
</body>
</html>
 