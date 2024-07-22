<?php
require_once './models/User.php';
require_once './utils/Response.php';

class AdminController
{
    private $db;
    private $admin;

    public function __construct($db)
    {
        $this->db = $db;
        $this->admin = new User($this->db);
    }

    public function createAdmin()
    {
        // Read raw input with content type application/json
        $rawInput = file_get_contents('php://input');
        $inputData = json_decode($rawInput, true);

        // Validate input
        if (!isset($inputData['name']) || !isset($inputData['email']) || !isset($inputData['password']) || !isset($inputData['is_main_admin'])) {
            Response::send(['message' => 'Invalid input. Make sure name, email, password, and is_main_admin are provided.'], 400);
            return;
        }

        // Validate email format
        if (!filter_var($inputData['email'], FILTER_VALIDATE_EMAIL)) {
            Response::send(['message' => 'Invalid email format.'], 400);
            return;
        }

        // Validate is_main_admin (must be a boolean value)
        $is_main_admin = filter_var($inputData['is_main_admin'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($is_main_admin === null) {
            Response::send(['message' => 'Invalid value for is_main_admin. It must be either true or false.'], 400);
            return;
        }

        // Hash password before storing
        $this->admin->name = htmlspecialchars(strip_tags($inputData['name']));
        $this->admin->email = htmlspecialchars(strip_tags($inputData['email']));
        $this->admin->password =$inputData['password'] ;
        $this->admin->is_main_admin = $is_main_admin;

        // Attempt to create user
        if ($this->admin->create()) {
            Response::send(['message' => 'Admin registered successfully']);
        } else {
            Response::send(['message' => 'Admin registration failed'], 500);
        }
    }

    public function getAdmin()
    {
        $stmt = $this->admin->read();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($admins);
    }

    public function getAdminWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ID is required.'], 400);
            return;
        }

        $this->admin->id = htmlspecialchars(strip_tags($_GET['id']));
        $stmt = $this->admin->read_id();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            Response::send($admin);
        } else {
            Response::send(['message' => 'Admin not found'], 404);
        }
    }
    public function updateAdmin()
    {
        // Read raw input with content type application/json
        $rawInput = file_get_contents('php://input');
        $inputData = json_decode($rawInput, true);
    
        // Validate required inputs
        if (!isset($inputData['id']) || empty($inputData['id']) ||
            !isset($inputData['name']) || empty($inputData['name']) ||
            !isset($inputData['email']) || empty($inputData['email']) ||
            !isset($inputData['password']) || empty($inputData['password'])) {
            Response::send(['message' => 'Invalid input. Make sure id, name, email, and password are provided.'], 400);
            return;
        }
    
        // Validate is_main_admin (must be a boolean value)
        $is_main_admin = filter_var($inputData['is_main_admin'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($is_main_admin === null) {
            Response::send(['message' => 'Invalid value for is_main_admin. It must be either true or false.'], 400);
            return;
        }
    
        $this->admin->id = htmlspecialchars(strip_tags($inputData['id']));
        $this->admin->name = htmlspecialchars(strip_tags($inputData['name']));
        $this->admin->email = htmlspecialchars(strip_tags($inputData['email']));
        $this->admin->is_main_admin = $is_main_admin;
    
        // Retrieve the stored hashed password from the database
        $stmt = $this->admin->check_password();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            Response::send(['message' => 'Admin not found'], 404);
            return;
        }
    
        $storedHashedPassword = $result['password'];
        $providedPassword = htmlspecialchars(strip_tags(($inputData['password'])));
    
        // Verify the provided password against the stored hashed password
        if (!password_verify($providedPassword, $storedHashedPassword)) {
            Response::send(['message' => 'Password does not match with the stored password'], 401);
            return;
        }
    
        // If new password is provided, hash it before storing
        if (isset($inputData['new_password']) && !empty($inputData['new_password'])) {
            $this->admin->password = $inputData['new_password'];
        } else {
            // If no new password is provided, keep the existing password
            $this->admin->password = $storedHashedPassword;
        }
    
        // Update admin details in the database
        if ($this->admin->update()) {
            Response::send(['message' => 'Admin information updated successfully']);
        } else {
            Response::send(['message' => 'Failed to update admin information'], 500);
        }
    }
    

    public function deleteAdmin()
    {
        // Validate required inputs
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            Response::send(['message' => 'ID is required.'], 400);
            return;
        }

        $this->admin->id = htmlspecialchars(strip_tags($_GET['id']));

        if ($this->admin->delete()) {
            Response::send(['message' => 'Admin deleted successfully']);
        } else {
            Response::send(['message' => 'Failed to delete admin'], 500);
        }
    }
}
