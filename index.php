<?php
// Inclure le fichier contenant la classe Student
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Déclaration des métadonnées -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>PHP - MYSQL - CRUD</title>
    <!-- Inclusion du JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
<div class="main-section">
    <div class="add-section">
      <form action="app/add.php" method="POST" autocomplete="off">
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
        <button type="submit">Ajouter &nbsp; <span>&#43;</span></button>
      </form>
    </div>

    <div class="show-todo-section">

      <?php

      // Inclure le fichier de connexion à la base de données
      require 'db_conn.php';

      


      // Requête SQL pour récupérer les tâches
      $stmt = $conn->prepare("SELECT * FROM todos ");
      
      $stmt->execute();

      
      ?>

      <?php
      // Vérifier s'il y a des tâches
      if ($totalTodos <= 0) {
        // Afficher un message s'il n'y a pas de tâches
        echo '<div class="todo-item">
          <div class="empty">
            <img src="img/file.png" width="100%" />
            <img src="img/Ellipsis.gif" width="90px">
          </div>
        </div>';
      } else {

        // Afficher les tâches
        while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<div class="todo-item">';
          echo '<h2>' . $todo['libelle'] . '</h2>'; // Afficher le titre en premier
          echo '<p>Description : ' . $todo['description'] . '</p>'; // Ensuite la description
          echo '<p>Date de création : ' . $todo['date_time'] . '</p>'; // Puis la date de création
          echo '<p>Priorité : ';
          switch ($todo['priorite']) {
            case 1:
              echo 'Faible';
              break;
            case 2:
              echo 'Moyenne';
              break;
            case 3:
              echo 'Élevée';
              break;
            default:
              echo 'Inconnue';
              break;
          }
          echo '</p>';
          echo '<p>Date d\'échéance : ' . $todo['date_echeance'] . '</p>'; // Enfin la date d'échéance
          echo '</div>'; // Fermer le conteneur pour chaque tâche
        }
      }
      ?>
    </div>
  </div>
<section style="margin: 50px 0;">
    <!-- Conteneur principal -->
    <div class="container">
        <!-- Tableau pour afficher les données -->
        <table class="table table-dark">
            <thead>
                <!-- En-têtes de colonne -->
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Marks</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $student) { ?>
                <!-- Affichage des données dans les lignes du tableau -->
                <tr class="trow">
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['class']; ?></td>
                    <td><?php echo $student['marks']; ?></td>
                    <!-- Bouton pour éditer les données avec un lien vers updatedata.php -->
                    <td><a href="update.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">Edit</a></td>
                    <!-- Bouton pour supprimer les données avec un lien vers deletedata.php -->
                    <td><a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

</body>

</html>