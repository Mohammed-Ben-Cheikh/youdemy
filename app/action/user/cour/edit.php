<?php
require_once '../../../controller/vehicules.php';
require_once '../../../controller/categories.php';

// Récupération des données du véhicule à éditer
$id = $_GET['id'] ?? null;

// Traitement du formulaire d'édition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_vehicule'];
    $nom = $_POST['nom'];
    $prix_a_loue = $_POST['prix_a_loue'];
    $description = $_POST['description'];
    $id_categorie_fk = $_POST['id_categorie_fk'];
    $matriculation = $_POST['matriculation'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $climatisation = $_POST['climatisation'];
    $type_vitesse = $_POST['type_vitesse'];
    $nb_vitesses = $_POST['nb_vitesses'];
    $toit_panoramique = $_POST['toit_panoramique'];
    $kilometrage = $_POST['kilometrage'];
    $carburant = $_POST['carburant'];
    $nombre_de_places = $_POST['nombre_de_places'];
    $nombre_de_portes = $_POST['nombre_de_portes'];
    $disponibilite = $_POST['disponibilite'];
    $image_url = $_POST['image_url'];

    $vehicule = new Vehicule(
        $id,
        $nom,
        $prix_a_loue,
        $description,
        $id_categorie_fk,
        $matriculation,
        $marque,
        $modele,
        $annee,
        $climatisation,
        $type_vitesse,
        $nb_vitesses,
        $toit_panoramique,
        $kilometrage,
        $carburant,
        $nombre_de_places,
        $nombre_de_portes,
        $disponibilite,
        $image_url
    );

    if ($vehicule->update($id)) {
        header('Location: ../../../../Dashboard/page/vehicules.php');
        exit();
    }
}

if ($id) {
    $vehiculeData = Vehicule::getById($id);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Véhicule - DriveLoc</title>
    <!-- <link rel="stylesheet" href="../../../../authentification/style.css"> -->
    <link rel="stylesheet" href="../../../../src/output.css">
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        .fade-in-left {
            animation: fadeInLeft 1s ease-out;
        }
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-[url('../app/img/herocar.jpg')] bg-cover bg-center bg-fixed min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Section with Content -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-r from-black/80 to-transparent p-8 flex-col justify-center items-start">
            <div class="max-w-lg fade-in-left">
                <h1 class="text-5xl font-bold text-white mb-6">Modifier un Véhicule</h1>
                <p class="text-xl text-white/90 mb-4">Mettez à jour les inCatégories nécessaires pour ce véhicule.</p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Véhicules de haute qualité</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Service client 24/7</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Réservation facile et rapide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section (Form) -->
        <div class="w-full md:w-1/2 bg-gradient-to-t from-blue-500/30 to-black/80 border-l border-white/20">
            <div class="h-screen p-8 flex flex-col">
                <!-- Header -->
                <div class="flex-none">
                    <h2 class="text-center text-3xl font-bold text-white mb-4">Modifier un Véhicule</h2>
                </div>

                <!-- Scrollable Form -->
                <div class="flex-grow overflow-y-auto custom-scrollbar pr-4">
                    <form  action="edit.php" method="POST" id="editVehicleForm" class="space-y-4">
                        <input type="hidden" name="id_vehicule" value="<?php echo $vehiculeData['id_vehicule']; ?>">

                        <div>
                            <label class="block text-sm font-medium text-white">Nom du Véhicule :</label>
                            <input type="text" name="nom" value="<?php echo htmlspecialchars($vehiculeData['nom']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Prix à Louer (€/jour) :</label>
                            <input type="number" step="0.01" name="prix_a_loue" value="<?php echo htmlspecialchars($vehiculeData['prix_a_loue']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Description :</label>
                            <textarea name="description" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><?php echo htmlspecialchars($vehiculeData['description']); ?></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Catégorie :</label>
                            <select name="id_categorie_fk" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <!-- Options should be dynamically generated from the database -->
                                <?php foreach (Categorie::getAll() as $categorie): ?>
                                <option value="<?php echo $categorie['id_categorie'] ?>" <?php echo $vehiculeData['id_categorie_fk'] == $categorie['id_categorie'] ? 'selected' : ''; ?>><?php echo $categorie['nom']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Matriculation :</label>
                            <input type="text" name="matriculation" value="<?php echo htmlspecialchars($vehiculeData['matriculation']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Marque :</label>
                            <input type="text" name="marque" value="<?php echo htmlspecialchars($vehiculeData['marque']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Modèle :</label>
                            <input type="text" name="modele" value="<?php echo htmlspecialchars($vehiculeData['modele']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Année :</label>
                            <input type="number" name="annee" value="<?php echo htmlspecialchars($vehiculeData['annee']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Climatisation :</label>
                            <select name="climatisation" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="oui" <?php echo $vehiculeData['climatisation'] == 'oui' ? 'selected' : ''; ?>>Oui</option>
                                <option value="non" <?php echo $vehiculeData['climatisation'] == 'non' ? 'selected' : ''; ?>>Non</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Type de Vitesse :</label>
                            <select name="type_vitesse" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Manuelle" <?php echo $vehiculeData['type_vitesse'] == 'Manuelle' ? 'selected' : ''; ?>>Manuelle</option>
                                <option value="Automatique" <?php echo $vehiculeData['type_vitesse'] == 'Automatique' ? 'selected' : ''; ?>>Automatique</option>
                                <option value="Semi-Automatique" <?php echo $vehiculeData['type_vitesse'] == 'Semi-Automatique' ? 'selected' : ''; ?>>Semi-Automatique</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Nombre de Vitesses :</label>
                            <select name="nb_vitesses" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="3" <?php echo $vehiculeData['nb_vitesses'] == '3' ? 'selected' : ''; ?>>3</option>
                                <option value="4" <?php echo $vehiculeData['nb_vitesses'] == '4' ? 'selected' : ''; ?>>4</option>
                                <option value="5" <?php echo $vehiculeData['nb_vitesses'] == '5' ? 'selected' : ''; ?>>5</option>
                                <option value="6" <?php echo $vehiculeData['nb_vitesses'] == '6' ? 'selected' : ''; ?>>6</option>
                                <option value="7" <?php echo $vehiculeData['nb_vitesses'] == '7' ? 'selected' : ''; ?>>7</option>
                                <option value="8" <?php echo $vehiculeData['nb_vitesses'] == '8' ? 'selected' : ''; ?>>8</option>
                                <option value="9" <?php echo $vehiculeData['nb_vitesses'] == '9' ? 'selected' : ''; ?>>9</option>
                                <option value="10" <?php echo $vehiculeData['nb_vitesses'] == '10' ? 'selected' : ''; ?>>10</option>
                                <option value="11" <?php echo $vehiculeData['nb_vitesses'] == '11' ? 'selected' : ''; ?>>11</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Toit Panoramique :</label>
                            <select name="toit_panoramique" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Non" <?php echo $vehiculeData['toit_panoramique'] == 'Non' ? 'selected' : ''; ?>>Non</option>
                                <option value="Fixe" <?php echo $vehiculeData['toit_panoramique'] == 'Fixe' ? 'selected' : ''; ?>>Fixe</option>
                                <option value="Ouvrant" <?php echo $vehiculeData['toit_panoramique'] == 'Ouvrant' ? 'selected' : ''; ?>>Ouvrant</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Kilométrage :</label>
                            <input type="number" step="0.01" name="kilometrage" value="<?php echo htmlspecialchars($vehiculeData['kilometrage']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Carburant :</label>
                            <select name="carburant" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Essence" <?php echo $vehiculeData['carburant'] == 'Essence' ? 'selected' : ''; ?>>Essence</option>
                                <option value="Diesel" <?php echo $vehiculeData['carburant'] == 'Diesel' ? 'selected' : ''; ?>>Diesel</option>
                                <option value="Électrique" <?php echo $vehiculeData['carburant'] == 'Électrique' ? 'selected' : ''; ?>>Électrique</option>
                                <option value="Hybride" <?php echo $vehiculeData['carburant'] == 'Hybride' ? 'selected' : ''; ?>>Hybride</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Nombre de Places :</label>
                            <input type="number" name="nombre_de_places" value="<?php echo htmlspecialchars($vehiculeData['nombre_de_places']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Nombre de Portes :</label>
                            <input type="number" name="nombre_de_portes" value="<?php echo htmlspecialchars($vehiculeData['nombre_de_portes']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Disponibilité :</label>
                            <select name="disponibilite" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Disponible" <?php echo $vehiculeData['disponibilite'] == 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                                <option value="Indisponible" <?php echo $vehiculeData['disponibilite'] == 'Indisponible' ? 'selected' : ''; ?>>Indisponible</option>
                                <option value="Réservé" <?php echo $vehiculeData['disponibilite'] == 'Réservé' ? 'selected' : ''; ?>>Réservé</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">URL de l'Image :</label>
                            <input type="text" name="image_url" value="<?php echo htmlspecialchars($vehiculeData['image_url']); ?>" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="flex-none pt-4 mt-4 border-t border-white/20">
                    <button type="submit" form="editVehicleForm"
                        class="w-full bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Mettre à jour le Véhicule
                    </button>
                    <a href="../../../../Dashboard/page/vehicules.php" 
                        class="mt-4 w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150">
                        Retour au Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>