<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($email)) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Email invalide");
    }

    // Générer OTP (6 chiffres)
    $otp = rand(100000, 999999);
    $exp = time() + 300; // OTP expire dans 5 minutes
    // ⚠ Ici tu peux enregistrer $otp en base de données lié à $email
    $stmt = 'UPDATE users SET otp = ?, otpExp =?  WHERE email = ?';
    global $connection;

    $stmt = $connection->prepare($stmt);
    $stmt->execute([$otp, $exp, $email]);

    // Envoi avec PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'voltairebilljamesky@gmail.com';
        $mail->Password   = 'vxvj yevq wgoy kmej'; // 16 caractères générés
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('voltairebilljamesky@gmail.com', 'KodPwomo');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = '� Votre code de vérification - kodPwomo';
        
        // Design HTML professionnel pour l'email
        $mail->Body = "
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Code de vérification kodPwomo</title>
        </head>
        <body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f7fc;'>
            <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);'>
                
                <!-- Header avec gradient e-commerce -->
                <div style='background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%); padding: 30px; text-align: center;'>
                    <h1 style='color: white; margin: 0; font-size: 28px; font-weight: bold;'>
                        📦 <strong>kodPwomo</strong>
                    </h1>
                    <p style='color: rgba(255,255,255,0.9); margin: 5px 0 0 0; font-size: 16px;'>
                        Plateforme de Livraison Étudiante
                    </p>
                </div>

                <!-- Contenu principal -->
                <div style='padding: 40px 30px;'>
                    <h2 style='color: #333; margin: 0 0 20px 0; font-size: 24px; text-align: center;'>
                        🔐 Code de connexion
                    </h2>
                    
                    <p style='color: #666; font-size: 16px; line-height: 1.6; margin: 0 0 30px 0; text-align: center;'>
                        Votre code de sécurité pour accéder à votre compte kodPwomo :
                    </p>

                    <!-- Code OTP stylisé -->
                    <div style='background: linear-gradient(135deg, #ff9ff3 0%, #ff6b9d 100%); padding: 20px; border-radius: 10px; text-align: center; margin: 0 0 30px 0;'>
                        <div style='background: white; padding: 20px; border-radius: 8px; display: inline-block;'>
                            <span style='font-size: 32px; font-weight: bold; color: #333; letter-spacing: 8px; font-family: Consolas, monospace;'>
                                $otp
                            </span>
                        </div>
                    </div>

                    <!-- Informations de sécurité -->
                    <div style='background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #28a745;'>
                        <h3 style='color: #28a745; margin: 0 0 10px 0; font-size: 18px;'>
                            ⏱️ Informations importantes
                        </h3>
                        <ul style='color: #666; margin: 0; padding-left: 20px; line-height: 1.6;'>
                            <li>Ce code expire dans <strong>5 minutes</strong></li>
                            <li>Utilisez-le uniquement sur la plateforme kodPwomo</li>
                            <li>Ne partagez jamais ce code avec personne</li>
                        </ul>
                    </div>

                    <!-- Bouton d'action -->
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='#' style='background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%); color: white; padding: 15px 30px; text-decoration: none; border-radius: 25px; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);'>
                            � Accéder à kodPwomo
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div style='background: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #eee;'>
                    <p style='color: #999; font-size: 14px; margin: 0 0 10px 0;'>
                        📧 Cet email a été envoyé automatiquement, ne pas répondre.
                    </p>
                    <p style='color: #999; font-size: 12px; margin: 0;'>
                        © 2025 kodPwomo - Plateforme de Livraison Étudiante<br>
                        � Universités de Kinshasa, République Démocratique du Congo
                    </p>
                </div>
            </div>

            <!-- Espace de sécurité -->
            <div style='text-align: center; padding: 20px;'>
                <p style='color: #999; font-size: 12px; margin: 0;'>
                    🔒 Email sécurisé par cryptage TLS/SSL
                </p>
            </div>
        </body>
        </html>
        ";

        // Version texte alternative
        $mail->AltBody = "
📦 KODPWOMO - CODE DE VERIFICATION 🔐

Votre code de sécurité : $otp

⏱️ IMPORTANT :
- Ce code expire dans 5 minutes
- Utilisez-le uniquement sur la plateforme kodPwomo
- Ne partagez jamais ce code

📧 Email automatique - Ne pas répondre
© 2025 kodPwomo - Livraison Étudiante RD Congo
        ";

        $mail->send();
       // echo "✅ OTP envoyé à $email";
    } catch (Exception $e) {
        response("❌ Erreur d'envoi : {$mail->ErrorInfo}");
    }
} else {
    response("❌ Email non fourni");
}