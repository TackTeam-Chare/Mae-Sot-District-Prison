<?php

class JWTMiddleware implements MiddlewareInterface {
    private $jwtHandler;

    public function __construct() {
        $this->jwtHandler = new JWTHandler(); // Initialize JWT Handler
    }

    public function handle($request, $next) {
        // Check if the request requires authorization
        // Here you would check for an authorization header and validate it
        // If the user is not authorized, send a 403 response
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
                $this->jwtHandler->verifyToken($token);
                return $next($request);
            } catch (Exception $e) {
                header("HTTP/1.1 401 Unauthorized jwt");
                echo json_encode(['message' => 'Invalid token or Exceptions on server']);
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
