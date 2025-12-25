<?php

$routes =  [
    'GET' => [
        '/products' => ['services/product.php', 'getAllProducts'],  //get all products
        '/products/(\d+)' => ['services/product.php', 'getProductByUniversityId'], //get product by university id
        '/categories' => ['services/categories.php', 'allCategories'], // get all categories
        '/categories/(\d+)' => ['services/categories.php', 'getCategoryById'], //get category by id
        '/users' => ['controllers/users.php', 'getAllUsers'],   //get all users
        '/users/datas' => ['controllers/users.php', 'getUserDatas'], //get user personal datas
        '/users/(\d+)' => ['controllers/users.php', 'getUserById'], //get user by id
        '/orders' => ['services/orders.php', 'getAllOrders'], //get all orders
        '/orders/(\d+)' => ['services/orders.php', 'getOrderById'], //get order by id
        '/universities' => ['services/universities.php', 'All_universities'], // get all universities
        '/universities/(\d+)' => ['services/universities.php', 'getUniversityById'], //get university by id
        '/places/adm/(\d+)' => ['services/places.php', 'getPlacesByUniversityId'],
        '/places/(\d+)' => ['services/places.php', 'getPlacesByUniversityId'], //get places by university id
        '/agent/code' => ['agents/agents.php', 'getAgentCode'], //get agent code
        '/agents/availability' => ['agents/agents.php', 'getAgentAvailability'], //get agentAvailability status
        '/deliveries/agent' => ['services/deliveries.php', 'getAgentStats'], //get deliveries by agent id
        '/orders/available' => ['services/orders.php', 'getPendingOrderData'], //get datas from availables orders
        '/deliveries/user' => ['services/deliveries.php', 'getUserDeliDatas'], //get deliveries by user id
        '/deliveries/agent/orderProcess' => ['services/deliveries.php', 'getProcessingDeliveriesByAgent'], //get processing datas deliveries by agent id
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
        '/category/adm' => ['Adm/adm.php', 'allCategories'], // get all categories from admin-manager
        '/notifications/([\w]+)' => ['services/notifications.php', 'getNotificationsByUserId'], //get notifications by type unread or all
        '/blog/all' => ['services/blog.php', 'getAllBlogData'], //get all blog data
    ],
    'POST' => [
        '/heartbeat' => ['controllers/users.php', 'heartbeat'], //heartbeat to refresh access token
        '/new/product/adm' => ['Adm/adm.php', 'createProduct'], //create product
        '/orders/assign' => ['services/deliveries.php', 'createDelivery'], //assign order to agent
        '/category/adm' => ['Adm/adm.php', 'createCategory'], //create category
        '/users' => ['controllers/users.php', 'createUser'],   //create user
        '/verify-otp' => ['controllers/verify-otp.php', 'verifyOtp'], //verify OTP
        '/resend-otp' => ['controllers/resend-otp.php', 'resendOtp'], //resend OTP
        '/orders' => ['services/orders.php', 'createOrder'], //create order
        '/notifications' => ['services/notifications.php', 'createNotification'], //create
        '/places/adm/(\d+)' => ['Adm/adm.php', 'createPlace'], //create place
        '/university/super' => ['Adm/main_adm.php', 'createUniversity'], //create university from super admin
        '/category/super' => ['adm/main_adm.php', 'createCategory'], //create category from super admin
        '/places/image-update/adm/(\d+)' => ['Adm/adm.php', 'updatePlaceImage'], //update place image from admin
        '/products/image-update/adm/(\d+)' => ['Adm/adm.php', 'updateProductImage'], //update product image from admin
        '/university/image-update/(\w+)' => ['Adm/main_adm.php', 'update_image_uvs'], //update university image from admin
        '/support/create' => ['controllers/users.php', 'askForSupport'], //create support ticket for adm managers froms users
        '/blog/new' => ['services/blog.php', 'newBlogData'], //create new blog data
        '/orders/refund' => ['services/orders.php', 'requestRefund'], //request refund for cancelled order
    ],
    'PUT' => [
        '/agents/availability' => ['agents/agents.php', 'setAgentAvailability'], //update agent availability
        '/product/adm/(\d+)' => ['Adm/adm.php', 'updateProduct'], //update product , for admin
        '/category/adm' => ['Adm/adm.php', 'updateCategory'], //update category , for admin
        '/products/availability' => ['Adm/adm.php', 'setProductAvailability'], //set product available or unavailable, for admin
        '/categories/adm' => ['Adm/adm.php', 'updateCategory'], //set category available or unavailable, for admin
        '/notifications/status' => ['services/notifications.php', 'markNotificationAsRead'], //mark notification as read, for admin
        '/places/adm/(\d+)' => ['Adm/adm.php', 'modifyPlace'], //update place , for admin
        '/users/update' => ['controllers/users.php', 'updateUser'],   //update user, for dashboard
        '/user/role' => ['Adm/adm.php', 'setUserAgent'], //set user role, for admin
        '/users/status' => ['Adm/adm.php', 'updateUserStatus'], //set user status, for admin
        '/users/verify' => ['Adm/adm.php', 'setUserVerifiedStatus'], //verify user account, for admin
        '/university/super/(\d+)' => ['Adm/main_adm.php', 'updateUniversity'], //update university from super admin
        '/category/super' => ['Adm/main_adm.php', 'updateCategory'], // update category from super admin
        '/setAdm/(\w+)' => ['Adm/main_adm.php', 'setUserAdm'], //assign admin role to user for university by super admin
        '/setAgent/(\w+)' => ['Adm/adm.php', 'setUserAgent'], //assign agent role to user for university by super admin
        '/setUser/(\w+)' => ['Adm/adm.php', 'setUserClient'], //assign user role to user for university by super admin
        '/delivery/status/(\d+)' => ['services/deliveries.php', 'updateDeliveryStatus'], //update delivery status by agent set it done
        '/logout' => ['services/logout.php', 'logout'], //logout function for all users
        '/rate/agent' => ['services/deliveries.php', 'rateAgent'], //rate agent after delivery
        '/orders/cancel' => ['services/orders.php', 'cancelOrder'], //cancel order by user 
        '/orders/reactivate' => ['services/orders.php', 'reactivateOrder'], //reactivate cancelled order
    ],
    'DELETE' => [
        '/category/super/(\d+)' => ['Adm/main_adm.php', 'deleteCategory'], // delete category from super admin
        '/product/adm' => ['Adm/adm.php','deleteProduct'], //delete product , for admin
        '/places/adm/(\d+)' => ['Adm/adm.php', 'deletePlace'], //delete place , for admin
        '/university/super/(\d+)' => ['Adm/main_adm.php', 'deleteUniversity'], //delete university from super admin
        '/notifications/(\d+)' => ['services/notifications.php', 'deleteNotification'], //delete notification
    ]
]; 
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$oldPath = $path;

// Détecter automatiquement le base path
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
if ($scriptName !== '/') {
    $path = substr($path, strlen($scriptName));
}

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
    response(['error' => 'Endpoint not found: ' . $path . ' Method: ' . $method. ' Route: ' . $oldPath. ' base: ' . $scriptName], 404);
}