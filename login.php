<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kodPwomo - Connexion</title>
    <link rel="stylesheet" href="assets/css/kodpwomo-colors.css">
    <!-- Firebase v9+ -->
    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
        import { getAuth, GoogleAuthProvider, signInWithPopup, signOut, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';
        
        // Configuration Firebase pour kodPwomo
    const firebaseConfig = {
        apiKey: "AIzaSyCubIbx_OWfBj99G7k60fHYn030IUOIGGE",
        authDomain: "wegamer-ec0f9.firebaseapp.com",
        databaseURL: "https://wegamer-ec0f9-default-rtdb.firebaseio.com",
        projectId: "wegamer-ec0f9",
        storageBucket: "wegamer-ec0f9.firebasestorage.app",
        messagingSenderId: "57666331000",
        appId: "1:57666331000:web:9bf93ea8850727373ce88d",
        measurementId: "G-YDKVD2JMLY"
    };

        // Initialiser Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        
        // Exposer Firebase globalement
        window.firebaseAuth = auth;
        window.GoogleAuthProvider = GoogleAuthProvider;
        window.signInWithPopup = signInWithPopup;
        window.signOut = signOut;
        window.onAuthStateChanged = onAuthStateChanged;
        
        console.log('Firebase initialisé pour kodPwomo');
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 450px;
            position: relative;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: var(--primary);
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .logo p {
            color: var(--medium-gray);
            font-size: 1.1em;
        }
        
        .mode-toggle {
            display: flex;
            margin-bottom: 15px;
            border-radius: 25px;
            overflow: hidden;
            border: 2px solid var(--primary);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .mode-btn {
            flex: 1;
            padding: 12px 20px;
            background: transparent;
            color: #333;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .mode-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .mode-btn:hover:not(.active) {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .auth-tabs {
            display: flex;
            margin-bottom: 30px;
            background: var(--light-gray);
            border-radius: 10px;
            padding: 5px;
        }
        
        .tab-btn {
            flex: 1;
            padding: 12px;
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--medium-gray);
        }
        
        .tab-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .auth-form {
            display: none;
        }
        
        .auth-form.active {
            display: block;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn-submit:disabled {
            background: var(--disabled);
            cursor: not-allowed;
            transform: none;
        }
        
        .google-signin {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .google-btn {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #dadce0;
            border-radius: 10px;
            background: white;
            color: #3c4043;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        
        .google-btn:hover {
            border-color: #4285f4;
            box-shadow: 0 2px 8px rgba(66, 133, 244, 0.2);
        }
        
        .google-btn:active {
            transform: translateY(1px);
        }
        
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: var(--medium-gray);
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--light-gray);
        }
        
        .divider span {
            background: white;
            padding: 0 15px;
        }
        
        /* Modal OTP */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .modal-header h2 {
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .modal-header p {
            color: var(--medium-gray);
            line-height: 1.6;
        }
        
        .otp-input {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }
        
        .otp-digit {
            width: 50px;
            height: 50px;
            border: 2px solid var(--light-gray);
            border-radius: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            transition: border-color 0.3s ease;
        }
        
        .otp-digit:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .btn-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--medium-gray);
        }
        
        .btn-resend {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
        }
        
        .loading {
            display: none;
            text-align: center;
            color: var(--primary);
            margin: 20px 0;
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert-success {
            background: var(--success-alpha-10);
            color: var(--success);
            border: 1px solid var(--success);
        }
        
        .alert-error {
            background: var(--primary-alpha-10);
            color: var(--error);
            border: 1px solid var(--error);
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .otp-digit {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <h1>📦 kodPwomo</h1>
            <p>Connexion à votre compte</p>
        </div>
        
        <!-- Alertes -->
        <div id="alert" class="alert">
            <span id="alertMessage"></span>
        </div>
        
        <!-- Toggle Login/Register -->
        <div class="mode-toggle">
            <button class="mode-btn active" onclick="switchMode('login')">Se connecter</button>
            <button class="mode-btn" onclick="switchMode('register')">S'inscrire</button>
        </div>
        
        <!-- Tabs de méthodes d'auth -->
        <div class="auth-tabs">
            <button class="tab-btn active" onclick="switchTab('email')">📧 Email</button>
            <button class="tab-btn" onclick="switchTab('google')">🔍 Google</button>
        </div>
        
        <!-- Formulaire Email/Password -->
        <form id="emailForm" class="auth-form active">
            <div class="form-group">
                <label class="form-label" for="username">Nom d'utilisateur</label>
                <input type="text" id="username" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="firstname">Prénom</label>
                <input type="text" id="firstname" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" class="form-input" required>
            </div>
            
            <button type="submit" class="btn-submit" id="emailSubmitBtn">
                🚀 Créer mon compte
            </button>
        </form>
        
        <!-- Formulaire Google Firebase -->
        <div id="googleForm" class="auth-form">
            <div class="google-signin">
                <button id="google-signin-btn" type="button" class="google-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Se connecter avec Google
                </button>
            </div>
            
            <div class="divider">
                <span>Connexion sécurisée avec Firebase</span>
            </div>
            
            <p style="text-align: center; color: var(--medium-gray); font-size: 0.9em;">
                En utilisant Google, vous acceptez nos conditions d'utilisation.
            </p>
        </div>
        
        <!-- Loading -->
        <div id="loading" class="loading">
            <div>⏳ Création de votre compte...</div>
        </div>
    </div>
    
    <!-- Modal OTP -->
    <div id="otpModal" class="modal-overlay">
        <div class="modal-content">
            <button class="btn-close" onclick="closeOtpModal()">&times;</button>
            
            <div class="modal-header">
                <h2>🔐 Code de Vérification</h2>
                <p>Nous avons envoyé un code à 6 chiffres sur votre email. Saisissez-le ci-dessous pour confirmer votre compte.</p>
            </div>
            
            <div class="otp-input">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 0)">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 1)">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 2)">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 3)">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 4)">
                <input type="text" class="otp-digit" maxlength="1" oninput="moveToNext(this, 5)">
            </div>
            
            <button class="btn-submit" onclick="verifyOtp()">✅ Vérifier le Code</button>
            
            <div style="text-align: center;">
                <p style="color: var(--medium-gray); font-size: 0.9em; margin-bottom: 10px;">
                    Vous n'avez pas reçu le code ?
                </p>
                <button class="btn-resend" onclick="resendOtp()">📤 Renvoyer le Code</button>
            </div>
        </div>
    </div>

    <script>
        // Variables globales
        let currentUserEmail = '';
        let fingerPrint = '';
        
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
        
        let currentMode = 'login'; // Mode par défaut
        
        // Basculer entre les modes Login/Register
        function switchMode(mode) {
            currentMode = mode;
            
            // Mettre à jour les boutons mode
            document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Mettre à jour le titre et les textes
            const title = document.querySelector('h1');
            const submitBtn = document.querySelector('.btn-submit');
            
            if (mode === 'login') {
                title.textContent = 'kodPwomo - Connexion';
                submitBtn.textContent = '🚀 Se connecter';
                // Masquer les champs nom d'utilisateur et prénom pour la connexion
                document.getElementById('username').parentElement.style.display = 'none';
                document.getElementById('firstname').parentElement.style.display = 'none';
                // Rendre les champs optionnels
                document.getElementById('username').required = false;
                document.getElementById('firstname').required = false;
                // Afficher seulement email et mot de passe
                document.getElementById('email').parentElement.style.display = 'block';
                document.getElementById('password').parentElement.style.display = 'block';
                document.getElementById('email').required = true;
                document.getElementById('password').required = true;
            } else {
                title.textContent = 'kodPwomo - Inscription';
                submitBtn.textContent = '✨ Créer mon compte';
                // Afficher tous les champs pour l'inscription
                document.getElementById('username').parentElement.style.display = 'block';
                document.getElementById('firstname').parentElement.style.display = 'block';
                document.getElementById('email').parentElement.style.display = 'block';
                document.getElementById('password').parentElement.style.display = 'block';
                // Tous les champs requis pour l'inscription
                document.getElementById('username').required = true;
                document.getElementById('firstname').required = true;
                document.getElementById('email').required = true;
                document.getElementById('password').required = true;
            }
        }
        
        // Basculer entre les onglets
        function switchTab(tabName) {
            // Mettre à jour les boutons
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Mettre à jour les formulaires
            document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
            document.getElementById(tabName + 'Form').classList.add('active');
        }
        
        // Gestion du formulaire email
        document.getElementById('emailForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                mode: currentMode, // 'login' ou 'register'
                type: 'email',
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                fingerPrint: fingerPrint
            };
            
            // Ajouter les champs supplémentaires seulement pour l'inscription
            if (currentMode === 'register') {
                formData.username = document.getElementById('username').value;
                formData.firstname = document.getElementById('firstname').value;
            }
            
            await submitForm(formData);
        });
        
        // Fonction pour attendre Firebase
        function waitForFirebase() {
            return new Promise((resolve) => {
                const checkFirebase = () => {
                    if (window.firebaseAuth && window.GoogleAuthProvider && window.signInWithPopup) {
                        resolve();
                    } else {
                        setTimeout(checkFirebase, 50);
                    }
                };
                checkFirebase();
            });
        }

        // Gestion Google Firebase Auth
        document.getElementById('google-signin-btn').addEventListener('click', async function() {
            try {
                showLoading(true);
                hideAlert();
                
                // Attendre que Firebase soit chargé
                await waitForFirebase();
                
                const provider = new window.GoogleAuthProvider();
                provider.setCustomParameters({ 
                    prompt: 'select_account' 
                });
                
                const result = await window.signInWithPopup(window.firebaseAuth, provider);
                const user = result.user;
                
                // Préparer les données utilisateur
                const nameParts = (user.displayName || '').split(' ');
                const formData = {
                    mode: currentMode, // Ajouter le mode actuel (login ou register)
                    type: 'google',
                    username: user.displayName || user.email.split('@')[0],
                    email: user.email,
                    firstname: nameParts[0] || '',
                    lastname: nameParts.slice(1).join(' ') || '',
                    id_unique: 'GOOGLE_' + user.uid,
                    fingerPrint: fingerPrint,
                    photoURL: user.photoURL
                };
                
                await submitForm(formData);
                
            } catch (error) {
                console.error('Erreur Firebase Auth:', error);
                showLoading(false);
                
                let errorMessage = 'Erreur lors de la connexion Google';
                
                if (error.code) {
                    switch (error.code) {
                        case 'auth/popup-closed-by-user':
                            errorMessage = 'Connexion annulée';
                            return; // Ne pas afficher d'erreur
                        case 'auth/popup-blocked':
                            errorMessage = 'Pop-up bloqué. Autorisez les pop-ups pour ce site';
                            break;
                        case 'auth/cancelled-popup-request':
                            errorMessage = 'Demande annulée';
                            return;
                        case 'auth/network-request-failed':
                            errorMessage = 'Erreur réseau. Vérifiez votre connexion';
                            break;
                    }
                }
                
                showAlert(errorMessage, 'error');
            }
        });
        
        // Soumettre le formulaire
        async function submitForm(formData) {
            showLoading(true);
            hideAlert();
            
            // Mettre à jour le texte de chargement selon le mode
            const loadingText = document.querySelector('#loading div');
            if (formData.mode === 'login') {
                loadingText.textContent = '🔑 Connexion en cours...';
            } else {
                loadingText.textContent = '⏳ Création de votre compte...';
            }
            
            try {
                const response = await fetch('backend/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });
                
                const result = await response.json();
                
                if (result.status === 'success') {
                    if (result.otp === 'confim') {
                        // OTP requis
                        currentUserEmail = formData.email;
                        showOtpModal();
                    } else {
                        // Succès direct (Google)
                        showAlert('success', result.message);
                        setTimeout(() => {
                            window.location.href = 'dashboard.html';
                        }, 2000);
                    }
                } else {
                    showAlert('error', result.error || 'Erreur lors de la création du compte');
                }
                
            } catch (error) {
                console.error('Erreur:', error);
                showAlert('error', 'Erreur de connexion au serveur');
            }
            
            showLoading(false);
        }
        
        // Gestion des alertes
        function showAlert(type, message) {
            const alert = document.getElementById('alert');
            const alertMessage = document.getElementById('alertMessage');
            
            alert.className = `alert alert-${type}`;
            alertMessage.textContent = message;
            alert.style.display = 'block';
        }
        
        function hideAlert() {
            document.getElementById('alert').style.display = 'none';
        }
        
        // Gestion du loading
        function showLoading(show) {
            document.getElementById('loading').style.display = show ? 'block' : 'none';
            document.getElementById('emailSubmitBtn').disabled = show;
        }
        
        // Modal OTP
        function showOtpModal() {
            document.getElementById('otpModal').style.display = 'block';
            document.querySelector('.otp-digit').focus();
        }
        
        function closeOtpModal() {
            document.getElementById('otpModal').style.display = 'none';
            // Réinitialiser les champs OTP
            document.querySelectorAll('.otp-digit').forEach(input => input.value = '');
        }
        
        // Navigation dans les champs OTP
        function moveToNext(current, index) {
            if (current.value.length === 1 && index < 5) {
                document.querySelectorAll('.otp-digit')[index + 1].focus();
            }
            
            // Auto-vérification si tous les champs sont remplis
            const allFilled = Array.from(document.querySelectorAll('.otp-digit'))
                                  .every(input => input.value.length === 1);
            if (allFilled) {
                setTimeout(verifyOtp, 500);
            }
        }
        
        // Vérifier le code OTP
        async function verifyOtp() {
            const otpDigits = document.querySelectorAll('.otp-digit');
            const otpCode = Array.from(otpDigits).map(input => input.value).join('');
            
            if (otpCode.length !== 6) {
                showAlert('error', 'Veuillez saisir les 6 chiffres du code');
                return;
            }
            
            try {
                showLoading(true);
                
                const response = await fetch('backend/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: currentUserEmail,
                        otp: otpCode
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    closeOtpModal();
                    showAlert('success', 'Compte créé avec succès ! Redirection...');
                    setTimeout(() => {
                        window.location.href = 'dashboard.html';
                    }, 2000);
                } else {
                    showAlert('error', result.error || 'Code OTP incorrect');
                }
                
            } catch (error) {
                console.error('Erreur:', error);
                showAlert('error', 'Erreur lors de la vérification');
            }
            
            showLoading(false);
        }
        
        // Renvoyer le code OTP
        async function resendOtp() {
            try {
                const response = await fetch('backend/resend-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: currentUserEmail
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showAlert('success', 'Nouveau code envoyé !');
                } else {
                    showAlert('error', result.error || 'Erreur lors du renvoi');
                }
                
            } catch (error) {
                console.error('Erreur:', error);
                showAlert('error', 'Erreur de connexion');
            }
        }
        
        // Gestion du clavier dans le modal OTP
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('otpModal').style.display === 'block') {
                if (e.key === 'Escape') {
                    closeOtpModal();
                } else if (e.key === 'Enter') {
                    verifyOtp();
                }
            }
        });
        
        // Initialiser le mode login au chargement
        window.addEventListener('DOMContentLoaded', function() {
            // Initialiser directement en mode login
            currentMode = 'login';
            
            // Masquer nom d'utilisateur et prénom dès le début
            document.getElementById('username').parentElement.style.display = 'none';
            document.getElementById('firstname').parentElement.style.display = 'none';
            document.getElementById('username').required = false;
            document.getElementById('firstname').required = false;
            
            // S'assurer que email et password sont visibles
            document.getElementById('email').parentElement.style.display = 'block';
            document.getElementById('password').parentElement.style.display = 'block';
            document.getElementById('email').required = true;
            document.getElementById('password').required = true;
            
            // Mettre à jour le texte du bouton
            document.querySelector('.btn-submit').textContent = '🚀 Se connecter';
        });
    </script>
    
</body>
</html>