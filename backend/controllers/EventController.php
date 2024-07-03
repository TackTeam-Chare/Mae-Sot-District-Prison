<?php
require_once './models/Event.php';
require_once './utils/Response.php';

class EventController
{
    private $db;
    private $event;

    public function __construct($db)
    {
        $this->db = $db;
        $this->event = new Event($this->db);
    }

    public function getEvents()
    {
        $stmt = $this->event->read();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($events);
    }


    public function getEventsWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ต้องใช้ ID '], 400);
        }
        $this->event->id = $_GET['id'];
        $stmt = $this->event->read_id();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($events[0]);
    }

    // public function getEventsImageWithID()
    // {
    //     Response::send($events);
    // }



    public function createEvent()
    {
        if (  !isset($_POST['title']) || !isset($_POST['content'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->event->title = $_POST['title'];
        $this->event->content = $_POST['content'];


        if (isset($_FILES['image'])) {
                // Handle file upload
                $uploadDir = '../Mae-Sot-District-Prison/uploads/';
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
                    
                    $this->event->image = $uploadFile;
        
                } else {
                    Response::send(['message' => 'ไม่สามารถอัพโหลดไฟล์ได้'], 500);
                }
        }


        if ($this->event->create()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    

    }
    public function updateEvent()
    {
        // Validate required inputs
        if (!isset($_POST['id']) || !isset($_POST['title']) || !isset($_POST['content'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
    
        // Set event properties
        $this->event->id = $_POST['id'];
        $this->event->title = $_POST['title'];
        $this->event->content = $_POST['content'];
    
        // Check if an image file is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Handle file upload
            $uploadDir = '../Mae-Sot-District-Prison/uploads/';
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
                $stmt = $this->event->read_id();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $old_image = $result[0]['image'];
                if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
                    unlink($uploadDir . $old_image);
                }
    
                // Set the new image file name in the event object
                $this->event->image = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            // If no new image is uploaded, keep the existing image
            $stmt = $this->event->read_id();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->event->image = $result[0]['image'];
        }
    
        // Update event details in the database
        if ($this->event->update()) {
            Response::send(['message' => 'Event updated successfully']);
        } else {
            Response::send(['message' => 'Event update failed'], 500);
        }
    }
    
    public function deleteEvent()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->event->id = $_GET['id'];
        $uploadDir = '../Mae-Sot-District-Prison/uploads/';
        $stmt = $this->event->read_id();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $old_image = $result[0]['image'];
        if (!empty($old_image) && file_exists($uploadDir.$old_image)) {
            unlink($uploadDir.$old_image);
        }

        if ($this->event->delete()) {
            Response::send(['message' => 'สร้างข้อมูลสำเร็จ']);
        } else {
            Response::send(['message' => 'สร้างข้อมูลไม่สำเร็จ'], 500);
        }
    }
}
