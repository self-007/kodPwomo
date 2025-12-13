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
        $accessToken = createAccessToken($username, $userid, $role = 'user', $fingerprint);
        //create refresh token
        $refreshToken = createRefreshToken($userid);
        $stmt = $connection->prepare("INSERT INTO users (name, email, firstname, id_unique, refresh_token, access_token, is_verified) VALUES (:username, :email, :firstname, :id_unique, :refresh_token, :access_token, 1)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $useremail);
        $stmt->bindParam(':firstname', $userfirstname);
        $stmt->bindParam(':id_unique', $userid);
        $stmt->bindParam(':refresh_token', $refreshToken);
        $stmt->bindParam(':access_token', $accessToken);
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

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO users (name, password, email, firstname, id_unique,  is_verified) VALUES (:username, :password, :email, :firstname, :id_unique, 0)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $useremail);
    $stmt->bindParam(':firstname', $userfirstname);
    $stmt->bindParam(':id_unique', $userid);
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
    if(!isset($data['type']) || !isset($data['fingerPrint']) || $data['fingerPrint'] === '') {
        response(['error' => 'bad request'.$data], 400);
    }
    $fingerprint = sanitizeInput($data['fingerPrint']);
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

            //get the user id and the user name, and the user role
            $userId = $user['id_unique'];
            $role = isset($user['role']) ? $user['role'] : 'user';
            $username = $user['name'];
            // set refresh token into coockies and set access token into response to trhe client
            $refreshToken = createRefreshToken($userId, $role);
            //update refresh token to database
            $stmt = $connection->prepare("UPDATE users SET refresh_token = :refresh_token WHERE id_unique = :id_unique");
            $stmt->bindParam(':refresh_token', $refreshToken);
            $stmt->bindParam(':id_unique', $userId);
            $stmt->execute();
            $accessToken = createAccessToken($username,$userId, $role, $fingerprint);
            setRefreshTokenCookie($refreshToken);
            response(['status' => 'success', 'accessToken' => $accessToken, 'message' => 'Bon retour a vous ' . $user['name'] . ' sur kodPwomo'], 200);
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
    //verify if user exist 
    if($stmt->rowCount() === 0) {
        response(['error' => 'Utilisateur non trouvé'], 404);
    }
    //verify if password is empty
    if (empty($user['password'])) {
        response(['error' => 'votre methode de connexion est google, veuillez vous connecter avec votre compte Google'], 400);
    }
    if (password_verify($password, $user['password'])) {
        //get the user id and the user name, and the user role
        $userId = $user['id_unique'];
        $role = isset($user['role']) ? $user['role'] : 'user';
        $username = $user['name'];
        $refreshToken = createRefreshToken($userId, $role);
        // create access token
        $accessToken = createAccessToken($username, $userId, $role, $fingerprint);
        //update refresh token to database
        $stmt = $connection->prepare("UPDATE users SET refresh_token = :refresh_token, access_token = :access_token WHERE id_unique = :id_unique");
        $stmt->bindParam(':refresh_token', $refreshToken);
        $stmt->bindParam(':access_token', $accessToken);
        $stmt->bindParam(':id_unique', $userId);
        $stmt->execute();
        
        //send refresh into cookies, and send access token to server
        setRefreshTokenCookie($refreshToken);
        response(['status' => 'success', 'accessToken' => $accessToken, 'message' => 'Bon retour a vous ' . $user['name'] . ' sur kodPwomo'], 200);
            
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
    global $connection;
    //get the userId
    $accessToken = getBearerToken();
    $id_unique = $accessToken->sub;
    function setNewPassword($newPass, $id_unique){
        global $connection;
        $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);
        //update the password
        $stmt = $connection->prepare("UPDATE users SET password = :password WHERE id_unique = :id_unique");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id_unique', $id_unique);
        if($stmt->execute()){
            response(['status' => 'success', 'message' => 'Mot de passe mis à jour avec succès'], 200);
        } else {
            response(['error' => 'Échec de la mise à jour du mot de passe'], 500);
        }
    }
    if(!isset($datas['type'])){
        response(['error' => 'bad request'], 404);
    }
    if($datas['type'] == 'security'){
        if(!isset($datas['current_password']) || !isset($datas['new_password'])){
            response(['error' => 'il vous manques des donnes'], 404);
        }
        
        $oldPass = sanitizeInput($datas['current_password']);
        $newPass = sanitizeInput($datas['new_password']);
        //get the user password
        $stmt = $connection->prepare("SELECT password FROM users WHERE id_unique = :id_unique");
        $stmt->bindParam(':id_unique', $id_unique);
        $stmt->execute();
        $result = $stmt->rowCount();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result === 0){
            response(['error' => 'Utilisateur non trouvé'], 404);
        }
        //get the password
        $currentPassword = $user['password'];
        //verify old password
        if(empty($datas['current_password']) && !empty($currentPassword) ){
            response(['error' => 'Veuillez entrer votre mot de passe actuel'], 400);
        } else if(empty($datas['current_password']) && empty($currentPassword) ){
            setNewPassword($newPass, $id_unique);
        }
        else if(!password_verify($oldPass, $currentPassword)){
            response(['error' => 'Mot de passe actuel incorrect'], 401);
        }
        //hash the new password
        setNewPassword($newPass, $id_unique);
    }
    if(!isset($datas['university_id']) || !isset($datas['name']) || !isset($datas['firstname']) || !isset($datas['phone'])){
        response(['error' => 'Invalid user data'], 400);
    }
    $university_id = intval($datas['university_id']);
    $name = sanitizeInput($datas['name']);
    $firstname = sanitizeInput($datas['firstname']);
    $phone = sanitizeInput($datas['phone']);
    // verify int value or superior to 0
    if (intval($university_id) <= 0) {
        response(['error' => 'Invalid university name'], 400);
    }
    // Validate input
    if (empty($name) || empty($phone) || empty($firstname)) {
        response(['error' => 'Name, firstname and phone are required'], 400);
    }         
    //get the userId
    $stmt = $connection->prepare("UPDATE users SET name = :name, firstname = :firstname, phone = :phone, id_university = :university_id WHERE id_unique = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':university_id', $university_id);
    $stmt->bindParam(':id', $id_unique);
    if ($stmt->execute()) {
        response(['message' => 'User updated successfully', 'status' => 'success'], 200);
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
function setUserAgent(){
    global $datas;
    if(!isset($datas['id']) || !isset($datas['role'])){
        response(['error' => 'Invalid user ID or role'], 400);
    }
    $id = sanitizeInput($datas['id']);
    $role = sanitizeInput($datas['role']);
    global $connection;
    if(empty($id)){
        response(['error' => 'invalid id'], 400);  
    }
    $id = sanitizeInput($id);
    $stmt = $connection->prepare('UPDATE users SET role =:role WHERE id_unique =:id');
    $stmt->execute(['role' => $role, 'id' => $id]);
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
//heartbeat 
function heartbeat(){
    global $datas;
    if(!isset($datas['fingerprint'])){
        response(['error' => 'Fingerprint is required'], 400);
    }
    $fingerprint = sanitizeInput($datas['fingerprint']);
    if(empty($fingerprint)){
        response(['error' => ' Fingerprint is required'], 400);
    }
    //get refresh token
    $refresh = getRefreshToken(); 
    $refreshToken = $refresh['refreshToken'];
    $refreshPlayload = $refresh['refreshPlayload'];
    //verify refresh token to database
    $stmt = 'SELECT id, name FROM users WHERE refresh_token = ?';
    global $connection;
    $stmt = $connection->prepare($stmt);
    $stmt->execute([$refreshToken]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() === 0) {
        response(['error' => 'Invalid refresh token'.$refreshToken], 401);
    }

    //get access token
    $access = getBearerToken();
    if(empty($access)){
        response(['error' => 'Access token is required'], 401);
    }
    // get acess fingerprint
    $realFingerprint = $access->fingerPrint;
    // compare access fingerprint to current fingerprint
    if($realFingerprint !== $fingerprint){
     
        response(['error' => 'Invalid fingerprint', 'fingerprint' => $fingerprint, 'realFingerprint' => $realFingerprint], 403);
    }
    try {
         // get exp date 
        $accessExp = $access->exp;
        //verify il exp <  2mn
        if($accessExp > time() + 150) {
            response(['message' => 'Access token is still valid', 'status' => 'ok'], 200);
        }
        // create new access token
    
        global $ACCESS_SECRET;
        $user_id = $refreshPlayload->sub;
        $username = $user['name'];
        $role = $refreshPlayload->role;
        //createAccessToken($username, $user_id, $role, $fingerprint);
        $newAccessToken = createAccessToken($username, $user_id, $role, $fingerprint);
        response(['access_token' => $newAccessToken, 'status' => 'success'], 200);
    } catch (\Firebase\JWT\ExpiredException $e){
        response(['error' => 'Unauthorized A2'], 401);
    } catch(Exeption $e){
        response(['error' => 'Unauthorized A3'], 401);
    }
   
       
    
    

}
//get user personnel datas 
function getUserDatas(){
    $accessToken = getBearerToken();
    $id_unique = $accessToken->sub; 
    global $connection;
    if(empty($id_unique)){
        response(['error' => 'invalid id'], 400);  
    }
    $id_unique = sanitizeInput($id_unique);
    $stmt = $connection->prepare('SELECT u.name, u.email, u.firstname, u.phone,
     un.name as university_name FROM users u JOIN university un ON u.id_university = un.id 
     WHERE id_unique =:id_unique');
    $stmt->bindParam(':id_unique', $id_unique);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() === 0) {
        response(['error' => 'Utilisateur non trouvé'], 404);
    }
    response(['status' => 'success', 'user' => $user], 200);
}

//ask for support from adms
function askForSupport(){
    global $datas;
    if(!isset($datas['subject']) || !isset($datas['category']) || !isset($datas['message']) || !isset($datas['university_id'])){
        response(['error' => 'Invalid support data'], 400);
    }
    $subject = sanitizeInput($datas['subject']);
    $category = sanitizeInput($datas['category']);
    $message = sanitizeInput($datas['message']);
    $university_id = intval($datas['university_id']);
    // verify int value or superior to 0
    if ($university_id <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    // Validate input
    if (empty($subject) || empty($category) || empty($message) || empty($datas['university_id'])) {
        response(['error' => 'All fields are required'], 400);
    }         
    //get the userId
    $accessToken = getBearerToken();
    $id_unique = $accessToken->sub;
    global $connection;
    $stmt = $connection->prepare("INSERT INTO support (idUser, subject, category, message, university_id) VALUES (:user_id, :subject, :category, :message, :university_id)");
    $stmt->bindParam(':user_id', $id_unique);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':university_id', $university_id);
    if ($stmt->execute()) {
        response(['message' => 'Support request submitted successfully', 'status' => 'success'], 200);
    } else {
        response(['error' => 'Failed to submit support request'], 500);
    }
}
