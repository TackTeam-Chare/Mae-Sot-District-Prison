<?php
require_once './models/User.php';
require_once './utils/Response.php';

class RegisterController {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($this->db);
    }

    public function register() {
        // Get the raw POST data
        // $data = json_decode(file_get_contents("php://input"));

        // echo $_POST['name'];
        // if (!isset($data->name) || !isset($data->email) || !isset($data->password)) {
        //     Response::send(['message' => 'Invalid input. Make sure name, email, and password are provided.'], 400);
        //     return;
        // }
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            Response::send(['message' => 'Invalid input. Make sure name, email, and password are provided.'], 400);
            return;
        }
        // Assign data to user object
        // $this->user->name = htmlspecialchars(strip_tags($data->name));
        // $this->user->email = htmlspecialchars(strip_tags($data->email));
        // $this->user->password = htmlspecialchars(strip_tags($data->password));

        $this->user->name = $_POST['name'];
        $this->user->email = $_POST['email'];
        $this->user->password = $_POST['password'];
        
        // Attempt to create user
        if ($this->user->create()) {
            Response::send(['message' => 'User registered successfully']);
        } else {
            Response::send(['message' => 'User registration failed'], 500);
        }
    }
}
?>
