/**
 * Agent Code Manager
 * Gère la récupération, le cache et l'affichage du code agent
 * Cache le code pendant 30 minutes
*/

class AgentCodeManager {
    constructor(config = {}) {
        this.storageKey = config.storageKey || 'agentCode';
        this.dateKey = config.dateKey || 'agentCodeDate';
        this.cacheExpiry = config.cacheExpiry || 30 * 60 * 1000; // 30 minutes en millisecondes
        this.apiEndpoint = config.apiEndpoint || 'backend/agent/code';
        this.displaySelector = config.displaySelector || '#agentCodeDisplay';
    }

    /**
     * Récupère le code agent depuis le serveur
     */
    async fetchAgentCode() {
        try {
            const accessToken = localStorage.getItem('access_token');
            
            if (!accessToken) {
                throw new Error('Token d\'authentification manquant');
            }
            
            console.log('Requête API: récupération du code agent depuis le serveur');
            
            const response = await fetch(this.apiEndpoint, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + accessToken
                }
            });
            
            if (!response.ok) {
                throw new Error(`Erreur API: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.success && data.agentCode) {
                this.saveToCache(data.agentCode);
                return data.agentCode;
            } else {
                throw new Error(data.message || 'Erreur lors de la récupération du code agent');
            }
        } catch (error) {
            console.error('Erreur lors de la récupération du code agent:', error);
            throw error;
        }
    }

    /**
     * Vérifie si le code agent est valide et non expiré
     */
    isCacheValid() {
        const storedDate = localStorage.getItem(this.dateKey);
        
        if (!storedDate) {
            return false;
        }

        const retrievalTime = parseInt(storedDate);
        const currentTime = Date.now();
        const elapsedTime = currentTime - retrievalTime;

        return elapsedTime < this.cacheExpiry;
    }

    /**
     * Récupère le code agent depuis le cache localStorage
     */
    getFromCache() {
        return localStorage.getItem(this.storageKey);
    }

    /**
     * Sauvegarde le code agent dans le cache localStorage
     */
    saveToCache(agentCode) {
        localStorage.setItem(this.storageKey, agentCode);
        localStorage.setItem(this.dateKey, Date.now().toString());
    }

    /**
     * Récupère le code agent avec vérification du cache
     */
    async getAgentCode(forceRefresh = false) {
        try {
            // Forcer la actualisation si demandé
            if (forceRefresh) {
                return await this.fetchAgentCode();
            }

            // Vérifier si le code est en cache et valide
            if (this.isCacheValid()) {
                const cachedCode = this.getFromCache();
                if (cachedCode) {
                    console.log('Code agent récupéré depuis le cache');
                    return cachedCode;
                }
            }

            // Le cache n'existe pas ou est expiré, faire une nouvelle requête
            console.log('Cache invalide ou expiré, récupération d\'un nouveau code');
            return await this.fetchAgentCode();
        } catch (error) {
            console.error('Erreur lors de la récupération du code agent:', error);
            throw error;
        }
    }

    /**
     * Affiche le code agent dans la page
     */
    displayAgentCode(agentCode) {
        const displayElement = document.querySelector(this.displaySelector);
        
        if (displayElement) {
            displayElement.textContent = agentCode;
            displayElement.style.display = 'block';
        } else {
            console.warn(`Élément d'affichage non trouvé: ${this.displaySelector}`);
        }
    }

    /**
     * Initialise le système et affiche le code
     */
    async initialize() {
        try {
            const agentCode = await this.getAgentCode();
            this.displayAgentCode(agentCode);
            return agentCode;
        } catch (error) {
            console.error('Erreur lors de l\'initialisation du gestionnaire de code agent:', error);
            // Afficher un message d'erreur à l'utilisateur
            const displayElement = document.querySelector(this.displaySelector);
            if (displayElement) {
                displayElement.textContent = 'Erreur: Impossible de charger le code agent';
                displayElement.style.display = 'block';
            }
            throw error;
        }
    }

    /**
     * Obtient les informations du cache (code et date)
     */
    getCacheInfo() {
        return {
            code: this.getFromCache(),
            date: localStorage.getItem(this.dateKey),
            isValid: this.isCacheValid(),
            expiresIn: this.getExpirationTime()
        };
    }

    /**
     * Obtient le temps restant avant l'expiration du cache (en secondes)
     */
    getExpirationTime() {
        const storedDate = localStorage.getItem(this.dateKey);
        
        if (!storedDate) {
            return null;
        }

        const retrievalTime = parseInt(storedDate);
        const currentTime = Date.now();
        const elapsedTime = currentTime - retrievalTime;
        const remainingTime = Math.max(0, this.cacheExpiry - elapsedTime);

        return Math.ceil(remainingTime / 1000); // Retourner en secondes
    }

    /**
     * Efface le cache
     */
    clearCache() {
        localStorage.removeItem(this.storageKey);
        localStorage.removeItem(this.dateKey);
        console.log('Cache du code agent effacé');
    }

    /**
     * Force une actualisation immédiate du code agent
    */
    async refreshCode() {
        this.clearCache();
        return await this.getAgentCode(true);
    }
}

// Initialisation automatique si le script est inclus avec data-auto-init
document.addEventListener('DOMContentLoaded', function() {
    const script = document.currentScript;
    
    if (script && script.hasAttribute('data-auto-init')) {
        const config = {
            storageKey: script.dataset.storageKey || 'agentCode',
            dateKey: script.dataset.dateKey || 'agentCodeDate',
            cacheExpiry: parseInt(script.dataset.cacheExpiry) || 30 * 60 * 1000,
            apiEndpoint: script.dataset.apiEndpoint || '/backend/agent/code',
            displaySelector: script.dataset.displaySelector || '#agentCodeDisplay'
        };

        const manager = new AgentCodeManager(config);
        manager.initialize();

        // Exposer le manager globalement pour utilisation en console/autres scripts
        window.agentCodeManager = manager;
    }
});
