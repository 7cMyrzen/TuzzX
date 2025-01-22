<?php
// Activer les erreurs pour le développement
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclure le routeur
require_once 'app/core/Router.php';

// Lancer le routeur
$router = new Router();
$router->handleRequest();
