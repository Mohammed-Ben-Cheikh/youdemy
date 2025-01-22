<?php
session_start();
require_once '../../../controller/vehicules.php';

// Vérification de l'ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID du continent manquant";
    header('Location: ../../../Dashboard');
    exit();
}
$id = $_GET['id'];
try {
    if (Vehicule::delete($id)) {
        require_once '../../../controller/statistiquesManager.php';
        StatistiquesManager::calculerEtMettreAJour();
        $_SESSION['success'] = "Continent supprimé avec succès";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression du continent";
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Erreur : " . $e->getMessage();
}
header('Location: ../../../../Dashboard/page/vehicules.php');
exit();