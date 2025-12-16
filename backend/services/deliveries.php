<?php
require_once __DIR__.'/../agents/agents.php';
// create a livraison
function createDelivery( $status = 'processing') {
    global $datas;
    //verify datas
    if (empty($datas['order_id']) || empty($datas['agent_id'])) {
        response(['error' => 'Invalid order ID or agent ID'], 400);
        
    }
    $orderId = sanitizeInput($datas['order_id']);
    $agentId = sanitizeInput($datas['agent_id']);
    // Verify if that order exists
    $order = getOrderById($orderId)['nbrs'];
    if ($order === 0) {
        response(['error' => 'this order doesn\'t exist'], 400);
    }
    // Verify if that agent exists
    $agent = getAgentById($agentId);
    if (!isset($agent)) {
        response(['error' => 'your agent ID is invalid'], 404);
    }
    //verify if deliveries for that order already exists
    $vrfDeliveries = getDeliveriesByOrderId($orderId);
    if ($vrfDeliveries !== null) {
        response(['error' => 'Delivery for this order already exists', 'status' => 'taken'], 200);
    }
    //get the order total price
    $total_price = getOrderById($orderId)['total_price'];
    //verify if total_price is number and > 0
    if (!is_numeric($total_price) || $total_price <= 0) {
        response(['error' => 'invalid total_price'], 400);
    }
    //get delivery cost
    $deliveryCost = ($total_price * 10) / 100; 
    global $connection;
    $stmt = $connection->prepare("INSERT INTO deliveries (id_commande, id_agent, status, delivery_price) VALUES (:order_id, :agent_id, :status, :delivery_cost)");
    $stmt->bindParam(':order_id', $orderId);
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':delivery_cost', $deliveryCost);
    if ($stmt->execute()) {
        //update order status to 'processing'
        updateOrderStatus($orderId, 'processing');
        response(['success' => true, 'message' => 'Commande assignée avec succès'], 200);

    } else {
        response(['error' => 'Failed to create delivery'], 500);
    }
}

// update delivery status
function updateDeliveryStatus($deliveryId) {
    global $datas;
    //verify datas
    if(!isset($datas['status']) || !isset($datas['order_id'])) {
        response(['error' => 'Invalid status'], 400); 
    }
    // verify int value or superior to 0
    if (intval($deliveryId) <= 0 || empty($datas['status']) || empty($datas['order_id'])) {
        response(['error' => 'Invalid delivery ID or status'], 400);
    }
    $status = sanitizeInput($datas['status']);
    $orderId = sanitizeInput($datas['order_id']);
    $user = getBearerToken();
    $agentId = sanitizeInput($user->sub);
    //verify the role
    $role = $user->role;
    if($role !== 'agent' && $role !== 'manager' && $role !== 'SUPER-ADMIN'){
        response(['error' => 'Unauthorized access'], 403);
    }
    global $connection;
    $stmt = $connection->prepare("UPDATE deliveries SET status = :status WHERE id = :id AND id_agent = :agent_id AND id_commande = :order_id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $deliveryId);
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':order_id', $orderId);
    if ($stmt->execute()) {
        response(['message' => 'Delivery status updated successfully']);
    } else {
        response(['error' => 'Failed to update delivery status'], 500);
    }
}
// give a note and a comment to an agent after delivery
function rateAgent() {
    global $datas;
    //verify datas
    if (!isset($datas['agent_code']) || !isset($datas['feedback']) || !isset($datas['rating']) || !isset($datas['order_id'])) {
        response(['error' => 'Invalid agent ID or rating'], 400);
    }
    $agentId = sanitizeInput($datas['agent_code']);
    $rating = sanitizeInput($datas['rating']);
    $orderId = sanitizeInput($datas['order_id']);
    $comment = isset($datas['feedback']) ? sanitizeInput($datas['feedback']) : null;
    // verify int value or superior to 0
    if (intval($agentId) <= 0 || intval($rating) < 1 || intval($rating) > 10) {
        response(['error' => 'Invalid agent ID or rating'], 400);
    }
    $rating = intval($rating);
    $comment = $comment ? sanitizeInput($comment) : null;
    global $connection;
    //get the user id using access token
    $accessToken = getBearerToken();
    $userId = $accessToken->sub;
    //verify this user has a delivery with that order id
    $stmt = $connection->prepare("SELECT * FROM orders WHERE order_id = :order_id AND id_user = :user_id");
    $stmt->bindParam(':order_id', $orderId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    if ($stmt->rowCount() === 0) {
        response(['error' => 'You have no delivery with this order ID'], 400);
    }
    //verify if the agentCode belongs to that agent
    $stmt = $connection->prepare("SELECT * FROM deliveries d JOIN users u ON d.id_agent = u.id_unique WHERE code = :agent_code");
    $stmt->bindParam(':agent_code', $agentId);
    $stmt->execute();
    if ($stmt->rowCount() === 0) {
        response(['error' => 'Invalid agent code'], 400);
    }
    //update the delivery, set it completed and rate the agent
    $stmt = $connection->prepare("UPDATE deliveries SET note = :rating, feedback = :comment, status = 'completed' WHERE id_commande = :order_id");
     
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':order_id', $orderId);
    if ($stmt->execute()) {
        return ['message' => 'Agent rated successfully'];
    } else {
        $message = 'their is an issues with the rate agent function inside deliveries page';
        $type = 'system alert';
        notificationsCenter($userId, $message, $type);
        response(['error' => 'Failed to rate agent'], 500);
    }
}
// get delivery by id_userique == agent_id
function getDeliveryById($id) {
    // sanitize id
    $id = sanitizeInput($id);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_agent = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $delivery = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() === 0) {
        response(['error' => 'Delivery not found: ' . $id], 404);
    }
   //response($delivery, 200);
   return $delivery;
}
// get deliveries by order_id
function getDeliveriesByOrderId($orderId) {
    //orderID is alphaNumeric , clean id
    $orderId = sanitizeInput($orderId);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_commande = :order_id");
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
    }
    return null;
}
// get all deliveries
function getAllDeliveries() {
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries");
    $stmt->execute();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $deliveries;
}
//Get deliveries by agent id and day
function getDeliveriesByAgentAndDay($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    //day is today
    $day = date('Y-m-d');

    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_agent = :agent_id AND DATE(date) = :day");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':day', $day);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //get total amount earned today
    $stmt = $connection->prepare("SELECT SUM(price) as total_amount FROM deliveries WHERE id_user = :agent_id AND DATE(date) = :day");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':day', $day);
    $stmt->execute();
    $totalAmount = $stmt->fetchColumn();
    return ['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount];
    //response(['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount], 200);
}   

//get delieveries by agent id and last month
function getDeliveriesByAgentAndLastMonth($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    //month is last month
    $month = date('Y-m', strtotime('last month'));
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y-%m') = :month");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //get total amount earned last month
    $stmt = $connection->prepare("SELECT SUM(delivery_price) as total_amount FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y-%m') = :month");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $totalAmount = $stmt->fetchColumn();
    //response(['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount], 200);
    return ['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount];
}
//get delieveries by agent id and this month
function getDeliveriesByAgentAndThisMonth($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    //month is this month
    $month = date('Y-m');
    global $connection;
    
    // Single query to get deliveries, count and total amount
    $stmt = $connection->prepare("
        SELECT *, 
        (SELECT COUNT(*) FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y-%m') = :month) as total_count,
        (SELECT COALESCE(SUM(delivery_price), 0) FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y-%m') = :month) as total_amount
        FROM deliveries 
        WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y-%m') = :month
    ");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $nbrs = !empty($deliveries) ? $deliveries[0]['total_count'] : 0;
    $totalAmount = !empty($deliveries) ? $deliveries[0]['total_amount'] : 0;
    
    // Clean the extra fields from deliveries array
    foreach ($deliveries as &$delivery) {
        unset($delivery['total_count'], $delivery['total_amount']);
    }
    
    return ['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount];
}
//get delieveries by agent id and last year
function getDeliveriesByAgentAndLastYear($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    //year is last year
    $year = date('Y', strtotime('last year'));
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y') = :year");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //get total amount earned last year
    $stmt = $connection->prepare("SELECT SUM(price * qnt) as total_amount FROM deliveries WHERE id_agent = :agent_id AND DATE_FORMAT(date, '%Y') = :year");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $totalAmount = $stmt->fetchColumn();
    //response(['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount], 200);
    return ['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount];
}
//get completed deliveries by agent id
function getCompletedDeliveriesByAgent($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE id_agent = :agent_id AND status = 'completed'");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //get total amount earned last year
    $stmt = $connection->prepare("SELECT SUM(delivery_price) as total_amount FROM deliveries WHERE id_agent = :agent_id AND status = 'completed'");
    $stmt->bindParam(':agent_id', $agentId);
    $stmt->execute();
    $totalAmount = $stmt->fetchColumn();
    //response(['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount], 200);
    return ['deliveries' => $deliveries, 'count' => $nbrs, 'total_amount' => $totalAmount];
}
// 1- total deliveries by agent id
// 2- total completed deliveries by agent id
// 3- total money earned by agent id
// 4- total money by month by agent id
function getAgentStats() {

    //id is alphaNumeric , clean id
    //$agentId = sanitizeInput($agentId); // Sanitize input
    $user = getBearerToken();
    $agentId = sanitizeInput($user->sub);
    getAgentById($agentId); // Check if agent exists
    $totalDeliveries = getDeliveryById($agentId);
    $completedDeliveries = getCompletedDeliveriesByAgent($agentId);
    if(!$completedDeliveries || $completedDeliveries['count'] == 0) {
        // send blanck table
        response([
            'nbrsTotal' => 0,
            'totalAmount' => 0,
            'lastMonthDeliveries' => [],
            'totalEarnedLastMonth' => 0,
            'lastYearDeliveries' => []
        ], 200);
    }
    $nbrsTotalDeliveries = $completedDeliveries['count'];
    $totalAmount = $completedDeliveries['total_amount'];

    $lastMonthDeliveries = getDeliveriesByAgentAndLastMonth($agentId);
    $totalEarnedLastMonth = $lastMonthDeliveries['total_amount'];

    response(['nbrsTotalDeliveries' => $nbrsTotalDeliveries, 'totalAmount' => $totalAmount, 'lastMonthDeliveries' => $lastMonthDeliveries['deliveries'], 'totalEarnedLastMonth' => $totalEarnedLastMonth], 200);
}
// get pending deliveries
function getPendingDeliveriesByAgent($agentId) {
    //id is alphaNumeric , clean id
    $agentId = sanitizeInput($agentId);
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM deliveries WHERE status = 'pending' AND id_agent = :agent_id");
    $stmt->execute([':agent_id' => $agentId]);
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        response(['orders' => [], 'nbrs' => 0], 200);
    }
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['nbrs' => $nbrs, 'deliveries' => $deliveries]);
}
// get pending deliveries being processed
function getProcessingDeliveriesByAgent(){
    //verify the user role
    $user = getBearerToken();
    $role = $user->role;
    if($role !== 'agent' && $role !== 'manager' && $role !== 'SUPER-ADMIN'){
        response(['error' => 'Unauthorized access'], 403);
    }
    //get productName, qnt , get orderid, university, room, product price, id_user
    //id is alphaNumeric , clean id
   
    $agentId = sanitizeInput($user->sub);
    global $connection;
    $stmt = 'SELECT deliveries.id as delivery_id, products.name as product_name, delivery_price, orders.price as order_price, orders.qnt, orders.order_id, university.name, salle_name FROM deliveries JOIN orders ON id_commande = orders.order_id
     JOIN  products ON products.id = orders.id_product JOIN salle ON salle.id = adresse_id JOIN university ON salle.id_university = university.id WHERE deliveries.status = "processing" AND 
    deliveries.id_agent = ?';
    $stmt = $connection->prepare($stmt);
    $stmt->execute([$agentId]);
    $nbrs = $stmt->rowCount();
    if($nbrs == 0){
        response(['orders' => [], 'nbrs' => 0], 200);
    }
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['deliveries' => $deliveries, 'nbrs' => $nbrs], 200);
}

// Helper function: Get user_id from order_id (pour les notifications sécurisées)
function getUserIdFromOrderId($orderId) {
    $orderId = sanitizeInput($orderId);
    global $connection;
    $stmt = $connection->prepare("SELECT id_user FROM orders WHERE order_id = :order_id LIMIT 1");
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
    
    if ($stmt->rowCount() === 0) {
        return null; // Order not found
    }
    
    return $stmt->fetchColumn(); // Return user_id
}

// get deliveries grouped by month by id_university
function getDeliveriesByMonthAndUniversity($universityId, $date = null) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    if($date !== null){
        $date = sanitizeInput($date);
        $date = date('Y-m', strtotime($date));       
    } 
    global $connection;
    if($date === null){
        $sql = "GROUP BY o.order_id ORDER BY d.date DESC LIMIT 6";
    }else {
        $sql = "AND DATE_FORMAT(d.date, '%Y-%m') = '".$date."'";
    }
    $stmt = "
        SELECT d.*, u.name as university_name, SUM(o.price * o.qnt) as total_amount
        FROM deliveries d
        JOIN orders o ON d.id_commande = o.order_id
        JOIN salle s ON o.adresse_id = s.id
        JOIN university u ON s.id_university = u.id
        WHERE u.id = :university_id 
    ";
    $stmt.= $sql;
    $stmt = $connection->prepare($stmt);
    $stmt->bindParam(':university_id', $universityId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'deliveries' => []];
    }
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'deliveries' => $deliveries];
}

// get daily deliveries by id_university
function getDailyDeliveriesByUniversity($universityId, $date = null) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    $day = date('Y-m-d');
    if($date !== null){
        $day = sanitizeInput($date);
        $day = date('Y-m-d', strtotime($day));       
    }
    global $connection;
    $stmt = $connection->prepare("
        SELECT d.*, u.name as university_name, SUM(o.price * o.qnt) as total_amount, 
        COUNT(d.id) as total_deliveries
        FROM deliveries d
        JOIN orders o ON d.id_commande = o.order_id
        JOIN salle s ON o.adresse_id = s.id
        JOIN university u ON s.id_university = u.id
        WHERE u.id = :university_id AND DATE(d.date) = :day GROUP BY DATE(d.date) ORDER BY d.date DESC
    ");

    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':day', $day);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'deliveries' => []];
    }
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'deliveries' => $deliveries];
}
//top customers by university id
function getTopCustomersByUniversity($universityId, $limit = 5) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0 || intval($limit) <= 0) {
        response(['error' => 'Invalid university ID or limit'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("
        SELECT u.id, u.name, u.email, COUNT(d.id) as total_deliveries, SUM(o.price * o.qnt) as total_spent, MAX(d.date) as last_order_date
        FROM users u
        JOIN orders o ON u.id_unique = o.id_user
        JOIN salle s ON o.adresse_id = s.id
        JOIN deliveries d ON o.order_id = d.id_commande
        WHERE s.id_university = :university_id
        GROUP BY u.id
        ORDER BY total_spent DESC
        LIMIT :limit
    ");
    $stmt->bindParam(':university_id', $universityId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'customers' => []];
    }
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'customers' => $customers];
}

//get all deliveries by month
function getAllDeliveriesByMonth($month = null) {
    // sanitize month input
    if($month === null){
        $month = date('Y-m');
    }
    $month = sanitizeInput($month);
    global $connection;
    $stmt = $connection->prepare("
        SELECT SUM(d.delivery_price) as total_amount 
        FROM deliveries d
        WHERE DATE_FORMAT(d.date, '%Y-%m') = :month 
        ORDER BY total_amount DESC
    ");
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'deliveries' => []];
    }
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'deliveries' => $deliveries];
}

//get user deliveries datas
// get total deliveries
// get total completed delivery
// get total processing
  
function getUserDeliDatas(){ 
    $accessToken = getBearerToken();
    $userId = $accessToken->sub; 
    //verify datas  
    if(empty($userId)){
        response(['error' => 'Invalid user ID'], 400);
    }
    $userId = sanitizeInput($userId);
    global $connection;
    $stmt = "SELECT d.id_commande, d.note, d.status, d.feedback, p.name as product_name, o.qnt, p.prices, s.salle_name as room_name, u.name as university_name
    FROM deliveries d
    JOIN orders o ON d.id_commande = o.order_id JOIN products p ON o.id_product = p.id JOIN salle s ON o.adresse_id = s.id JOIN university u ON s.id_university = u.id
    WHERE o.id_user = :user_id ";
    $stmt = $connection->prepare($stmt);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($stmt->rowCount() === 0){
        response(['total_delivery' => 0, 'processing_delivery' => 0, 'completed_delivery' => 0], 200);
    }
    // calcul total spent
    $stmt = "SELECT SUM(o.qnt * o.price) as total_order_amount, SUM(d.delivery_price) as total_amount FROM deliveries d
    JOIN orders o ON d.id_commande = o.order_id
    WHERE o.id_user = :user_id ";
    $stmt = $connection->prepare($stmt);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $totalAmounts = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalSpent = $totalAmounts['total_order_amount'] - $totalAmounts['total_amount'];
    response(['datas' => $datas, 'totalAmounts' => $totalAmounts, 'totalSpent' => $totalSpent], 200);
} 
