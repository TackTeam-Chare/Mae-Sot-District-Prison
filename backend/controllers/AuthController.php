<?php
require_once './models/Auth.php';
require_once './utils/Response.php';

class AuthController {
    private $db;
    private $auth;

    public function __construct($db) {
        $this->db = $db;
        $this->auth = new Auth($this->db);
    }

    public function login() {
        // $data = json_decode(file_get_contents("php://input"));
        // $email = $data->email ?? '';
        // $password = $data->password ?? '';

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';


        if (empty($email) || empty($password)) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        
        
        // $email = $_POST['email'];
        // $password = $_POST['password'];
        

        $token = $this->auth->login($email, $password);
        if ($token) {
            Response::send(['token' => $token]);
        } else {
            Response::send(['message' => 'Login failed'], 401);
        }
    }
}
