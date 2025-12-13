<?php
// Service de déconnexion - backend/services/logout.php
//logout fuction
function logout() {
    // Supprimer le cookie de refresh token
    //get access token from headers
    $accessToken = getBearerToken();
    $id_unique = $accessToken->sub;
    $access = $accessToken->access;
    //
    setcookie('refresh_token', '', time() - 3600, '/', '', false, true);
    //delete access and refresh tokens from database
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET access_token = NULL, refresh_token = NULL WHERE id_unique = :id_unique");
    $stmt->bindParam(':id_unique', $id_unique);
    $stmt->execute();
    //blacklist the access token
    blacklistToken($access, $id_unique);

}