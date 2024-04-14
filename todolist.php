<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<?php
// Inclure le fichier contenant la classe Student
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Déclaration des métadonnées -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Titre de la page -->
    <title>Todolist</title>
    <!-- Inclusion du JavaScript Bootstrap -->
</head>

<body>
<h2>Bienvenue, <?php echo $_SESSION['email']; ?>!</h2>
<a href="logout.php">Se Déconnecter</a>
    <div class="main-section">
        <div class="add-section">
             <form action="add.php" method="POST" autocomplete="off">
                <label for="libelle">Titre :</label>
                <?php
                // Afficher un message d'erreur avec une bordure rouge si 'mess' est défini à 'error' dans la requête GET
                if (isset($_GET['mess']) && $_GET['mess'] == 'error') {
                    echo '<input type="text" name="libelle" style="border-color: #ff6666" placeholder="Ce champ est obligatoire" />';
                } else {
                    // Texte d'espace réservé par défaut pour le champ de saisie de la tâche
                    echo '<input type="text" name="libelle" placeholder="Libellé" />';
                }
                ?>
                <label for="description">Description :</label>
                <input type="text" name="description" placeholder="Description" />
                <label for="date_echeance">Date d'échéance :</label>
                <input type="datetime-local" name="date_echeance" id="date_echeance">
                <label for="priorite">Priorité :</label>
                <select name="priorite" id="priorite">
                    <option value="1">Faible</option>
                    <option value="2">Moyenne</option>
                    <option value="3">Élevée</option>
                </select>
                <label for="etat">État :</label>
                <select name="etat" id="etat">
                    <option value="1">À faire</option>
                    <option value="2">En cours</option>
                    <option value="3">Términer</option>
                </select>
                <button type="submit">Ajouter &nbsp; <span>&#43;</span></button>
            </form> 
        </div>

        <div class="show-todo-section">
            <?php
            // Préparer la requête SQL pour récupérer les tâches
            $stmt = $conn->prepare("SELECT * FROM todos ORDER BY id DESC");
            // Exécuter la requête
            $stmt->execute();
            // Afficher les tâches
            
              
                 while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="todo-item <?= $todo['checked'] ? 'checked' : '' ?>" data-todo-id="<?= $todo['id'] ?>">
                        <input type="checkbox" class="check-box" data-todo-id="<?= $todo['id'] ?>" <?= $todo['checked'] ? 'checked' : '' ?>>
                        <h2><?= $todo['libelle'] ?></h2>
                        <a href="check.php?id=<?= $todo['id'] ?>">Cocher</a>                       
                         <a href="update.php?id=<?= $todo['id'] ?>">Modifier</a>
                        <a href="remove.php?id=<?= $todo['id'] ?>">Supprimer</a>
                        <p>Description : <?= $todo['description'] ?></p>
                        <p>Date de création : <?= $todo['date_time'] ?></p>
                        <p>Priorité : <?= $todo['priorite'] == 1 ? 'Faible' : ($todo['priorite'] == 2 ? 'Moyenne' : 'Élevée') ?></p>
                        <p>État : <?= $todo['etat'] == 1 ? 'À faire' : ($todo['etat'] == 2 ? 'En cours' : 'Terminer') ?></p>
                        <p>Date d'échéance : <?= $todo['date_echeance'] ?></p>
                    </div>
                <?php endwhile; ?>
                
        </div>

    </div>

    
</body>

</html>