<?php
require_once './models/Employee.php';
require_once './utils/Response.php';

class EmployeeController
{
    private $db;
    private $employee;

    public function __construct($db)
    {
        $this->db = $db;
        $this->employee = new Employee($this->db);
    }

    public function getEmployees()
    {
        if (!isset($_GET['dep_id'])) {
   
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        
        }
        $this->employee->dep_id = $_GET['dep_id'];
        $stmt = $this->employee->read();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($events);
    }

    // public function getEmployeesSum() {
    
    //     // Call the read_sum method
    //     $stmt = $this->Employee->read_sum();
    
    //     // Fetch the result
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $total = $result['total']; // The count of events
    
    //     // Prepare the response
    //     if ($total !== false) {
    //         // Send a JSON response with the count
    //         Response::send(['total_events' => $total]);
    //     } else {
    //         // Handle the error
    //         Response::send(['message' => 'Failed to retrieve event count'], 500);
    //     }
    // }

    
    public function getEmployeeInPosition()
    {
        if (!isset($_GET['pos_id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->employee->dep_id = $_GET['dep_id'];
        $this->employee->pos_id = $_GET['pos_id'];
        
        $stmt = $this->employee->read_emOnPositon();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }
    public function getEmployeeWithIDAndPosition()
    {
        if (!isset($_GET['dep_id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->employee->dep_id = $_GET['dep_id'];
        // $this->employee->pos_id = $_GET['pos_id'];
        
        $stmt = $this->employee->read_id_with_position();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }
    public function getEmployeeWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->employee->id = $_GET['id'];
        $stmt = $this->employee->read_id();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees[0]);
    }
    public function getDepartments()
    {
        $stmt = $this->employee->read_departments();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }
    public function getDepartmentsCount()
    {
        $stmt = $this->employee->count_departments();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }
    public function getJobPositions()
    {
        $stmt = $this->employee->read_job_positions();
        $Employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($Employees);
    }    // public function getEventsImageWithID()
    // {
    //     Response::send($events);
    // }



    public function createEmployee()
    {
        if (  !isset($_POST['name']) || !isset($_POST['dep_id'])|| !isset($_POST['pos_id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->employee->name = $_POST['name'];
        $this->employee->dep_id = $_POST['dep_id'];
        $this->employee->pos_id = $_POST['pos_id'];


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
            
                    // $stmt = $this->event->read_id();
                    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // $old_image = $result[0]['image'];
                    // if (!empty($old_image) && file_exists($uploadDir.$old_image)) {
                    //     unlink($uploadDir.$old_image);
                    // }
                    
                    $this->employee->image = $uploadFile;
        
                } else {
                    Response::send(['message' => 'ไม่สามารถอัพโหลดไฟล์ได้'], 500);
                }
        }


        if ($this->employee->create()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    

    }
    public function updateEmployee()
    {
        // Validate required inputs
        if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['dep_id'])|| !isset($_POST['pos_id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
    
        // Set event properties
        $this->employee->id = $_POST['id'];
        $this->employee->name = $_POST['name'];
        $this->employee->dep_id = $_POST['dep_id'];
        $this->employee->pos_id = $_POST['pos_id'];
    
    
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
                $stmt = $this->employee->read_id();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $old_image = $result[0]['image'];
                if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
                    unlink($uploadDir . $old_image);
                }
    
                // Set the new image file name in the event object
                $this->employee->image = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            // If no new image is uploaded, keep the existing image
            $stmt = $this->employee->read_id();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->employee->image = $result[0]['image'];
        }
      
        // Update event details in the database
        if ($this->employee->update()) {
            Response::send(['message' => 'Event updated successfully']);
            
        } else {
            Response::send(['message' => 'Event update failed'], 500);
        }
    }
    
    public function deleteEmployee()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->employee->id = $_GET['id'];
        $uploadDir = '../uploads/';
        $stmt = $this->employee->read_id();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $old_image = $result[0]['image'];
        if (!empty($old_image) && file_exists($uploadDir.$old_image)) {
            unlink($uploadDir.$old_image);
        }

        if ($this->employee->delete()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    }



}
