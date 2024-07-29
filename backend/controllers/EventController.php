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
    public function getEventsOnly()
    {
        $stmt = $this->event->read_only();
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
        // Validate input from POST data
        if (!isset($_POST['title']) || !isset($_POST['content'])) {
            Response::send(['message' => 'Invalid input. Ensure title and content are provided.'], 400);
            return;
        }
    
        $this->event->title = $_POST['title'];
        $this->event->content = $_POST['content'];
    
        $this->event->allow_publish = $_POST['allow_publish'];
    
        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
                $this->event->image = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            $this->event->image = null; // No image uploaded
        }
    
        // Attempt to create event
        if ($this->event->create()) {
            Response::send(['message' => 'Event created successfully']);
        } else {
            Response::send(['message' => 'Failed to create event'], 500);
        }
    }
    

// Controller method
public function getEventsSum() {
    
    // Call the read_sum method
    $stmt = $this->event->read_sum();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $result['total']; // The count of events

    // Prepare the response
    if ($total !== false) {
        // Send a JSON response with the count
        Response::send(['total_events' => $total]);
    } else {
        // Handle the error
        Response::send(['message' => 'Failed to retrieve event count'], 500);
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
        $this->event->allow_publish = $_POST['allow_publish'];
    
        // Handle file upload if present
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $uploadFile = time() . '-' . basename($_FILES['image']['name']); // Sanitize file name
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    
            // Validate file
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                Response::send(['message' => 'Invalid image file'], 400);
                return;
            }
    
            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                Response::send(['message' => 'File size should not exceed 5MB'], 400);
                return;
            }
    
            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                Response::send(['message' => 'Only JPG, JPEG, PNG files are allowed'], 400);
                return;
            }
    
            // Move uploaded file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $uploadFile)) {
                // Fetch the old image to delete it
                try {
                    $stmt = $this->event->read_id();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $old_image = $result[0]['image'];
                    if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
                        unlink($uploadDir . $old_image);
                    }
                } catch (Exception $e) {
                    Response::send(['message' => 'Error accessing database: ' . $e->getMessage()], 500);
                    return;
                }
    
                // Set new image file name in the event object
                $this->event->image = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            // If no new image is uploaded, keep the existing image
            try {
                $stmt = $this->event->read_id();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $this->event->image = $result[0]['image'];
            } catch (Exception $e) {
                Response::send(['message' => 'Error accessing database: ' . $e->getMessage()], 500);
                return;
            }
        }
    
        // Update event details in the database
        try {
            if ($this->event->update()) {
                Response::send(['message' => 'Event updated successfully']);
            } else {
                Response::send(['message' => 'Event update failed'], 500);
            }
        } catch (Exception $e) {
            Response::send(['message' => 'Error updating event: ' . $e->getMessage()], 500);
        }
    }
    
    
    public function deleteEvent()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->event->id = $_GET['id'];
        $uploadDir = '../uploads/';
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
