<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Helper function to create user
$data = function_exists('validateRequest') ?  validateRequest() : [];
function createUser() {
    global $connection;
    global $data;
    //get the type 
    if(!isset($data['type'])) {
        response(['error' => 'bad request'.$data], 400);
    }
    // verify mode in order to call a function or not
    if(isset($data['mode']) && $data['mode'] === 'login') {
        authenticateUser();
        return;
    }
    $type = sanitizeInput($data['type']);
    if($type === 'google'){
        // create user without password
        if (empty($data['username']) || empty($data['email']) || empty($data['firstname']) || empty($data['id_unique']) || empty($data['fingerPrint'])) {
            response(['error' => 'données incomplètes'], 400);
        }
        $username = sanitizeInput($data['username']);
        $useremail = sanitizeInput($data['email']);
        $userfirstname = sanitizeInput($data['firstname']);
        $userid = sanitizeInput($data['id_unique']);
        $fingerprint = sanitizeInput($data['fingerPrint']);
        
         // Validate email format
        if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            response(['error' => 'Invalid email format'], 400);
        }
        //verify if user exists
        
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $useremail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            response(['error' => 'Cet utilisateur existe déjà'], 409);
        }
        //create access token
        $accessToken = createAccessToken($username, $userid);
        //create refresh token
        $refreshToken = createRefreshToken($userid);
        $stmt = $connection->prepare("INSERT INTO users (name, email, firstname, id_unique, refresh_token, finger_print, is_verified) VALUES (:username, :email, :firstname, :id_unique, :refresh_token, :fingerprint, 1)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $useremail);
        $stmt->bindParam(':firstname', $userfirstname);
        $stmt->bindParam(':id_unique', $userid);
        $stmt->bindParam(':refresh_token', $refreshToken);
        $stmt->bindParam(':fingerprint', $fingerprint);
        if ($stmt->execute()) {
            response(['status' => 'success', 'message' => 'Bienvenue a vous ' . $username . ' sur kodPwomo'], 201);
        } else {
            response(['error' => 'Failed to create user'], 500);
        }
    }
    // Validate input
    if (empty($data['username']) || empty($data['password']) || empty($data['email']) || empty($data['firstname']) || empty($data['type']) || empty($data['fingerPrint'])) {
        response(['error' => 'données incomplètes'], 400);
    }
    $username = sanitizeInput($data['username']);
    $password = sanitizeInput($data['password']);
    $useremail = sanitizeInput($data['email']);
    $userfirstname = sanitizeInput($data['firstname']);
    $fingerprint = sanitizeInput($data['fingerPrint']);
    
     // Validate email format
    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        response(['error' => 'Invalid email format'], 400);
    }
    //verify if email exist
    
    $stmt = 'SELECT * FROM users WHERE email = ?';
    $stmt = $connection->prepare($stmt);
    $stmt->execute([$useremail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        response(['error' => 'Cet utilisateur existe déjà'], 409);
    } 
    //create userId
    $userid = idUser();       
    //create access token
    $accessToken = createAccessToken($username, $userid);
    //create refresh token
    $refreshToken = createRefreshToken($userid);


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO users (name, password, email, firstname, id_unique, refresh_token, is_verified) VALUES (:username, :password, :email, :firstname, :id_unique, :refresh_token, 0)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $useremail);
    $stmt->bindParam(':firstname', $userfirstname);
    $stmt->bindParam(':id_unique', $userid);
    $stmt->bindParam(':refresh_token', $refreshToken);
    if ($stmt->execute()) {
        sendOtp($useremail); // Envoi OTP
        response(['status' => 'success', 'otp' => 'confim'], 200);
    } else {
        response(['error' => 'Failed to create user'], 500);
    }
}
// Helper function to authenticate user
function authenticateUser() {

    global $data;
    global $connection;
    //get data type
    if(!isset($data['type'])) {
        response(['error' => 'bad request'.$data], 400);
    }
    //verify type
    if($data['type'] === 'google'){
        //verify if data exist
        if (empty($data['email']) || empty($data['id_unique'])) {
            response(['error' => 'Données manquantes'], 400);
        }
        $email = sanitizeInput($data['email']);
        $id_unique = sanitizeInput($data['id_unique']);
        //verify email
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email AND id_unique = :id_unique");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_unique', $id_unique);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            response(['status' => 'success', 'message' => 'Connexion réussie'], 200);
        } else {
            response(['error' => 'Utilisateur non trouvé'], 404);
        }
    }
    // verify if data exist
    if (empty($data['email']) || empty($data['password'])) {
        response(['error' => 'Données manquantes'], 400);
    }
    $email = sanitizeInput($data['email']);
    $password = sanitizeInput($data['password']);
    //verify email
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //verify if password is empty
    if (empty($user['password'])) {
        response(['error' => 'votre methode de connexion est google, veuillez vous connecter avec votre compte Google'], 400);
    }
    if ($user && password_verify($password, $user['password'])) {
        response(['status' => 'success', 'message' => 'Bon retour a vous ' . $user['name'] . ' sur kodPwomo'], 200);
            
    } else {
        response(['error' => 'email ou mot de passe incorrect'], 401);
    }
}
// get all users
function getAllUsers() {
    global $connection;
    $stmt = $connection->prepare("SELECT id, name FROM users");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return [];
    }
    //$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['total' => $nbrs ];
}
// get user by id
function getUserById($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid user ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT id, username FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// update user
function updateUser() {
    global $datas;
    if(!isset($datas['id']) || !isset($datas['username']) || !isset($datas['password'])){
        response(['error' => 'Invalid user ID, username or password'], 400);
    }
    $id = intval($datas['id']);
    $username = sanitizeInput($datas['username']);
    $password = sanitizeInput($datas['password']);
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid user ID'], 400);
    }
    // Validate input
    if (empty($username) || empty($password)) {
        response(['error' => 'Username and password are required'], 400);
    }        
    $username = sanitizeInput($username);
    $password = sanitizeInput($password);
    global $connection;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return getUserById($id);
    } else {
        response(['error' => 'Failed to update user'], 500);
    }
}

//update user status
function updateUserStatus() {
    global $datas;
    if(!isset($datas['id']) || !isset($datas['status'])){
        response(['error' => 'Invalid user ID or status'], 400);
    }
    //id is alpha num value
    $id = sanitizeInput($datas['id']);
    $status = sanitizeInput($datas['status']);
    // verify int value or superior to 0
    if (empty($id)) {
        response(['error' => 'Invalid user ID'], 400);
    }
    $status = $status !== 'active' ? 'inactive' : 'active';
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET status = :status WHERE id_unique = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'User status updated successfully']);
    } else {
        response(['error' => 'Failed to update user status'], 500);
    }
}

//set verified or unverified user
function setUserVerifiedStatus() {
    global $datas;
    if(!isset($datas['id']) || !isset($datas['isVerified'])){
        response(['error' => 'Invalid user ID or verified status'], 400);
    }
    $id = intval($datas['id']);
    $isVerified = intval($datas['isVerified']);
    //set isverified to 0 or 1
    $isVerified = $isVerified ? 1 : 0;
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid user ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET is_verified = :is_verified WHERE id = :id");
    $stmt->bindParam(':is_verified', $isVerified);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'User verified status updated successfully']);
    } else {
        response(['error' => 'Failed to update user verified status'], 500);
    }
}

//set user ADM
function setUserAdm($id){
    global $connection;
    if(empty($id)){
        response(['error' => 'invalid id'], 400);  
    }
    $id = sanitizeInput($id);
    $stmt = $connection->prepare('UPDATE users SET role =:role WHERE id_unique =:id');
    $stmt->execute(['role' => 'adm', 'id' => $id]);
    response(['status' => 'success'], 200);
}

//set user Agent
function setUserAgent($id){
    global $connection;
    if(empty($id)){
        response(['error' => 'invalid id'], 400);  
    }
    $id = sanitizeInput($id);
    $stmt = $connection->prepare('UPDATE users SET role =: role WHERE id_unique =:id');
   $stmt->execute(['role' => 'agent', 'id' => $id]);
    response(['status' => 'success'], 200);
}

//set user client
function setUserClient($id){
    global $connection;
    if(empty($id)){
        response(['error' => 'invalid id'], 400);  
    }
    $id = sanitizeInput($id);
    $stmt = $connection->prepare('UPDATE users SET role = :role WHERE id_unique =:id');
    $stmt->execute(['role' => 'client', 'id' => $id]);
    response(['status' => 'success'], 200);
}