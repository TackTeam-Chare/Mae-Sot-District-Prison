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

    public function getAdmin()
    {
        $stmt = $this->admin->read();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($events);
    }


    public function getAdminWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->admin->id = $_GET['id'];
        $stmt = $this->admin->read_id();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($admins[0]);
    }

    public function updateAdmin()
    {
        // Validate required inputs
        if (!isset($_POST['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }

        // echo $_POST['email'].' ';
        // echo $_POST['password'];

        // Set admin properties
        $this->admin->id = $_POST['id'];
        $this->admin->name = $_POST['name'];
        $this->admin->email = $_POST['email'];
    
        // Retrieve the stored hashed password from the database
        $stmt = $this->admin->check_password();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            Response::send(['message' => 'Admin not found'], 404);
            return;
        }
    
        $storedHashedPassword = $result['password'];
        $providedPassword = $_POST['password'];
    
        // // Verify the provided password against the stored hashed password
        if (!password_verify( $providedPassword,$storedHashedPassword)) {
            Response::send(['message' => 'รหัสผ่านไม่ตรงกัน'], 401);
            return;
        }
        if (isset($_POST['new_password'])) {
            $this->admin->password = $_POST['new_password'];
        }
        
        // Update admin details in the database
        if ($this->admin->update()) {
            Response::send(['message' => 'อัปเดตข้อมูลแอดมินเสร็จเรียบร้อย']);
        } else {
            Response::send(['message' => 'อัปเดตข้อมูลแอดมินไม่สำเร็จ'], 500);
        }
    }
    
    public function deleteAdmin()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->admin->id = $_GET['id'];
        // $uploadDir = '../Mae-Sot-District-Prison/uploads/';
        // $stmt = $this->event->read_id();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $old_image = $result[0]['image'];
        // if (!empty($old_image) && file_exists($uploadDir.$old_image)) {
        //     unlink($uploadDir.$old_image);
        // }

        if ($this->admin->delete()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    }
}
