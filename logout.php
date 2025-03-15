<?php
session_start();  // Commencer ou récupérer la session existante
session_unset();  // Supprimer toutes les variables de session
session_destroy();  // Détruire la session

// Si tu utilises un cookie pour l'authentification, tu peux le supprimer aussi
setcookie("user_session", "", time() - 3600, "/");  // Supprimer le cookie

// Rediriger l'utilisateur vers la page de connexion après la déconnexion
header("Location: login.php");  // Rediriger vers la page de connexion
exit();
?>
