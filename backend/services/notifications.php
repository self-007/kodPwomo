<?php
//get notifications
function getNotificationsByUserId($userId) {
    // verify int value or superior to 0
    if (intval($userId) <= 0) {
        response(['error' => 'Invalid user ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//create notification
function createNotification() {
    global $datas;
    //verify datas
    if(!isset($datas['userId']) || !isset($datas['message']) || !isset($datas['type'])) {
        response(['error' => 'donnees manquantes'], 400);
    }
    $message =  sanitizeInput($datas['message']);
    $userId = sanitizeInput($datas['userId']);
    $type = sanitizeInput($datas['type']);
    // verify int value or superior to 0
    if (empty($userId)) {
        response(['error' => 'Invalid user ID'], 400);
    }
    // Validate input
    if (empty($message) || empty($type)) {
        response(['error' => 'Message and type are required'], 400);
    }        
   
    global $connection;
    $stmt = $connection->prepare("INSERT INTO notifications (id_user, message, type) VALUES (:user_id, :message, :type)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':type', $type);
    if ($stmt->execute()) {
       response(['success' => 'Notification created successfully']);
    } else {
        response(['error' => 'Failed to create notification'], 500);
    }
}
//delete notification
function deleteNotification($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid notification ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE notifications SET status = 'deleted' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return ['message' => 'Notification deleted successfully'];
    } else {
        response(['error' => 'Failed to delete notification'], 500);
    }
}
//mark notification as read
//must veify if this is the current user notifications
function markNotificationAsRead($id) {
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid notification ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE notifications SET status = 'read' WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        response(['success' => 'Notification marked as read successfully']);
    } else {
        response(['error' => 'Failed to mark notification as read'], 500);
    }
}
//get all notifications for admin dashboard
function getAllNotificationsAdm() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM notifications ORDER BY date DESC");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'notifications' => []];
    }
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'notifications' => $notifications];
}