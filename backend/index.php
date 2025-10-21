<?php
// point d'entree de l'API
// 1. D'abord charger les autoloaders
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor-firebase/autoload.php';

// 2. Puis les classes
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// 3. Ensuite les fichiers qui utilisent ces classes
require_once __DIR__ . '/helpers.php';
require_once ('db.php');


// CORS basique (ajuste pour prod)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once 'routes.php';



