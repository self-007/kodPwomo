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
    if(isset($_POST) && !empty($_POST)){
        $data = $_POST;
    }
    return is_array($data) ? $data : [];

}
$datas = validateRequest() ?? []; 
//filter input to prevent SQL injection
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

//image treatment for product. // need a correction
function handleProductImageUpload($file) {
    //$file = sanitizeInput($file);
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

// get order by order_id
function getOrderById($id) {
    // id is alpha num value
    $id = sanitizeInput($id);
    global $connection;
    $stmt = $connection->prepare("SELECT id_user, SUM(price * qnt) as total_price FROM orders WHERE order_id = :id GROUP BY order_id");
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    if ($stmt->rowCount() === 0) {
       return ['nbrs' => 0, 'order' => null];
    }
    $nbrs = $stmt->rowCount();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    $newId = $order['id_user'];
    $totalPrice = $order['total_price'];
    return ['nbrs' => $nbrs, 'order' => $order, 'id' => $newId, 'total_price' => $totalPrice];
}
// update order status
function updateOrderStatus($orderId, $status) {
    // verify parameters
    if (empty($orderId) || empty($status)) {
        response(['error' => 'ID de commande ou statut invalide'], 400);
    }
    //get the user id by token
    $user = getBearerToken();
    $id_unique = sanitizeInput($user->sub);
    $status = sanitizeInput($status);
    $orderId = sanitizeInput($orderId);
    global $connection;
    $stmt = $connection->prepare("UPDATE orders SET status = :status WHERE order_id = :id AND id_user = :id_user");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $orderId);
    $stmt->bindParam(':id_user', $id_unique);
    if ($stmt->execute()) {
        response(['message' => 'commande mise à jour avec succès', 'status' => 'success'], 200);
    } else {
        response(['error' => 'echec de la mise à jour du statut de la commande'], 500);
    }
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
function createRefreshToken($userId, $role) {
    global $REFRESH_SECRET;
    // Création du payload pour le refresh token
    $refreshPayload = [
        'iat' => time(),
        'exp' => time() + 1209600, // Expiration dans 2 semaines
        'sub' => $userId,
        'role' => $role,
        'jti' => bin2hex(random_bytes(32)) // ID unique du token
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
function createAccessToken($username, $user_id, $role, $fingerprint) {


    
    global $ACCESS_SECRET;
    // Création du payload pour le access token
    $accessPayload = [
        'iat' => time(), // Heure d'émission
        'exp' => time() + 300, // Expiration dans 5 minutes
        'username' => $username, // Informations utilisateur
        'role' => $role, // Rôle client/agent/ADM (exemple)
        'sub' => $user_id,
        'jti' => bin2hex(random_bytes(16)), // ID unique du token
        'fingerPrint' => $fingerprint // Empreinte digitale pour sécurité supplémentaire
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

//get access token from header
function getBearerToken() {
    global $ACCESS_SECRET, $connection;
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        response(['error' => 'Unauthorized A1 header'], 401);
    }
    $matches = [];
    $matches = explode(' ', $headers['Authorization']);
    if (count($matches) !== 2) {
        response(['error' => 'Unauthorized A2'], 401);
    }
    if($matches[0] !== 'Bearer'){
        response(['error' => 'Unauthorized A3'], 401);
    }
    $token = $matches[1];
    //decode token
   // var_dump($token);
   try {
        //verify if token is blacklisted
        $stmt = $connection->prepare("SELECT * FROM black_list WHERE access_token = :access_token AND id_user = :id_user");
        $stmt->bindParam(':access_token', $token);
        $stmt->bindParam(':id_user', $id_unique);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            response(['error' => 'Unauthorized B1'], 401);
        }
        $accessToken = JWT::decode($token, new Key($ACCESS_SECRET, 'HS256'));
        $accessToken->access = $token;
        return $accessToken;
   } catch (\Firebase\JWT\ExpiredException $e){
        response(['error' => 'expired', 'action' => 'out'], 401);
   } catch (Exception $e) {
        response(['error' => 'Unauthorized ', 'action' => 'out'], 401);
   }
}
//get the user role
function getUserRole() {
    global $ACCESS_SECRET;
    $headers = getallheaders();
    $matches = [];

    if(!isset($headers['Authorization'])){
        return 0;
    }
    $matches = explode(" ", $headers['Authorization']);
    if($matches[0] != 'Bearer'){
        return null;
    }
    $accessToken = $matches[1];
    try {
        $accessToken = JWT::decode($accessToken, new Key($ACCESS_SECRET, 'HS256'));
        return $accessToken;
    } catch (\Firebase\JWT\ExpiredException $e){
        return null;
    } catch (Exception $e) {
        return null;
    }
}
//global  variable role
$user_role = getUserRole()->role ?? 'vide';
//echo $role;
//get refreshToken
function getRefreshToken(){
    global $REFRESH_SECRET;
    if(!isset($_COOKIE['refresh_token'])){
        response(['error' => 'Unauthorized R1'], 401);
    }
    $refresh_Token = $_COOKIE['refresh_token'];
    try {
        $decodesRefresh = JWT::decode($refresh_Token, new Key($REFRESH_SECRET, 'HS256'));
        return [ 'refreshToken' => $refresh_Token, 'refreshPlayload' => $decodesRefresh];
    } catch (\Firebase\JWT\ExpiredException $e){
        response(['error' => 'Unauthorized j1'], 401);
    } catch(Exeption $e){
        response(['error' => 'Unauthorized E1'], 401);
    }

}
//blacklist token
function blacklistToken($accessToken, $id_unique) {
    global $connection;
    $stmt = $connection->prepare("INSERT INTO black_list (access_token, id_user) VALUES (:access_token, :id_unique)");
    $stmt->bindParam(':access_token', $accessToken);
    $stmt->bindParam(':id_unique', $id_unique);
    if($stmt->execute()){
        response(['status' => 'success'], 200);
    }
    // alert the adm about the issues
    $message = 'their is an issues with the blacklist function inside helpers page blacklistToken';
    $type = 'system alert';
    notificationsCenter($id_unique, $message, $type);
    response(['error' => 'Failed to blacklist token'], 500);
}

function notificationsCenter($id_unique, $message, $type){
    global $connection;
    //add to the database
    $stmt = $connection->prepare("INSERT INTO support (idUser, subject, category, message) VALUES (:id_user, 'system', :type, :message)");
    $stmt->bindParam(':id_user', $id_unique);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

}
    