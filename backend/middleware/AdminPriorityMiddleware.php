<?php
class AdminPriorityMiddleware implements MiddlewareInterface {
    private $jwtHandler;

    public function __construct() {
        $this->jwtHandler = new JWTHandler(); // Initialize JWT Handler
    }

    public function handle($request, $next) {
        // Check for authorization header
        $headers = apache_request_headers();
        $authHeader = $headers['Authorization'] ?? '';
    
        if (empty($authHeader)) {
            header("HTTP/1.1 403 Forbidden");
            echo json_encode(['message' => 'Authorization token required.']);
            exit();
        }
        
        if (strpos($authHeader, 'Bearer ') === 0) {
            $token = str_replace('Bearer ', '', $authHeader);
      
            try {
                $decodedToken = $this->jwtHandler->decodeToken($token);
                
                // Debugging output
                //error_log("Decoded Token: " . print_r($decodedToken, true));
                
                if (is_null($decodedToken) || !isset($decodedToken->sub)) {
                    throw new Exception("Token structure is invalid");
                }
                
                $userId = $decodedToken->sub; // Assuming token contains user ID in 'sub' property

                // error_log($userId);
                // error_log($_GET['id']);
                
                // Fetch user data to check is_main_priority
                $db = (new Database())->getConnection();
                $stmt = $db->prepare("SELECT is_main_priority FROM users WHERE id = :id");
                $stmt->bindParam(':id', $userId);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user || $user['is_main_priority'] !== 1) {
                    $_POST['allow_publish'] = 0;
                }

                if  ($user['is_main_priority'] !== 1 &&( isset($_POST['id'] ) || isset($_GET['id']))) {
                    header("HTTP/1.1 403 Forbidden");
                    echo json_encode(['message' => 'You do not have sufficient permissions11.']);
                    exit();
                }

                

                
                
                // Proceed to the next middleware or handler
                return $next($request);
                
            } catch (Exception $e) {
                error_log("Exception: " . $e->getMessage());
                header("HTTP/1.1 401 Unauthorized");
                echo json_encode(['message' => 'Invalid token or Exception on server']);
                exit();
            }
        } else {
            header("HTTP/1.1 403 Forbidden");
            echo json_encode(['message' => 'Authorization token required.']);
            exit();
        }
    }
}
?>
