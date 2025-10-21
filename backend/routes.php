<?php

$routes =  [
    'GET' => [
        '/products' => ['services/product.php', 'getAllProducts'],  //get all products
        '/products/(\d+)' => ['services/product.php', 'getProductByUniversityId'], //get product by university id
        '/categories' => ['services/categories.php', 'getAllCategories'], // get all categories
        '/categories/(\d+)' => ['services/categories.php', 'getCategoryById'], //get category by id
        '/users' => ['controllers/users.php', 'getAllUsers'],   //get all users
        '/users/(\d+)' => ['controllers/users.php', 'getUserById'], //get user by id
        '/orders' => ['services/orders.php', 'getAllOrders'], //get all orders
        '/orders/(\d+)' => ['services/orders.php', 'getOrderById'], //get order by id
        '/universities' => ['services/universities.php', 'getAllUniversities'], // get all universities
        '/universities/(\d+)' => ['services/universities.php', 'getUniversityById'], //get university by id
        '/places/(\d+)' => ['services/places.php', 'getPlacesByUniversityId'], //get places by university id
        '/agents/availability/(\w+)' => ['agents/agents.php', 'getAgentAvailability'], //get agentAvailability status
        '/deliveries/agent/(\w+)' => ['services/deliveries.php', 'getAgentStats'], //get deliveries by agent id
        '/orders/available' => ['services/orders.php', 'getPendingOrderData'], //get datas from availables orders
        '/deliveries/agent/orderProcess/(\w+)' => ['services/deliveries.php', 'getProcessingDeliveriesByAgent'], //get processing datas deliveries by agent id
        '/dashboard/adm/(\d+)' => ['Adm/adm.php', 'getDashboardStatsByUniversity'], //get dashboard stats by university id
        '/users/adm' => ['Adm/adm.php', 'getAllUsersAdm'], //get all users for admin with pagination and search
        '/users/adm/page/(\d+)/(\w+)' => ['Adm/adm.php', 'getAllUsersAdm'], //get all users for admin with pagination and search (page and search in path)
        '/products/adm/(\d+)' => ['Adm/adm.php', 'productsDataByUniversityId'], //get products by university id for admin
        '/products/adm/page/(\d+)/(\w+)' => ['Adm/adm.php', 'productsDataByUniversityId'], //get products by university id for admin with pagination and search
        '/orders/adm/(\d+)' => ['Adm/adm.php', 'ordersDataByUniversityId'], //get orders by university id for admin
        '/orders/adm/page/(\d+)/(\w+)' => ['Adm/adm.php', 'ordersDataByUniversityId'], //get orders by university id for admin with pagination and search
        '/agents/adm/(\d+)' => ['Adm/adm.php', 'agentsDataAdm'], //get agents by university id for admin with pagination and search
        '/agents/adm/page/(\d+)/(\w+)' => ['Adm/adm.php', 'agentsDataAdm'], //get agents by university id for admin with pagination and search
        '/analytics/adm/(\d+)' => ['Adm/adm.php', 'analyticsDataAdm'], //get all universities for admin with pagination and search
        '/analytics/adm/page/(\d+)/([\w\-\.]+)' => ['Adm/adm.php', 'analyticsDataAdm'], //get analytics for admin with pagination and optional search (dates allowed)
        '/dashboard/super' => ['Adm/main_adm.php', 'getDashboardStats'], //get dashboard stats for super admin
        '/dashboard/super/([\w\-\.]+)' => ['Adm/main_adm.php', 'getDashboardStats'], //get dashboard stats for super admin
        '/analytics/super/([\w\-\.]+)' => ['Adm/main_adm.php', 'analyticsDataSuper'], //get analytics for super admin with optional search (dates allowed)
        '/analytics/super' => ['Adm/main_adm.php', 'analyticsDataSuper'], //get analytics for super admin with optional search (dates allowed)
        '/university/super' => ['Adm/main_adm.php', 'allUniversities'], // get universities from super admin
        '/category/super' => ['Adm/main_adm.php', 'allCategories'], // get all categories from super admin
    ],
    'POST' => [
        '/products' => ['adm/adm.php', 'createProduct'], //create product
        '/categories' => ['adm/adm.php', 'createCategory'], //create category
        '/users' => ['controllers/users.php', 'createUser'],   //create user
        '/verify-otp' => ['controllers/verify-otp.php', 'verifyOtp'], //verify OTP
        '/resend-otp' => ['controllers/resend-otp.php', 'resendOtp'], //resend OTP
        '/orders' => ['services/orders.php', 'createOrder'], //create order
        '/notifications' => ['services/notifications.php', 'createNotification'], //create  
        '/places' => ['adm/adm.php', 'createPlace'], //create place
        '/university/super' => ['Adm/main_adm.php', 'createUniversity'], //create university from super admin
        '/category/super' => ['adm/main_adm.php', 'createCategory'], //create category from super admin


    ],
    'PUT' => [
        '/agents/availability' => ['agents/agents.php', 'setAgentAvailability'], //update agent availability
        '/products' => ['adm/adm.php', 'updateProduct'], //update product , for admin
        '/categories' => ['adm/adm.php', 'updateCategory'], //update category , for admin
        '/products/availability' => ['adm/adm.php', 'setProductAvailability'], //set product available or unavailable, for admin
        '/categories' => ['adm/adm.php', 'updateCategory'], //set category available or unavailable, for admin
        '/notifications/status' => ['adm/adm.php', 'markNotificationAsRead'], //mark notification as read, for admin
        '/places' => ['adm/adm.php', 'updatePlace'], //update place , for admin
        '/users' => ['controllers/users.php', 'updateUser'],   //update user, for admin
        '/user/role' => ['adm/adm.php', 'setUserRole'], //set user role, for admin
        '/users/status' => ['adm/adm.php', 'updateUserStatus'], //set user status, for admin
        '/users/verify' => ['adm/adm.php', 'setUserVerifiedStatus'], //verify user account, for admin
        '/university/super' => ['Adm/main_adm.php', 'updateUniversity'], //update university from super admin
        '/category/super' => ['adm/main_adm.php', 'updateCategory'], // update category from super admin
    ],
    'DELETE' => [
        '/category/super' => ['adm/main_adm', 'deleteCategory'], // delete category from super admin
        
    ],
]; 
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$oldPath = $path;
$path = str_replace('/kodpwomo/backend', '', $path);
if($path !== '/' && substr($path, -1) === '/') {
    $path = rtrim($path, '/');
}
$controllerRequest = false;
if (isset($routes[$method])) {
    foreach ($routes[$method] as $pattern => $controllerAction){
        $regex = '#^' .$pattern. '$#';
        if (preg_match($regex, $path, $matches)) {
            $controllerRequest = true;
            array_shift($matches);
            require $controllerAction[0];
            call_user_func_array($controllerAction[1], $matches);
            break;
        }

    }
    
}
if ($controllerRequest !== true) {
    response(['error' => 'Endpoint not found: ' . $path . ' Method: ' . $method. ' Route: ' . $oldPath], 404);
}