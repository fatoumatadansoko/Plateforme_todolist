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
    <link href='style.css' rel='stylesheet'>
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #495057;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            background-color: #9b287b;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #ff85a2;
        }
    </style>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="email">Nom d'utilisateur:</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Se Connecter</button>
    </form>
</body>
</html>