<?php
// KodPwomo Backend Integration
require_once __DIR__.'/../agents/agents.php';
require_once __DIR__.'/../controllers/users.php';
require_once __DIR__.'/../controllers/verify-otp.php';
require_once __DIR__.'/../controllers/resend-otp.php';
require_once __DIR__.'/../services/orders.php';
require_once __DIR__.'/../services/deliveries.php';
require_once __DIR__.'/../services/product.php';
require_once __DIR__.'/../services/universities.php';
require_once __DIR__.'/../services/categories.php';
require_once __DIR__.'/../services/places.php';
require_once __DIR__.'/../services/notifications.php';
require_once __DIR__.'/../vendor-firebase/autoload.php';


// Maintenant vous pouvez utiliser toutes les fonctions de vos backends :
// - getAllOrders(), createOrder(), getOrderById() de orders.php
// - createUser(), authenticateUser() de users.php  
// - createDelivery(), updateDeliveryStatus() de deliveries.php
// - sanitizeInput(), response() de helpers.php
// - Toutes les autres fonctions de vos services
// create functions for admins pages

//dashboard stats
function getDashboardStatsByUniversity($universityId) {
    // get total users
    // get total products by university
    // get total orders   by university
    // get total month amount by university
    // get the admin name 
    // get university name 
    $totalUsers = getAllUsers()['total'];
    $universityProducts = returnProductByIdUniversity($universityId)['total'];
    $universityOrders = getAllOrdersByUniversityId($universityId)['nbrs'];
    $monthRevenue = getMonthRevenueByUniversityId($universityId);
    $university = getUniversityById($universityId)['name'];
    $orders = getOrdersDataByUniversityId($universityId);
    response([
        'totalUsers' => $totalUsers,
        'universityProducts' => $universityProducts,
        'universityOrders' => $universityOrders,
        'monthRevenue' => $monthRevenue,
        'university' => $university,
        'orders' => $orders
    ], 200);
}
//get month revenue by university id
function getMonthRevenueByUniversityId($universityId) {
    // value is int
    $month = date('Y-m');
    global $connection;
    $stmt = $connection->prepare("
        SELECT SUM(delivery_price) FROM deliveries JOIN orders ON deliveries.id_commande = orders.order_id JOIN Salle ON adresse_id = Salle.id
        JOIN university ON Salle.id_university = university.id
        WHERE DATE_FORMAT(deliveries.date, '%Y-%m') = :month AND university.id = :university_id
    ");
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':month', $month);
    $stmt->execute();
    $result = $stmt->rowCount();
    if($result === 0){
        return 0;
    }
    $total = $stmt->fetchColumn();
    return $total ? $total : 0;
}
// get ordersdata by university id
function getOrdersDataByUniversityId($universityId) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("SELECT products.name as product_name, users.name as user_name, orders.order_id, orders.date, orders.status, orders.qnt, orders.price, salle.salle_name as salle_name FROM products JOIN orders ON orders.id_product = products.id JOIN users ON users.id_unique = orders.id_user JOIN salle ON salle.id = adresse_id WHERE products.id_university = :university_id AND salle.id_university = :university_id");
    $stmt->bindParam(':university_id', $universityId);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return['orders' => [], 'nbrs' => 0];
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['orders' => $orders, 'nbrs' => $nbrs];
    
}
// all users funtion with pagination and search
function getAllUsersAdm($page = 1, $search = ''){
    // define a limit 
    $limit = 20;
    $offset = ($page - 1) * $limit;
    //sanitize search input
    $search = sanitizeInput($search);
    // verify $search is not empty
    global $connection;
    $sql = 'SELECT id_unique, name, email, u.date, u.status, u.role,
    (SELECT COUNT(*) FROM orders o WHERE o.id_user = u.id_unique) AS total_orders,
    (SELECT o.date FROM orders o WHERE o.id_user = u.id_unique ORDER BY o.date DESC LIMIT 1) AS last_date,
    (SELECT un.name FROM orders o JOIN salle ON salle.id = o.adresse_id JOIN university un ON un.id = salle.id_university WHERE o.id_user = u.id_unique ORDER BY o.date DESC LIMIT 1) AS last_university,
    (SELECT SUM(price * qnt) FROM orders o where o.id_user = u.id_unique ) as total_spent FROM users u ';   
    if(!empty($search)){
        $search = sanitizeInput($search);
        $condition = 'WHERE u.name LIKE :search OR u.email LIKE :search LIMIT 20 OFFSET :offset';
        
        $sql .= $condition;
        $stmt = $connection->prepare($sql);
        $likeSearch = "%$search%";
        $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $nbrsUsers = $stmt->rowCount();
        if($nbrsUsers === 0){
            response(['users' => [], 'total' => 0]);
        }
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pagination =[
            'current_page' => $page,
            'per_page' => $limit,
            'total_users' => $nbrsUsers,
            'total_pages' => ceil($nbrsUsers / $limit)
        ];
        response(['users' => $users, 'total' => $nbrsUsers, 'pagination' => $pagination]);

    }

    $condition = 'LIMIT 20 OFFSET :offset';
    $sql .= $condition;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $nbrsUsers = $stmt->rowCount();
    if($nbrsUsers === 0){
        response(['users' => [], 'total' => 0]);
    }
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response(['users' => $users, 'total' => $nbrsUsers]);
}
//get productdatas by university id with pagination and search
function productsDataByUniversityId($universityId, $search = '', $page = 1) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    //sanitize search input
    $search = sanitizeInput($search);
    // define a limit 
    $limit = 20;
    $offset = ($page - 1) * $limit;
    global $connection;
    $sql = "SELECT p.*, c.name AS category_name,
    (SELECT COUNT(*) FROM orders o WHERE o.id_product = p.id) AS total_orders,
    
    (SELECT SUM(o.qnt * o.price) FROM orders o WHERE o.id_product = p.id) AS total_revenue
    FROM products p 
    LEFT JOIN category c ON p.id_category = c.id 
    WHERE p.id_university = :university_id ";
    $querySelect = " SELECT * FROM category ";
    $querySelect = $connection->prepare($querySelect);
    $querySelect->execute();
    $categories = $querySelect->fetchAll(PDO::FETCH_ASSOC);
    // if search is not empty
    if(!empty($search)){
        $search = sanitizeInput($search);
        $condition = 'AND p.name LIKE :search OR p.description LIKE :search LIMIT 20 OFFSET :offset';
        
        $sql .= $condition;
        $stmt = $connection->prepare($sql);
        $likeSearch = "%$search%";
        $stmt->bindParam(':university_id', $universityId);
        $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $nbrsProducts = $stmt->rowCount();
        if($nbrsProducts === 0){
            response(['products' => [], 'total' => 0]);
        }
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pagination =[
            'current_page' => $page,
            'per_page' => $limit,
            'total_products' => $nbrsProducts,
            'total_pages' => ceil($nbrsProducts / $limit)
        ];
        response(['products' => $products, 'total' => $nbrsProducts, 'pagination' => $pagination, 'categories' => $categories]);

    }
    $condition = 'LIMIT 20 OFFSET :offset';
    $sql .= $condition;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $nbrsProducts = $stmt->rowCount();
    if($nbrsProducts === 0){
        response(['products' => [], 'total' => 0]);
    }
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pagination = [
        'current_page' => $page,
        'per_page' => $limit,
        'total_products' => $nbrsProducts,
        'total_pages' => ceil($nbrsProducts / $limit)
    ];
    response(['products' => $products, 'total' => $nbrsProducts, 'pagination' => $pagination, 'categories' => $categories]);
}
//get datas from orders with pagination and search
function ordersDataByUniversityId($universityId, $search = '', $page = 1) {
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    //sanitize search 
    $search = sanitizeInput($search);
    // define a limit 
    $limit = 20;
    $offset = ($page - 1) * $limit;
    global $connection;
    $sql = "SELECT products.name as product_name, users.name as user_name, orders.order_id,
     orders.date, orders.status, orders.qnt, orders.price, salle.salle_name as salle_name, d.id_agent, d.note,
     (SELECT users.name FROM users WHERE users.id_unique = d.id_agent) AS agent_name
     
     FROM products JOIN orders ON orders.id_product = products.id JOIN deliveries d ON d.id_commande = orders.order_id
     JOIN users ON users.id_unique = orders.id_user JOIN salle ON salle.id = adresse_id 
     WHERE products.id_university = :university_id AND salle.id_university = :university_id ";
    // if search is not empty
    if(!empty($search)){
        $search = sanitizeInput($search);
        $condition = 'AND (products.name LIKE :search OR users.name LIKE :search OR orders.order_id LIKE :search OR salle.salle_name LIKE :search) GROUP BY orders.order_id LIMIT 20 OFFSET :offset ';
        
        $sql .= $condition;
        $stmt = $connection->prepare($sql);
        $likeSearch = "%$search%";
        $stmt->bindParam(':university_id', $universityId);
        $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $nbrsOrders = $stmt->rowCount();
        if($nbrsOrders === 0){
            response(['orders' => [], 'total' => 0]);
        }
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pagination =[
            'current_page' => $page,
            'per_page' => $limit,
            'total_orders' => $nbrsOrders,
            'total_pages' => ceil($nbrsOrders / $limit)
        ];
        response(['orders' => $orders, 'total' => $nbrsOrders, 'pagination' => $pagination]);

    }
    $condition = 'LIMIT 20 OFFSET :offset ';
    $sql .= $condition;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $nbrsOrders = $stmt->rowCount();
    if($nbrsOrders === 0){
        response(['orders' => [], 'total' => 0]);
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pagination =[
        'current_page' => $page,
        'per_page' => $limit,
        'total_orders' => $nbrsOrders,
        'total_pages' => ceil($nbrsOrders / $limit)
    ];
    response(['orders' => $orders, 'total' => $nbrsOrders, 'pagination' => $pagination]);
}
//get agents data with pagination and search
function agentsDataAdm($universityId, $search = '', $page = 1){
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    // define a limit 
    $limit = 20;
    $offset = ($page - 1) * $limit;
    global $connection;
    $sql = "SELECT id_unique, u.name, email, u.date, d.status, u.id_university, u.status, u.role, d.id_commande,
    (SELECT COUNT(*) FROM deliveries d WHERE d.id_agent = u.id_unique) AS total_orders,
    (SELECT d.date FROM deliveries d WHERE d.id_agent = u.id_unique LIMIT 1) AS last_date,
    (SELECT COUNT(*) FROM deliveries d WHERE d.id_agent = u.id_unique AND d.status = 'completed') AS total_deliveries,
    (SELECT SUM(delivery_price) FROM deliveries d WHERE d.id_agent = u.id_unique AND d.status = 'completed') AS total_earnings,
    (SELECT SUM(note) FROM deliveries d WHERE d.id_agent = u.id_unique AND d.status = 'completed') / NULLIF((SELECT COUNT(*) FROM deliveries d WHERE d.id_agent = u.id_unique AND d.status = 'completed'), 0) AS average_rating
    FROM users u LEFT JOIN deliveries d ON d.id_agent = u.id_unique WHERE u.id_university = :university_id AND u.role = 'agent' ";
    // if search is not empty
    if(!empty($search)){
        $search = sanitizeInput($search);
        $condition = 'AND (u.name LIKE :search OR d.id_commande LIKE :search ) GROUP BY email LIMIT 20 OFFSET :offset ';

        $sql .= $condition;
        $stmt = $connection->prepare($sql);
        $likeSearch = "%$search%";
        $stmt->bindParam(':university_id', $universityId);
        $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $nbrsAgents = $stmt->rowCount();
        if($nbrsAgents === 0){
            response(['agents' => [], 'total' => 0]);
        }
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pagination =[
            'current_page' => $page,
            'per_page' => $limit,
            'total_orders' => $nbrsAgents,
            'total_pages' => ceil($nbrsAgents / $limit)
        ];
        response(['orders' => $orders, 'total_agents' => $nbrsAgents, 'pagination' => $pagination]);

    }
    $condition = 'GROUP BY email LIMIT 20 OFFSET :offset ';
    $sql .= $condition;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':university_id', $universityId);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $nbrsAgents = $stmt->rowCount();
    if($nbrsAgents === 0){
        response(['agents' => [], 'total' => 0]);
    }
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pagination =[
        'current_page' => $page,
        'per_page' => $limit,
        'total_orders' => $nbrsAgents,
        'total_pages' => ceil($nbrsAgents / $limit)
    ];
    response(['orders' => $orders, 'total_agents' => $nbrsAgents, 'pagination' => $pagination]);
}
//get analytics data for admin dashboard
function analyticsDataAdm($universityId, $search = ''){
    // search must be a date range
    if(!empty($search)){
        $search = sanitizeInput($search);
    }
    // verify int value or superior to 0
    if (intval($universityId) <= 0) {
        response(['error' => 'Invalid university ID'], 400);
    }
    // define a limit 
    $limit = 20;
    
    global $connection;
   // "overview": { "period": "last_30_days", 
   // "total_revenue": 2850000, "total_orders": 486, "avg_order_value": 18500,
   //  "growth": { "revenue": "", "orders": "+%", "customers": "%" } },

    $overview = getDeliveriesByMonthAndUniversity($universityId);
    $dailyOrders =  getDailyDeliveriesByUniversity($universityId);
    $topCustomers = getTopCustomersByUniversity($universityId, $limit = 5);
    $topAgents = getTopAgents($universityId, $limit = 5);
    if(!empty($search)){
        $search = sanitizeInput($search);
        $date = date('Y-m-d', strtotime($search));
        $overview = getDeliveriesByMonthAndUniversity($universityId, $date);
        $dailyOrders =  getDailyDeliveriesByUniversity($universityId, $date);
    }
    response([
        'overview' => $overview,
        'dailyOrders' => $dailyOrders,
        'topCustomers' => $topCustomers,
        'topAgents' => $topAgents
    ], 200);
    
}