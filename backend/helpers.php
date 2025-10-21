<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Helper function to send JSON response
function response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
// Helper function to validate request data
function validateRequest() {
    $data = json_decode(file_get_contents('php://input'), true);

    return is_array($data) ? $data : [];
}
//filter input to prevent SQL injection
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

//image treatment for product. // need a correction
function handleProductImageUpload($file) {
    $file = sanitizeInput($file);
    //verify if file error == 0
    if ($file['error'] !== 0) {
        response(['error' => 'image upload error'], 400);
    }
    $name = $file['name'];
    $tmpName = $file['tmp_name'];
    $size = $file['size'];
    $maxSize = 3 * 1024 * 1024; // 3MB
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        response(['error' => 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.'], 400);
    }
    if ($size > $maxSize) {
        response(['error' => 'Image size exceeds the maximum limit of 3MB.'], 400);
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!in_array($mimeType, $allowedMimeTypes)) {
        response(['error' => 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.'], 400);
    }
    $newFileName = uniqid('prod_', true) . '.' . $extension;
    $destination = '../image/products/' . $newFileName;

    if (!move_uploaded_file($tmpName, $destination)) {
        response(['error' => 'Failed to move uploaded file.'], 500);
    }

    return $newFileName;
}


// create idTransactions
function idTrs(){

    return 'TRS' . strtoupper(uniqid());
}
// create agent code AGT-XXXX
function agentCode(){

    return 'AGT'. random_int(1000, 9999);
}
//create id user
function idUser(){

    return 'USR' . strtoupper(uniqid('', true));
}
// create commande id 2 first userName 
function orderCode(){

    return 'ORD' . random_int(100000, 999999);  
}

//2th phase
//sent notifications order for all available agents
function notifyAvailableAgents($orderId, $orderDetails) {
    $availableAgents = getAvailableAgents();
    foreach ($availableAgents as $agent) {
        $message = "New order #$orderId: $orderDetails please confirm.";
        createNotification($agent['id'], $message, 'order');
    }
}

/**
 * Wrapper pour envoyer un email OTP
 * @param string $email Email déjà validé
 */
function sendOtp($email) {
    // email.php fait déjà toute la logique
    include 'email.php';
}
//create refresh token,
$ACCESS_SECRET = 'une_cle_que_seul_vous_connaissez';
$REFRESH_SECRET = 'une_autre_cle_que_seul_vous_connaissez';
function createRefreshToken($userId) {
    global $REFRESH_SECRET;
    // Création du payload pour le refresh token
    $refreshPayload = [
        'iat' => time(),
        'exp' => time() + 1209600, // Expiration dans 2 semaines
        'sub' => $userId,
        'role' => 'user'
    ];

    return JWT::encode($refreshPayload, $REFRESH_SECRET, 'HS256');
}
//set cookies HttpOnly pour le refresh token
function setRefreshTokenCookie($refreshToken) {
    setcookie('refresh_token', $refreshToken, [
        'expires' => time() + 1209600, // 2 semaines
        'path' => '/', // Accessible sur tout le site
        'domain' => $_SERVER['HTTP_HOST'], // Domaine actuel
        'secure' => false, // En production avec HTTPS
        'httponly' => true, // Pas accessible via JS
        'samesite' => 'Strict' // Politique de SameSite
    ]);
}

//create access token
function createAccessToken($username, $user_id) {
    global $ACCESS_SECRET;
    // Création du payload pour le access token
    $accessPayload = [
        'iat' => time(), // Heure d'émission
        'exp' => time() + 300, // Expiration dans 5 minutes
        'username' => $username, // Informations utilisateur
        'role' => 'user', // Rôle utilisateur (exemple)
        'sub' => $user_id
    ];
    return JWT::encode($accessPayload, $ACCESS_SECRET, 'HS256');
}
// for orders
// get total price from product list with the order_id
function getTotalPrice($order_id) {
    // sanitize order_id
    $order_id = sanitizeInput($order_id);
    global $connection;
    $stmt = $connection->prepare("SELECT COUNT(price * qnt) as total_price FROM orders WHERE order_id = :order");
    $stmt->bindParam(':order', $order_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($result) && $result['total_price'] !== null) {
        return $result['total_price'];
    }
    return 0;
}
