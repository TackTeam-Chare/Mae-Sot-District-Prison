<?php
header("Access-Control-Allow-Origin:*"); // Allow any origin
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Allow these methods
header("Access-Control-Allow-Headers: Content-Type,X-Auth-token, Authorization"); // Allow these headers
header("Content-Type: application/json"); // Ensure Content-Type is JSON for responses

require_once './utils/Response.php';
require_once './config/database.php';
require_once './controllers/UserController.php';
require_once './controllers/AuthController.php';
require_once './controllers/RegisterController.php';
require_once './controllers/EventController.php';
require_once './controllers/ProductController.php';
require_once './controllers/AdminController.php';
require_once './controllers/ScreenContentController.php';
require_once './controllers/VisitingRuleController.php';


$database = new Database();
$db = $database->getConnection();
$userController = new UserController($db);
$authController = new AuthController($db);
$registerController = new RegisterController($db);
$eventController = new EventController($db);
$productController = new ProductController($db);
$adminController = new AdminController($db);
$screenController = new ScreenContentController($db);
$visitingRule = new VisitingRuleController($db); 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] == 'users') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET') {
        $users = $userController->getUsers();
        echo json_encode($users);
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
} 

// authentication routes

elseif ($uri[1] == 'login') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'POST') {
        $authController->login();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
} elseif ($uri[1] == 'register') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'POST') {
        $registerController->register();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
}


//events routes

elseif($uri[1] == 'event_delete'){
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if($requestMethod=='GET')
        $eventController->deleteEvent();
    
}elseif ($uri[1] == 'events') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET' and isset($_GET['id'])) {
        $eventController->getEventsWithID();
    }elseif($requestMethod=='GET' ){
        $eventController->getEvents();
    } elseif ($requestMethod == 'POST' and isset($_POST['id']))  {
        $eventController->updateEvent();
    } elseif ($requestMethod == 'POST' ) {
        $eventController->createEvent();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
    
}

//product routes

elseif($uri[1] == 'product_delete'){
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if($requestMethod=='GET')
    $productController->deleteProduct();
    
}elseif ($uri[1] == 'products') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET' and isset($_GET['id'])) {
        $productController->getProductWithID();
    }elseif($requestMethod=='GET' ){
        $productController->getProducts();
    } elseif ($requestMethod == 'POST' and isset($_POST['id']))  {
        $productController->updateProduct();
    } elseif ($requestMethod == 'POST' ) {
        $productController->createProduct();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
    
}
//admin user routes

elseif($uri[1] == 'admin_delete'){
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if($requestMethod=='GET')
    $adminController->deleteAdmin();
    
}elseif ($uri[1] == 'admins') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET' and isset($_GET['id'])) {
        $adminController->getAdminWithID();
    }elseif($requestMethod=='GET' ){
        $adminController->getAdmin();
    } elseif ($requestMethod == 'POST' and isset($_POST['id']))  {
        $adminController->updateAdmin();
    } elseif ($requestMethod == 'POST' ) {
        $registerController->register();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
    
}

//screen content routes

elseif($uri[1] == 'screen_content_delete'){
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if($requestMethod=='GET')
    $screenController->deleteScreenContent();
    
}elseif ($uri[1] == 'screen_contents') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET' and isset($_GET['id'])) {
        $screenController->getScreenContentsWithID();
    }elseif($requestMethod=='GET' ){
        $screenController->getScreenContents();
    } elseif ($requestMethod == 'POST' and isset($_POST['id']))  {
        $screenController->updateScreenContent();
    } elseif ($requestMethod == 'POST' ) {
        $screenController->createScreenContent();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
    
}

//screen content routes

elseif($uri[1] == 'visiting_rule_delete'){
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if($requestMethod=='GET')
    $visitingRule->deleteVisitingRule();   
}elseif($uri[1] == 'visiting_rules') {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == 'GET' and isset($_GET['id'])) {
        $visitingRule->getVisitingRulesWithID();
    }elseif($requestMethod=='GET' ){
        $visitingRule->getVisitingRules();
    } elseif ($requestMethod == 'POST' and isset($_POST['id']))  {
        $visitingRule->updateVisitingRule();
    } elseif ($requestMethod == 'POST' ) {
        $visitingRule->createVisitingRule();
    } else {
        header("HTTP/1.1 405 Method Not Allowed");
        exit();
    }
}else {
    header("HTTP/1.1 404 Not Found");
    exit();
}
