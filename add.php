<?php

if (isset($_POST['libelle'])) {
  require 'config.php';

  $libelle = trim($_POST['libelle']);
  $description = isset($_POST['description']) ? trim($_POST['description']) : '';
  $date_echeance = isset($_POST['date_echeance']) ? $_POST['date_echeance'] : '';
  $priorite = isset($_POST['priorite']) ? (int)$_POST['priorite'] : 1; // Set default priority to 1
  $etat = isset($_POST['etat']) ? (int)$_POST['etat'] : 1; // Set default priority to 1

  // Validation (similar to your existing code)
  if (empty($libelle)) {
    header("Location: todolist.php?mess=error");
  } else {
    // Prepare the SQL statement with the new `priorite` field
    $stmt = $conn->prepare("INSERT INTO todos(libelle, description, date_echeance, priorite, etat) VALUES(?, ?, ?, ?, ?)");
    $res = $stmt->execute([$libelle, $description, $date_echeance, $priorite, $etat]);

    if ($res) {
      header("Location: todolist.php");
    } else {
      header("Location: todolist.php?mess=error");
    }
    $conn = null;
    exit();
  }
} else {
  header("Location: todolist.php?mess=error");
}
?>
