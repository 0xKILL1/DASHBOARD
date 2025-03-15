<?php
session_start();

// Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header('Location: accueil.html');
    exit();
}

// Identifiants de connexion (à adapter selon ta base de données)
$valid_username = 'user';  // Nom d'utilisateur valide
$valid_password = 'password';  // Mot de passe valide

// Gestion de la déconnexion
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Détruire la session et rediriger vers la page de login
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// Vérification du formulaire de connexion
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des informations soumises
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants
    if ($username === $valid_username && $password === $valid_password) {
        // Connexion réussie
        $_SESSION['loggedIn'] = true;
        header('Location: accueil.html');  // Rediriger vers la page d'accueil après connexion
        exit();
    } else {
        // Connexion échouée, afficher un message d'erreur
        $error_message = 'Identifiants incorrects. Veuillez réessayer.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .login-form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Page de Connexion</h1>

<!-- Affichage d'un message d'erreur si la connexion échoue -->
<?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

<!-- Formulaire de connexion -->
<form id="loginForm" action="login.php" method="POST" class="login-form">
    <input type="text" id="username" name="username" class="input-field" placeholder="Nom d'utilisateur" required />
    <input type="password" id="password" name="password" class="input-field" placeholder="Mot de passe" required />
    <button type="submit" class="submit-btn">Se connecter</button>
</form>

<!-- Lien pour la déconnexion si l'utilisateur est déjà connecté -->
<?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
    <div class="error-message">
        Vous êtes déjà connecté. <a href="login.php?action=logout">Se déconnecter</a>
    </div>
<?php endif; ?>

</body>
</html>
