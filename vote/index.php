<?php

$uri = $_SERVER["REQUEST_URI"];
$path = parse_url($uri, PHP_URL_PATH);
$path = ltrim($path, '/');
$segments = explode("/", $path);
$page = $segments[0];

switch ($page) {
    case '':
        include './pages/home.php';
        break;
    case 'register-candidat':
        include './pages/candidat-register.php';
        break;
    case 'login-candidat':
        include './pages/candidat-login.php';
        break;
    case 'register-user':
        include './pages/register-user.php';
        break;
    case 'login-user':
        include './pages/login-user.php';
        break;
    case 'user-home':
        include './pages/user-home.php'; // Page tableau de bord pour les utilisateurs
        break;
    case 'candidate-home':
        include './pages/candidate-home.php'; // Page tableau de bord pour les candidats
        break;
    case 'results':
        include './pages/results.php'; // Page des résultats des votes
        break;
    default:
        include './pages/404.php';
        break;
}
?>
