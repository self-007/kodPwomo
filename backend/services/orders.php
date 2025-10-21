<?php
//orders status : pending, processing, completed, cancelled
//get commandes all
function getAllOrders() {
    global $connection;
    $stmt = $connection->prepare("SELECT o.*, 
    (SELECT SUM(d.delivery_price) FROM deliveries d JOIN orders o ON d.id_commande = o.order_id) as total_deliveries FROM orders o ORDER BY o.date DESC");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
         
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_amount = $orders[0]['total_deliveries'];
    return ['nbrs' => $nbrs, 'orders' => $orders, 'money' => $total_amount];
}
// get order by id
function getOrderById($id) {
    // id is alpha num value
    $id = sanitizeInput($id);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE order_id = :id");
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    if ($stmt->rowCount() === 0) {
       return ['nbrs' => 0, 'order' => null];
    }
    $nbrs = $stmt->rowCount();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'order' => $order];
}
//create order
function createOrder($userId, $productList, $totalAmount, $status = 'pending') {
    // verify int value or superior to 0
    if (empty($userId) || empty($productList) || floatval($totalAmount) <= 0) {
        response(['error' => 'Invalid user ID, product list, or total amount'], 400);
    }
    $userId = sanitizeInput($userId);
    $totalAmount = floatval($totalAmount);
    $orderCode = orderCode();
    global $connection;
    try {
        $connection->beginTransaction();
        $stmt = $connection->prepare("INSERT INTO orders (user_id, order_code, product_list, total_amount, status) VALUES (:user_id, :order_code, :product_list, :total_amount, :status)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':order_code', $orderCode);
        $stmt->bindParam(':product_list', json_encode($productList));
        $stmt->bindParam(':total_amount', $totalAmount);
        $stmt->bindParam(':status', $status);
        if ($stmt->execute()) {
            $orderId = $connection->lastInsertId();
            $connection->commit();
            // Notify available agents about the new order
            notifyAvailableAgents($orderId, json_encode($productList));
            return $orderId;
        } else {
            $connection->rollBack();
            response(['error' => 'Failed to create order'], 500);
        }
    } catch (Exception $e) {
        $connection->rollBack();
        response(['error' => 'Failed to create order: ' . $e->getMessage()], 500);
    }
}
// update order status
function updateOrderStatus($orderId, $status) {
    // verify int value or superior to 0
    if (intval($orderId) <= 0 || empty($status)) {
        response(['error' => 'Invalid order ID or status'], 400);
    }
    $status = sanitizeInput($status);
    global $connection;
    $stmt = $connection->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $orderId);
    if ($stmt->execute()) {
        return ['message' => 'Order status updated successfully'];
    } else {
        response(['error' => 'Failed to update order status'], 500);
    }
}
// get orders by user id alpha numeric
function getOrdersByUserId($userId) {
    // id is alpha num value
    $userId = sanitizeInput($userId);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY date DESC");
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $orders];
}
//get orders by status
function getOrdersByStatus($status) {
    $status = sanitizeInput($status);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = :status ORDER BY date DESC");
    $stmt->bindParam(':status', $status);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $orders];
}

// get completed orders count
function getCompletedOrdersCount() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = 'completed'");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $completedOrders = $result;
    return ['nbrs' => $nbrs, 'orders' => $completedOrders];
}
// get pending orders count == not taken by an agent yet
function getPendingOrdersCount() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = 'pending'");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pendingOrders = $result;
    
    return ['nbrs' => $nbrs, 'orders' => $pendingOrders];
}
// get processing orders count == taken by an agent but not yet completed
function getProcessingOrdersCount() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = 'processing'");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $processingOrders = $result;
    
    return ['nbrs' => $nbrs, 'orders' => $processingOrders];
}
// get cancelled orders count
function getCancelledOrdersCount() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = 'cancelled'");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $cancelledOrders = $result;
    
    return ['nbrs' => $nbrs, 'orders' => $cancelledOrders];
}
// total orders by day
function getTotalOrdersByDay() {
    $date = date('Y-m-d');
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE DATE(date) = :date GROUP BY order_id");
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $orders];
}
// total orders by month
function getTotalOrdersByMonth() {
    $month = date('Y-m');
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE DATE_FORMAT(date, '%Y-%m') = :month");
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $orders];
}
// total orders by year
function getTotalOrdersByYear() {
    $year = date('Y');
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE DATE_FORMAT(date, '%Y') = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $orders];
}
//get productname, qnt , get orderid, university, room, 
function getPendingOrderData(){
    global $connection;
    $stmt = 'SELECT products.name as product_name, orders.order_id, orders.qnt, orders.price, university.name as university_name, salle_name FROM products JOIN orders ON orders.id_product = products.id JOIN salle ON salle.id = adresse_id JOIN university ON university.id = salle.id_university WHERE status = ""';
    $stmt = $connection->prepare($stmt);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs == 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['orders' => $orders, 'nbrs' => $nbrs], 200);
}
// get processing orders by agent id
function AgentProcessingOrder(){
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM orders WHERE status = 'processing' AND ");
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $processingOrders = $result;
    
    return ['nbrs' => $nbrs, 'orders' => $processingOrders];
    
}
//  get all orders by university id
function getAllOrdersByUniversityId($universityId) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT orders.* FROM orders JOIN salle ON orders.adresse_id = salle.id WHERE salle.id_university = :university_id ORDER BY orders.date DESC");
    $stmt->bindParam(':university_id', $universityId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'orders' => []];
    }
    $processingOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'orders' => $processingOrders];
}
