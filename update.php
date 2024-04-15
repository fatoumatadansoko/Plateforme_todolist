<?php
// Inclure le fichier de configuration
require_once "config.php";
require_once "todo.php";

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])){
    // Récupération des données
    $id = $_GET["id"]; // Récupération de l'id de la tâche à partir de la requête GET
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $date_time = $_POST['date_time'];
    $date_echeance = $_POST['date_echeance'];
    $priorite = $_POST['priorite'];
    $checked = isset($_POST['checked']) ? 1 : 0; // Si la case est cochée, mettre à 1, sinon à 0
    $etat = $_POST['etat'];

    // Requête SQL pour mettre à jour les données de la tâche
    $sql = "UPDATE todos 
            SET libelle = :libelle, description = :description, date_time = :date_time, date_echeance = :date_echeance, checked = :checked, priorite = :priorite, etat = :etat
            WHERE id = :id";
    
    // Préparation de la requête
    $stmt = $conn->prepare($sql);
    
    // Lier les valeurs aux paramètres de la requête
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':date_time', $date_time, PDO::PARAM_STR);
    $stmt->bindParam(':date_echeance', $date_echeance, PDO::PARAM_STR);
    $stmt->bindParam(':priorite', $priorite, PDO::PARAM_INT);
    $stmt->bindParam(':checked', $checked, PDO::PARAM_INT);
    $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);

    // Exécution de la requête
    if($stmt->execute()){
        // Redirection vers la page todolist.php après la modification
        header("location: todolist.php");
        exit();
    } else {
        echo "Erreur lors de la modification de la tâche";
    }
}

// Récupération des données de la tâche à partir de son id
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM todos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Récupération des données de la tâche
$todo = $stmt->fetch(PDO::FETCH_ASSOC);
$libelle = $todo['libelle'];
$description = $todo['description'];
$date_time = $todo['date_time'];
$date_echeance = $todo['date_echeance'];
$priorite = $todo['priorite'];
$checked = $todo['checked'];
$etat = $todo['etat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Déclaration des métadonnées -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>TodoList - Modifier Tâche</title>
    <!-- Inclusion du CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Section principale de la page -->
    <section class="container mt-5">
        <!-- Titre principal -->
        <h1 class="text-center">Modifier Tâche</h1>
        <!-- Formulaire de modification de la tâche -->
        <form action="" method="post">
            <!-- Champ pour le libellé de la tâche -->
            <input type="text" name="id"   value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="libelle" class="form-label">Libellé</label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $libelle; ?>" required>
            </div>
            <!-- Champ pour la description de la tâche -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
            </div>
            <!-- Champ pour la date de création de la tâche -->
            <div class="mb-3">
                <label for="date_time" class="form-label">Date de Création</label>
                <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo $date_time; ?>" required>
            </div>
            <!-- Champ pour la date d'échéance de la tâche -->
            <div class="mb-3">
                <label for="date_echeance" class="form-label">Date d'Échéance</label>
                <input type="datetime-local" class="form-control" id="date_echeance" name="date_echeance" value="<?php echo $date_echeance; ?>" required>
            </div>
            <!-- Champ pour la priorité de la tâche -->
            <div class="mb-3">
                <label for="priorite" class="form-label">Priorité</label>
                <select class="form-select" id="priorite" name="priorite" required>
                    <option value="1" <?php if ($priorite == 1) echo 'selected'; ?>>Faible</option>
                    <option value="2" <?php if ($priorite == 2) echo 'selected'; ?>>Moyenne</option>
                    <option value="3" <?php if ($priorite == 3) echo 'selected'; ?>>Élevée</option>
                </select>
            </div>
            <!-- Champ pour l'état de la tâche -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="checked" name="checked" <?php if ($checked == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="checked">Cochée</label>
            </div>
            <!-- Champ pour l'état de la tâche -->
            <div class="mb-3">
                <label for="etat" class="form-label">État</label>
                <select class="form-select" id="etat" name="etat" required>
                    <option value="en_cours" <?php if ($etat == 'en_cours') echo 'selected'; ?>>À faire</option>
                    <option value="terminee" <?php if ($etat == 'terminee') echo 'selected'; ?>>En cours</option>
                    <option value="reportee" <?php if ($etat == 'reportee') echo 'selected'; ?>>Terminer</option>
                </select>
            </div>
            <!-- Bouton de soumission du formulaire -->
            <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
        </form>
    </section>

</body>
</html>
