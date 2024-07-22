<?php
require_once './vendor/autoload.php'; // Include Composer's autoloader

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler
{
    private $secretKey;
    private $algorithm;

    public function __construct()
    {
        $this->secretKey = 'ljasdkl;fjasdjfl;asdjkfas;difoweauoasndklvjansdjkfhawleruhascndkasjdfjkfhas'; // Replace with your actual secret key
        $this->algorithm = 'HS256'; // JWT signing algorithm
    }

    public function getDb() {
        // Implement database connection if needed
        $database = new Database();
        $db = $database->getConnection();
    }

    public function generateToken($userId, $username)
    {
        $payload = [
            'iat' => time(), // Issued at
            'exp' => time() + 3600, // Expiration time (1 hour from now)
            'sub' => $userId, // Subject
            'username' => $username // Custom claim
        ];

        return JWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    public function decodeToken($token)
    {
        try {
            return JWT::decode($token, new Key($this->secretKey, $this->algorithm));
        } catch (Exception $e) {
            return null; // Token is invalid or expired
        }
    }

    public function verifyToken($token) {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->sub; // Return the user ID or relevant claim
        } catch (Exception $e) {
            throw new Exception('Invalid token.');
        }
    }

}
