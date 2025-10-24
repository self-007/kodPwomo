<?php
// KodPwomo Backend Integration
require_once __DIR__.'/adm.php';
// this is the super powerfull admin

//get the main dashboard 
// Maintenant vous pouvez utiliser toutes les fonctions de vos backends :
// - getAllOrders(), createOrder(), getOrderById() de orders.php
// - createUser(), authenticateUser() de users.php  
// - createDelivery(), updateDeliveryStatus() de deliveries.php
// - sanitizeInput(), response() de helpers.php
// - Toutes les autres fonctions de vos services
// create functions for admins pages

//dashboard stats
function getDashboardStats($month = null) {
    // get total users
    // get total products 
    // get total orders   
    // get total month amount 
    // get the admin name 
    //total universities
    if($month !== null){
        $month = sanitizeInput($month);
    }
    $totalUsers = getAllUsers()['total'];
    $Products = getAllProducts()['total'];
    $Orders = getAllOrders()['nbrs'];
    $monthRevenue = getAllDeliveriesByMonth($month);
    $university = getAllUniversities()['nbrs'];
    $places = getAllPlaces()['nbrs'];
    $notifications = getAllNotificationsAdm()['nbrs'];
    $money = getAllOrders()['money'];
    
    response([
        'totalUsers' => $totalUsers,
        'Products' => $Products,
        'Orders' => $Orders,
        'monthStats' => $monthRevenue,
        'university' => $university,
        'places' => $places,
        'notifications' => $notifications,
        'money' => $money
        
    ], 200);
}

//get analytics data for admin dashboard
function analyticsDataSuper($search = ''){
    // search must be a date range
    if(!empty($search)){
        $search = sanitizeInput($search);
    }

    // define a limit 
    $limit = 20;
    
    global $connection;
   // "overview": { "period": "last_30_days", 
   // "total_revenue": 2850000, "total_orders": 486, "avg_order_value": 18500,
   //  "growth": { "revenue": "", "orders": "+%", "customers": "%" } },

    $overview = getAllDeliveriesByMonth($month = null);
    $dailyOrders =  getTotalOrdersByDay();
    $topCustomers = getTopCustomers( $limit = 5);
    $topAgents = getTopGlobalAgents($limit = 5);
    if(!empty($search)){
        $search = sanitizeInput($search);
        $date = date('Y-m-d', strtotime($search));
        $overview = getAllDeliveriesByMonth($date);
        $dailyOrders =  getTotalOrdersByDay();
    }
    response([
        'overview' => $overview,
        'dailyOrders' => $dailyOrders,
        'topCustomers' => $topCustomers,
        'topAgents' => $topAgents
    ], 200);
    
}

//top customers 
function getTopCustomers( $limit = 5) {
    // verify int value or superior to 0
    if (intval($limit) <= 0) {
        response(['error' => 'Invalid limit'], 400);
    }
    global $connection;
    $stmt = $connection->prepare("
        SELECT u.id, u.name, u.email, COUNT(d.id) as total_deliveries, SUM(o.price * o.qnt) as total_spent, MAX(d.date) as last_order_date
        FROM users u
        JOIN orders o ON u.id_unique = o.id_user
        JOIN salle s ON o.adresse_id = s.id
        JOIN deliveries d ON o.order_id = d.id_commande
        GROUP BY u.id
        ORDER BY total_spent DESC
        LIMIT :limit
    ");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $nbrs = $stmt->rowCount();
    if($nbrs === 0){
        return ['nbrs' => 0, 'customers' => []];
    }
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return ['nbrs' => $nbrs, 'customers' => $customers];
}
//get all universities
function allUniversities(){
    $university = getAllUniversities();
    response(['universities' => $university], 200);
}

