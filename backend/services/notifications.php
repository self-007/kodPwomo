<?php
//get notifications
function getNotificationsByUserId($userId) {
    // verify userId
    if (empty($userId)) {
        response(['error' => 'Invalid user ID'], 400);
    }
    //sanitize userId
    $userId = sanitizeInput($userId);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM notifications WHERE id_user = :user_id AND status != 'deleted' AND status != 'read' AND calls < 2 ORDER BY date DESC");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $allNotifications = $notifications;
        $nbrs = $stmt->rowCount();
        foreach ($notifications as $notifications) {
            //update each notifications call
            setNotificationCall($notifications['id']);
        }
        response(['nbrs' => $nbrs, 'notifications' => $allNotifications], 200);
    } else {
        response(['nbrs' => 0, 'notifications' => []], 200);
    }
    
}
//set notification call + 1
function setNotificationCall($id) {
    // verify if intval
    if(!is_numeric($id) || $id === null){
        response(['error' => 'Invalid notification ID'], 400);
    }
    // verify int value or superior to 0
    if (intval($id) <= 0) {
        response(['error' => 'Invalid notification ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE notifications SET calls = calls + 1 WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return ['message' => 'Notification call incremented successfully'];
    } else {
        response(['error' => 'Failed to increment notification call'], 500);
    }
}
//create notification
function createNotification() {
    global $datas;
    //verify datas
    if(!isset($datas['order_id']) || !isset($datas['message']) || !isset($datas['type'])) {
        response(['error' => 'donnees manquantes'], 400);
    }
    $message =  sanitizeInput($datas['message']);
    $order_id = sanitizeInput($datas['order_id']);
    $type = sanitizeInput($datas['type']);
    //get the client id
    $userId = getOrderById($order_id)['id'];
    if(!isset($userId)){
        response(['error' => 'Invalid user ID'], 400);
    }
    // verify if empty userId
    if (empty($userId)) {
        response(['error' => 'Invalid user ID'], 400);
    }
    // Validate input
    if (empty($message) || empty($type)) {
        response(['error' => 'Message and type are required'], 400);
    }        
   
    global $connection;
    $stmt = $connection->prepare("INSERT INTO notifications (id_user, message, type, status) VALUES (:user_id, :message, :type, 'unread')");
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
function markNotificationAsRead() {
    global $datas;
    //verify datas
    if(!isset($datas['notification_id'])) {
        response(['error' => 'Missing notification ID'], 400);
    }
    $id = $datas['notification_id'];
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