<?php
// File: CheckLoginStatusMiddleware.php
require_once '../backend/utils/JWTHandler.php'; // Ensure JWTHandler is included

class CheckLoginStatusMiddleware implements MiddlewareInterface {
    public function handle($request, $next) {
        // Extract token from request headers or parameters
        $token = $request['token'] ?? null;
        
        // Check if token is present and valid
        if ($token) {
            $jwtHandler = new JWTHandler();
            try {
                $decoded = $jwtHandler->decodeToken($token);
                $userId = $decoded->data->id;

                // Check if user has logged in before
                $database = new Database();
                $db = $database->getConnection();
                $query = "SELECT logged_in FROM users WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $userId);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result && $result['logged_in']) {
                    return $next($request); // Continue to the next handler
                } else {
                    header("HTTP/1.1 403 Forbidden");
                    echo json_encode(['message' => 'User has not logged in.']);
                    exit();
                }
            } catch (Exception $e) {
                header("HTTP/1.1 401 Unauthorized");
                echo json_encode(['message' => 'Invalid token check login.']);
                exit();
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(['message' => 'No token provided.']);
            exit();
        }
    }
}
?>
