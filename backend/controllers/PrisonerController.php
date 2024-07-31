<?php
require_once './models/Prisoner.php';
require_once './utils/Response.php';

class PrisonerController
{
    private $db;
    private $prisoner;

    public function __construct($db)
    {
        $this->db = $db;
        $this->prisoner = new Prisoner($this->db);
    }

    public function getPrisoners()
    {
        $stmt = $this->prisoner->read();
        $prisoners = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($prisoners);
    }

    public function getPrisonerWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->prisoner->id = $_GET['id'];
        $stmt = $this->prisoner->read_id();
        $prisoners = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($prisoners[0]);
    }
    public function getPrisonersCountOther()
    {
        $stmt = $this->prisoner->count_prisoners_other();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }
    public function getPrisonersCount()
    {
        $stmt = $this->prisoner->count_prisoners();
        $prisoners = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($prisoners);
    }

    public function createPrisoner()
    {
        if (!isset($_POST['name']) || !isset($_POST['gender']) || !isset($_POST['type'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->prisoner->name = $_POST['name'];
        $this->prisoner->gender = $_POST['gender'];
        $this->prisoner->type = $_POST['type'];

        if (isset($_FILES['image'])) {
            // Handle file upload
            $uploadDir = '../uploads/';
            $uploadFile = time() . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if file is a valid image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                Response::send(['message' => 'ชนิดข้อมูลของไฟลไม่ถูกต้อง'], 400);
                return;
            }

            // Check file size (limit to 5MB)
            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                Response::send(['message' => 'ขนาดไฟล์ไม่ควรที่จะเกิน (5MB)'], 400);
                return;
            }
            // Allow certain file formats
            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                Response::send(['message' => 'ใช้ไดเพียงไฟล์ชนิด JPG, JPEG, PNG เท่านั้น'], 400);
                return;
            }
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $uploadFile)) {
                $this->prisoner->image = $uploadFile;
            } else {
                Response::send(['message' => 'ไม่สามารถอัพโหลดไฟล์ได้'], 500);
                return;
            }
        }

        if ($this->prisoner->create()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    }

    public function updatePrisoner()
    {
        // Validate required inputs
        if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['gender']) || !isset($_POST['type'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }

        // Set prisoner properties
        $this->prisoner->id = $_POST['id'];
        $this->prisoner->name = $_POST['name'];
        $this->prisoner->gender = $_POST['gender'];
        
        $this->prisoner->type = $_POST['type'];
        
    
        // Check if an image file is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Handle file upload
            $uploadDir = '../uploads/';
            $uploadFile = time() . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if file is a valid image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                Response::send(['message' => 'Invalid image file'], 400);
                return;
            }

            // Check file size (limit to 5MB)
            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                Response::send(['message' => 'File size should not exceed 5MB'], 400);
                return;
            }

            // Allow certain file formats
            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                Response::send(['message' => 'Only JPG, JPEG, PNG files are allowed'], 400);
                return;
            }

            // Move uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $uploadFile)) {
                // Fetch the old image to delete it
                $stmt = $this->prisoner->read_id();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $old_image = $result[0]['image'];
                if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
                    unlink($uploadDir . $old_image);
                }

                // Set the new image file name in the prisoner object
                $this->prisoner->image = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            // If no new image is uploaded, keep the existing image
            $stmt = $this->prisoner->read_id();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->prisoner->image = $result[0]['image'];
        }

        // Update prisoner details in the database
        if ($this->prisoner->update()) {
            Response::send(['message' => 'Prisoner updated successfully']);
        } else {
            Response::send(['message' => 'Prisoner update failed'], 500);
        }
    }

    public function deletePrisoner()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->prisoner->id = $_GET['id'];
        $uploadDir = '../uploads/';
        $stmt = $this->prisoner->read_id();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $old_image = $result[0]['image'];
        if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
            unlink($uploadDir . $old_image);
        }

        if ($this->prisoner->delete()) {
            Response::send(['message' => 'ลบข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'ลบข้อมูลไม่สำเร็จ'], 500);
        }
    }
}
?>
