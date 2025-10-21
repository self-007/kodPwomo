<?php


function verifyOtp() {
    global $connection;
    try {
        $data = validateRequest();
        
        if (!isset($data['email']) || !isset($data['otp'])) {
            response(['error' => 'Email et code OTP requis'], 400);
            return;
        }
        
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $otp = trim($data['otp']);
        
        if (!$email) {
            response(['error' => 'Email invalide'], 400);
            return;
        }
        
        if (strlen($otp) !== 6 || !ctype_digit($otp)) {
            response(['error' => 'Code OTP invalide'], 400);
            return;
        }
        
        // TODO: Implémenter la logique de vérification OTP
        // - Vérifier le code OTP en base de données
        $stmt = 'SELECT * FROM users WHERE email = ?';
        $stmt = $connection->prepare($stmt);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() === 0) {
            response(['error' => 'Utilisateur non trouvé'], 404);
            return;
        }

        // - Vérifier l'expiration du code
        if (intval($user['otp']) !== intval($otp)) {
            response(['error' => 'Code OTP incorrect'.$otp], 400);
            return;
        }
        // - verify otp isnt expired
        if($user['otpExp'] < time()) {
            response(['error' => 'Code OTP expiré'], 400);
            return;
        }

        // - Marquer l'utilisateur comme vérifié
        $stmt = $connection->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
        $stmt->execute([$email]);
        response([
            'status' => 'success',
            'message' => 'Code OTP vérifié avec succès'
        ], 200);

        
    } catch (Exception $e) {
        response(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
    }
}