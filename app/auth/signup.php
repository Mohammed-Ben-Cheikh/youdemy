<?php
require_once __DIR__ . '/../helper/function.php';
require_once __DIR__ . '/../Classes/classdao/Crud.php';
require_once __DIR__ . '/../Classes/User.php';
require_once __DIR__ . '/../Classes/SupAdmin.php';
require_once __DIR__ . '/../Classes/Cours.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $adresse = $_POST['adresse'];
    $id_role_fk = $_POST['id_role']  ;

    if ($password !== $confirm_password) {
        $error = 'Les mots de passe ne correspondent pas';
    } else if (Crud::getBy('users', 'email', $email) || Crud::getBy('sup_admins', 'email', $email) || Crud::getBy('admins', 'email', $email)) {
        $error = 'Cet email est déjà utilisé';
    } else if (Crud::getBy('users', 'username', $username) || Crud::getBy('sup_admins', 'email', $email) || Crud::getBy('admins', 'username', $username)) {
        $error = 'Cet username est déjà utilisé';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($id_role_fk == 1) {
            $person = new SupAdmin(
                $nom,
                $prenom,
                $username,
                $email,
                $telephone,
                $hashed_password,
                $adresse,
                $id_role_fk,
                'inactive'
            );

            $data = $person->getAttributes(['nom', 'username', 'prenom', 'email', 'telephone', 'mot_de_passe', 'adresse', 'id_role_fk']);

            if (Crud::insertData('sup_admins', $data)) {
                Helper::goToPage('/app/auth/login.php');
                exit();
            }
        } else if ($id_role_fk == 3) {
            $person = new User(
                $nom,
                $prenom,
                $username,
                $email,
                $telephone,
                $hashed_password,
                $adresse,
                $id_role_fk,
                'active'
            );
            $data = $person->getAttributes(['nom', 'username', 'prenom', 'email', 'telephone', 'mot_de_passe', 'adresse', 'id_role_fk', 'statut']);

            if (Crud::insertData('users', $data)) {
                Helper::goToPage('/app/auth/login.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive-Loc - Inscription</title>
    <script src="http://localhost/youdemy/app/js/tailwindcss.js"></script>
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

<body class="bg-[url('../public/img/herocar.jpg')] bg-cover bg-center bg-fixed min-h-screen">
    <div class="flex min-h-screen">
        <!-- Zone gauche avec contenu -->
        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-r from-black/80 to-transparent p-8 flex-col justify-center items-start">
            <div class="max-w-lg fade-in-left">
                <h1 class="text-5xl font-bold text-white mb-6">Bienvenue chez YouDemy</h1>
                <p class="text-xl text-white/90 mb-4">Découvrez notre sélection exclusive de Cours pour une
                    expérience de Formation incomparable.</p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-white">Large gamme de cours premium</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-white">Service client 24/7</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-white">Réservation facile et rapide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone droite (formulaire) -->
        <div class="w-full md:w-1/2 bg-gradient-to-t from-blue-500/30 to-black/80 border-l border-white/20">
            <div class="h-screen p-8 flex flex-col">
                <!-- Header -->
                <div class="flex-none">
                    <h2 class="text-center text-3xl font-bold text-white mb-4">Créer un compte</h2>
                    <?php if ($error): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Scrollable Form -->
                <div class="flex-grow overflow-y-auto custom-scrollbar pr-4">
                    <form method="POST" id="signupForm" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white">Nom :</label>
                                <input type="text" name="nom" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white">Prénom :</label>
                                <input type="text" name="prenom" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Nom d'utilisateur :</label>
                            <input type="text" name="username" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Email :</label>
                            <input type="email" name="email" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Téléphone :</label>
                            <input type="tel" name="telephone" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Adresse :</label>
                            <input type="text" name="adresse" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white">Role :</label>
                            <select type="text" name="id_role" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="3">Étudiant</option>
                                <option value="2">Enseignant</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white">Mot de passe :</label>
                                <input type="password" name="password" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white">Confirmer le mot de passe :</label>
                                <input type="password" name="confirm_password" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="flex-none pt-4 mt-4 border-t border-white/20">
                    <button type="submit" form="signupForm"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                        S'inscrire
                    </button>
                    <p class="mt-4 text-center text-sm text-white">
                        Déjà inscrit ?
                        <a href="login.php"
                            class="font-medium text-indigo-400 hover:text-indigo-300 transition duration-150">Se
                            connecter</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>