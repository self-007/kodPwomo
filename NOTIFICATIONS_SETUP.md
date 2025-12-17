# Sistema de Notificaciones Global - kodPwomo

## Descripción
Sistema de notificaciones en tiempo real que funciona en todas las páginas del sitio. Las notificaciones se cargan automáticamente desde el backend cada 30 segundos si el usuario tiene un `access_token` válido en `localStorage`.

## Archivos incluidos
- `assets/js/notifications-system.js` - Lógica de notificaciones
- `assets/css/notifications-system.css` - Estilos de notificaciones

## Cómo integrar en cualquier página

### Paso 1: Incluir el CSS
Agregue esto en el `<head>` de su página HTML:
```html
<link rel="stylesheet" href="assets/css/notifications-system.css">
```

### Paso 2: Incluir Font Awesome (si no lo tiene)
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
```

### Paso 3: Incluir el JavaScript
Agregue esto antes del cierre del `</body>`:
```html
<script src="assets/js/notifications-system.js"></script>
```

## Ejemplo de integración completa

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mi Página</title>
    
    <!-- CSS del sistema de notificaciones -->
    <link rel="stylesheet" href="assets/css/notifications-system.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <!-- Tu contenido aquí -->
    
    <!-- Script del sistema de notificaciones (debe estar al final del body) -->
    <script src="assets/js/notifications-system.js"></script>
</body>
</html>
```

## Requisitos
- El usuario debe tener un `access_token` en `localStorage` (se crea al login)
- El endpoint `backend/notifications/unread` debe estar disponible
- Font Awesome 6.4.0 cargado en la página

## Características
✅ Carga automática de notificaciones cada 30 segundos  
✅ Se detiene cuando la pestaña está oculta (ahorro de recursos)  
✅ Animaciones suaves (slide in/out)  
✅ Iconos según tipo de notificación (order, delivery, message, etc.)  
✅ Auto-elimina notificaciones después de 10 segundos  
✅ Responsive (funciona en mobile)  
✅ 100% reutilizable en todas las páginas  

## Tipos de notificaciones soportadas
- `order` - Icono: bolsa de compras
- `delivery` - Icono: camión
- `message` - Icono: sobre
- `avis` / `review` - Icono: estrella
- `default` - Icono: campana

## Personalizaciones

### Cambiar intervalo de carga
Edite `assets/js/notifications-system.js`, línea ~47:
```javascript
}, 30000);  // Cambiar 30000 (30 segundos) a otro valor en milisegundos
```

### Cambiar duración antes de auto-eliminar
Edite `assets/js/notifications-system.js`, línea ~116:
```javascript
}, 10000);  // Cambiar 10000 (10 segundos) a otro valor
```

### Agregar más tipos de iconos
Edite `assets/js/notifications-system.js`, línea ~76-83:
```javascript
if (notification.type === 'nuevoTipo') {
    icon = 'fas fa-new-icon';
}
```

## Páginas donde debe estar integrado
- ✅ `agent.php` - Ya integrado
- [ ] `index.php` - Por agregar
- [ ] `blog.php` - Por agregar
- [ ] `dashboard_user/dashboard.php` - Por agregar
- [ ] `boutique.php` - Por agregar

## Debugging
Abra la consola del navegador (F12) para ver los logs:
- `Sistema de notificaciones inicializado` - Si se cargó correctamente
- `Notificaciones recibidas: {...}` - Datos del backend
- `Notificaciones a mostrar: [...]` - Notificaciones procesadas
- Errores si hay problemas de conexión

## Soporte
Para agregar el sistema a una nueva página:
1. Copie los 3 includes (CSS, Font Awesome, JS)
2. Asegúrese que el usuario tenga `access_token` en localStorage
3. Pruebe en la consola del navegador
