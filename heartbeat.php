<?php
// heartbeat.php - Système de heartbeat pour maintenir la session active
// À inclure dans toutes les pages : <?php include 'heartbeat.php'; ?>
?>

<script>
// Générer un fingerprint simple
function generateFingerprint() {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    ctx.textBaseline = 'top';
    ctx.font = '14px Arial';
    ctx.fillText('kodPwomo fingerprint', 2, 2);
    
    const fingerprint = canvas.toDataURL() + 
        navigator.userAgent + 
        screen.width + screen.height + 
        new Date().getTimezoneOffset();
    
    return btoa(fingerprint).substring(0, 32);
}

const fingerPrint = generateFingerprint();

// Fonction heartbeat pour maintenir la session active
async function heartBeat() {
    try {
        const accessToken = localStorage.getItem('access_token');
        
        // Si pas de token, pas besoin de heartbeat
        if (!accessToken) {
            return;
        }

        const response = await fetch('<?php echo $_SERVER['REQUEST_URI'] !== '/' ? './' : ''; ?>backend/heartbeat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + accessToken
            },
            body: JSON.stringify({
                fingerprint: fingerPrint
            })
        });

        const data = await response.json();

        if (data.status === 'success' && data.access_token) {
            // Rafraîchir le token
            localStorage.setItem('access_token', data.access_token);
            console.log('[Heartbeat] Token rafraîchi');
        } else if (data.action === 'out' || data.error === 'expired') {
            // Session expirée
            console.log('[Heartbeat] Session expirée, redirection...');
            window.location.href = window.location.origin + '/kodPwomo/login.php';
        }
    } catch (error) {
        console.error('[Heartbeat] Erreur:', error);
    }
}
// Fonction de déconnexion
async function logout() {
    const accessToken = localStorage.getItem('access_token');
    
    try {
        if (accessToken) {
            const response = await fetch('<?php echo $_SERVER['REQUEST_URI'] !== '/' ? './' : ''; ?>backend/logout', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            });
            
            if (!response.ok) {
                console.error('❌ Erreur lors de la déconnexion:', response.status);
            } else {
                console.log('✅ Déconnexion confirmée par le serveur');
            }
        }
    } catch (error) {
        console.error('❌ Erreur réseau lors de la déconnexion:', error);
    } finally {
        // Clear localStorage et redirection après traitement
        localStorage.clear();
       window.location.href = window.location.origin + '/kodPwomo/login.php';
    }
}

// Envoyer un heartbeat immédiatement, puis tous les 20 secondes
heartBeat();
setInterval(heartBeat, 20000);
</script>