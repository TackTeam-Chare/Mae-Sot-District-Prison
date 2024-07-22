<?php

use Firebase\JWT\JWT;

require_once '../backend/vendor/autoload.php'; // Ensure Composer autoload is included

// Middleware
require_once '../backend/middleware/MiddlewareInterface.php';
require_once '../backend/middleware/MiddlewareStack.php';
require_once '../backend/middleware/CORSMiddleware.php';
require_once '../backend/middleware/JWTMiddleware.php';
require_once '../backend/middleware/AdminPriorityMiddleware.php';

// Database
require_once '../backend/config/database.php';

// Controllers
require_once '../backend/controllers/UserController.php';
require_once '../backend/controllers/AuthController.php';
require_once '../backend/controllers/RegisterController.php';
require_once '../backend/controllers/EventController.php';
require_once '../backend/controllers/ProductController.php';
require_once '../backend/controllers/AdminController.php';
require_once '../backend/controllers/ScreenContentController.php';
require_once '../backend/controllers/VisitingRuleController.php';
require_once '../backend/utils/Response.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize controllers
$userController = new UserController($db);
$authController = new AuthController($db);
$registerController = new RegisterController($db);
$eventController = new EventController($db);
$productController = new ProductController($db);
$adminController = new AdminController($db);
$screenController = new ScreenContentController($db);
$visitingRule = new VisitingRuleController($db);

// Initialize middleware stack
$middlewareStack = new MiddlewareStack();
$middlewareStack->addMiddleware(new CORSMiddleware()); // Always apply CORS middleware

// Define the final handler
$finalHandler = function ($request) use (
    $userController,
    $authController,
    $registerController,
    $eventController,
    $productController,
    $adminController,
    $screenController,
    $visitingRule
) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    // Determine the action based on URI and HTTP method
    switch ($uri[1]) {
            //route for user 
        case 'viewEvents':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $eventController->getEventsWithID();
            } elseif ($requestMethod == 'GET') {
                return $eventController->getEvents();
            }
            break;

        case 'viewProducts':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $productController->getProductWithID();
            } elseif ($requestMethod == 'GET') {
                return $productController->getProducts();
            }
            break;

        case 'viewVisiting_rules':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $visitingRule->getVisitingRulesWithID();
            } elseif ($requestMethod == 'GET') {
                return $visitingRule->getVisitingRules();
            }
            break;

        case 'viewScreen_contents':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $screenController->getScreenContentsWithID();
            } elseif ($requestMethod == 'GET') {
                return $screenController->getScreenContents();
            }
            break;

            //route for admin management include for CMS system

        case 'users':
            if ($requestMethod == 'GET') {
                $users = $userController->getUsers();
                return json_encode($users);
            }
            break;

        case 'login':
            if ($requestMethod == 'POST') {
                return $authController->login();
            }
            break;

        case 'logout':
            if ($requestMethod == 'POST') {
                return $authController->logout();
            }
            break;

            // case 'register':
            //     if ($requestMethod == 'POST') {
            //         return $registerController->register();
            //     }
            //     break;

        case 'event_delete':
            if ($requestMethod == 'GET') {
                return $eventController->deleteEvent();
            }
            break;

        case 'stuffview_events':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $eventController->getEventsWithID();
            } elseif ($requestMethod == 'GET') {
                return $eventController->getEvents();
            }
            break;


        case 'events':
            if ($requestMethod == 'POST' && isset($_POST['id'])) {
                return $eventController->updateEvent();
            } elseif ($requestMethod == 'POST') {
                return $eventController->createEvent();
            }
            break;

        case 'events_sum':
            if ($requestMethod == 'GET') {
                return $eventController->getEventsSum();
            }
            break;

        case 'products_sum':
            if ($requestMethod == 'GET') {
                return $productController->getProductsSum();
            }
            break;


        case 'product_delete':
            if ($requestMethod == 'GET') {
                return $productController->deleteProduct();
            }
            break;

        case 'stuffview_products':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $productController->getProductWithID();
            } elseif ($requestMethod == 'GET') {
                return $productController->getProducts();
            }
            break;

        case 'products':
            if ($requestMethod == 'POST' && isset($_POST['id'])) {
                return $productController->updateProduct();
            } elseif ($requestMethod == 'POST') {
                return $productController->createProduct();
            }
            break;



        case 'stuffview_admins':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $adminController->getAdminWithID();
            } elseif ($requestMethod == 'GET') {
                return $adminController->getAdmin();
            }
            break;


        case 'admin_delete':
            if ($requestMethod == 'GET') {
                return $adminController->deleteAdmin();
            }
            break;


        case 'admins':
            if ($requestMethod == 'PUT') {
                return $adminController->updateAdmin();
            } elseif ($requestMethod == 'POST') {
                return $adminController->createAdmin();
            }
            break;

        case 'screen_content_delete':
            if ($requestMethod == 'GET') {
                return $screenController->deleteScreenContent();
            }
            break;

        case 'stuffview_screen_contents':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $screenController->getScreenContentsWithID();
            } elseif ($requestMethod == 'GET') {
                return $screenController->getScreenContents();
            }
            break;


        case 'screen_contents':
            if ($requestMethod == 'POST' && isset($_POST['id'])) {
                return $screenController->updateScreenContent();
            } elseif ($requestMethod == 'POST') {
                return $screenController->createScreenContent();
            }
            break;

        case 'visiting_rule_delete':
            if ($requestMethod == 'GET') {
                return $visitingRule->deleteVisitingRule();
            }
            break;

        case 'stuffview_visiting_rules':
            if ($requestMethod == 'GET' && isset($_GET['id'])) {
                return $visitingRule->getVisitingRulesWithID();
            } elseif ($requestMethod == 'GET') {
                return $visitingRule->getVisitingRules();
            }
            break;

        case 'visiting_rules':
            if ($requestMethod == 'POST' && isset($_POST['id'])) {
                return $visitingRule->updateVisitingRule();
            } elseif ($requestMethod == 'POST') {
                return $visitingRule->createVisitingRule();
            }
            break;
        default:
            header("HTTP/1.1 404 Not Found");
            exit();
    }
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
};

// Apply JWTMiddleware where needed
$routesWithAuth = [
    'logout',
    'event_delete',
    'events',
    'product_delete',
    'products',
    'admin_delete',
    'admins',
    'screen_content_delete',
    'screen_contents',
    'visiting_rule_delete',
    'visiting_rules',
    'stuffview_events',
    'stuffview_products',
    'stuffview_screen_contents',
    'stuffview_visiting_rules',
    'stuffview_admins',
];

$onlyMainPriorityRoot = [
    'event_delete',
    'events',

    'product_delete',
    'products',
    
    'admin_delete',
    'admins',
    
    'screen_content_delete',
    'screen_contents',
    
    'visiting_rule_delete',
    'visiting_rules'
];


$request = $_POST; // Or use a more appropriate method for handling request data

if (in_array(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1], $routesWithAuth)) {
    $middlewareStack->addMiddleware(new JWTMiddleware()); // Apply JWT middleware
}
if (in_array(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1], $onlyMainPriorityRoot)) {
    $middlewareStack->addMiddleware(new AdminPriorityMiddleware()); // Apply JWT middleware
}

$response = $middlewareStack->handle($request, $finalHandler);

// Output the response
echo $response;
