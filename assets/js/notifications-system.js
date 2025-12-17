/**
 * Sistema de Notificaciones Global - kodPwomo
 * Este archivo gestiona las notificaciones en todas las páginas
 * Se debe incluir en cualquier página que tenga access_token en localStorage
 */

// ===== VARIABLES GLOBALES =====
let notificationCheckInterval = null;
let activeNotifications = [];

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si hay token de acceso antes de inicializar
    const accessToken = localStorage.getItem('access_token');
    if (accessToken) {
        initNotificationSystem();
    }
});

// ===== FUNCIONES PRINCIPALES =====
function initNotificationSystem() {
    console.log('Système de notifications initialisé');
    
    // Crear contenedor si no existe
    if (!document.getElementById('notificationsContainer')) {
        const container = document.createElement('div');
        container.id = 'notificationsContainer';
        container.className = 'notifications-container';
        document.body.appendChild(container);
    }
    
    // Cargar notificaciones inmediatamente
    loadNotifications();
    
    // Luego cada 60 segundos
    notificationCheckInterval = setInterval(() => {
        if (!document.hidden) {
            loadNotifications();
        }
    }, 60000);
}

async function loadNotifications() {
    try {
        const accessToken = localStorage.getItem('access_token');
        
        if (!accessToken) {
            console.log('Sans jeton d\'accès');
            return;
        }
        
        const response = await fetch(`backend/notifications/unread`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + accessToken,
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Notifications reçues:', data);
        
        // Verificar formato backend: {nbrs: 1, notifications: {...}}
        if (!data.notifications || data.nbrs === 0) {
            console.log('Aucune notification');
            return;
        }
        
        // Procesar notificación - puede ser un objeto o un array
        let notificationsArray = Array.isArray(data.notifications) ? data.notifications : [data.notifications];
        console.log('Notifications à afficher:', notificationsArray);
        
        notificationsArray.forEach(notification => {
            // Verificar si la notificación no se muestra ya
            if (!activeNotifications.find(n => n.id === notification.id)) {
                displayNotification(notification);
                activeNotifications.push(notification);
            }
        });
        
    } catch (error) {
        console.error('Erreur lors du chargement des notifications:', error);
    }
}

function displayNotification(notification) {
    const container = document.getElementById('notificationsContainer');
    
    if (!container) {
        console.error('Conteneur de notifications introuvable');
        return;
    }
    
    // Crear elemento de notificación
    const notif = document.createElement('div');
    notif.className = 'notification box-3d';
    notif.dataset.id = notification.id;
    
    // Determinar icono según tipo
    let icon = 'fas fa-bell';
    if (notification.type === 'order') {
        icon = 'fas fa-shopping-bag';
    } else if (notification.type === 'delivery') {
        icon = 'fas fa-truck';
    } else if (notification.type === 'message') {
        icon = 'fas fa-envelope';
    } else if (notification.type === 'avis' || notification.type === 'review') {
        icon = 'fas fa-star';
    }
    
    // Format de date
    const date = new Date(notification.created_at || notification.date).toLocaleDateString('fr-FR');
    
    notif.innerHTML = `
        <div class="notification-header">
            <i class="${icon}"></i>
            <span class="notification-type">${notification.type || 'Notification'}</span>
            <span class="notification-date">${date}</span>
        </div>
        <div class="notification-content">
            <p class="notification-message">${notification.message || notification.title || 'Nouvelle notification'}</p>
        </div>
        <div class="notification-actions">
            <button class="notification-btn close-btn" onclick="removeNotification(${notification.id})">
                <i class="fas fa-times"></i> Fermer
            </button>
        </div>
    `;
    
    container.appendChild(notif);
    
    // Supprimer automatiquement après 10 secondes
    setTimeout(() => {
        removeNotification(notification.id);
    }, 10000);
}

function removeNotification(id) {
    const notif = document.querySelector(`.notification[data-id="${id}"]`);
    if (notif) {
        notif.style.animation = 'slideOut 0.3s ease forwards';
        setTimeout(() => {
            notif.remove();
            activeNotifications = activeNotifications.filter(n => n.id !== id);
        }, 300);
    }
}

// ===== NETTOYER AU DÉCHARGEMENT =====
window.addEventListener('beforeunload', function() {
    if (notificationCheckInterval) {
        clearInterval(notificationCheckInterval);
    }
});
