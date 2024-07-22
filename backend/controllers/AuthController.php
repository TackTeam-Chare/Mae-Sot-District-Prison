<?php
require "./utils/JWTHandler.php";
class AuthController {
    private $db;
    private $jwtHandler;

    public function __construct($db) {
        $this->db = $db;
        $this->jwtHandler = new JWTHandler(); // Initialize JWT Handler
    }

    public function login() {
        // Get POST data
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate and authenticate user
        $query = "SELECT id, name,password FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Generate JWT token
            $token = $this->jwtHandler->generateToken($user['id'],$user['name']);
            
            // Update logged_in status
            $updateQuery = "UPDATE users SET logged_in = TRUE WHERE id = :id";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(':id', $user['id']);
            $updateStmt->execute();
            
            // Respond with token
            echo json_encode(['token' => $token]);
        } else {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(['message' => 'Invalid username or password.']);
        }
    }

    // public function register() {
    //     // Get POST data
    //     $username = $_POST['username'] ?? '';
    //     $password = $_POST['password'] ?? '';
    //     $email = $_POST['email'] ?? '';

    //     // Hash password
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    //     // Insert user
    //     $query = "INSERT INTO users (email,name, password, logged_in) VALUES (:email,:name, :password, FALSE)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':password', $hashedPassword);
    //     $stmt->bindParam(':email', $email);
        
    //     $stmt->execute();

    //     // Respond with success
    //     echo json_encode(['message' => 'User registered successfully.']);
    // }

    public function logout() {
        // Check for token in headers
        $headers = apache_request_headers();
        $authHeader = $headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $authHeader);

        if (!$token) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['message' => 'No token provided.']);
            exit();
        }

        try {
            // Verify token and get user ID
            $userId = $this->jwtHandler->verifyToken($token);

            // Update logged_in status to FALSE
            $query = "UPDATE users SET logged_in = FALSE WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            // Respond with success
            echo json_encode(['message' => 'Successfully logged out.']);
        } catch (Exception $e) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(['message' => 'Invalid token.']);
            exit();
        }
    }

}
?>
