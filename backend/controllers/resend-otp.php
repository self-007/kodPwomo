<?php


function resendOtp() {
    global $connection;
    try {
        $data = validateRequest();

        if (!isset($data['email'])) {
            response(['error' => 'Email requis'], 400);
            return;
        }
        
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        
        if (!$email) {
            response(['error' => 'Email invalide'], 400);
            return;
        }
        
        // TODO: Implémenter la logique de renvoi OTP
        // - Vérifier que l'email existe en base de données
            $stmt = 'SELECT * FROM users WHERE email = ?';
            $stmt = $connection->prepare($stmt);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() === 0) {
                response(['error' => 'Utilisateur non trouvé'], 404);
                return;
            }
        // - Générer un nouveau code OTP
        $newOtp = rand(100000, 999999);
        $otpExp = time() + 300; // 5 minutes expiration

        // - Sauvegarder en base de données avec expiration
        $stmt = $connection->prepare("UPDATE users SET otp = ?, otpExp = ? WHERE email = ?");
        $stmt->execute([$newOtp, $otpExp, $email]);
        // - Envoyer le code par email
        sendOtp($email); // Envoi OTP
        response([
            'success' => true,
            'message' => 'Nouveau code OTP envoyé à ' 
        ], 200);
     
    } catch (Exception $e) {
        response(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
    }
}