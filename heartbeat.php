<body>
    <h1>Heartbeat</h1>
    <h4>ici on fait des test de secu</h4>
</body>
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
        
fingerPrint = generateFingerprint();
//heartbeat
async function heartBeat(){
    const request = await fetch('backend/heartbeat', {
        credentials: 'include',
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + localStorage.getItem("access_token")
        },
        body: JSON.stringify({
            fingerprint: fingerPrint
        })
    });
    const response = await request.json();
    try{
       if(response.status === 'success' && response.access_token){
            //console.log('Heartbeat successful, new access token received');
            localStorage.setItem("access_token", response.access_token);
            console.log('new accesss_token, conec');
        } else if(response.action && response.action === 'out'){
            console.log('Session expired, redirecting to login page');
            window.location.href = 'login.php';
        }
    } catch(e){
        console.error('Error parsing JSON response:', e);
        console.log('this is a redirection');
    }
 
    
}
setInterval(heartBeat, 20000); //send heartbeat every 20 seconds
</script>