<?php
require_once './models/Doc.php';
require_once './utils/Response.php';

class DocController
{
    private $db;
    private $doc;

    public function __construct($db)
    {
        $this->db = $db;
        $this->doc = new Doc($this->db);
    }

    public function getDocuments()
    {
        $stmt = $this->doc->read();
        $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($documents);
    }


    // public function getDocumentsSum()
    // {
    //     // Call the read_sum method
    //     $stmt = $this->doc->read_sum();

    //     // Fetch the result
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $total = $result['total']; // The count of documents

    //     // Prepare the response
    //     if ($total !== false) {
    //         // Send a JSON response with the count
    //         Response::send(['total_documents' => $total]);
    //     } else {
    //         // Handle the error
    //         Response::send(['message' => 'Failed to retrieve document count'], 500);
    //     }
    // }

    public function getDocumentWithID()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'ID is required'], 400);
        }
        $this->doc->id = $_GET['id'];
        $stmt = $this->doc->read_id();
        $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::send($documents[0]);
    }

    public function createDocument()
    {
        if (!isset($_POST['title']) || !isset($_POST['content'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->doc->title = $_POST['title'];
        $this->doc->content = $_POST['content'];

        if (isset($_FILES['document'])) {
            // Handle file upload
            $uploadDir = '../uploads/';
            $uploadFile = time() . basename($_FILES['document']['name']);
            $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if file is a valid document
            if (!in_array($fileType, ['pdf', 'doc', 'docx', 'txt'])) {
                Response::send(['message' => 'Only PDF, DOC, DOCX, and TXT files are allowed'], 400);
                return;
            }

            // Check file size (limit to 10MB)
            if ($_FILES['document']['size'] > 10 * 1024 * 1024) {
                Response::send(['message' => 'File size should not exceed 10MB'], 400);
                return;
            }

            if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadDir . $uploadFile)) {
                $this->doc->document = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        }

        if ($this->doc->create()) {
            Response::send(['message' => 'Document created successfully']);
        } else {
            Response::send(['message' => 'Failed to create document'], 500);
        }
    }

    public function updateDocument()
    {
        // Validate required inputs
        if (!isset($_POST['id']) || !isset($_POST['title']) || !isset($_POST['content'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }

        // Set document properties
        $this->doc->id = $_POST['id'];
        $this->doc->title = $_POST['title'];
        $this->doc->content = $_POST['content'];

        // Check if a document file is uploaded
        if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
            // Handle file upload
            $uploadDir = '../uploads/';
            $uploadFile = time() . basename($_FILES['document']['name']);
            $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if file is a valid document
            if (!in_array($fileType, ['pdf', 'doc', 'docx', 'txt'])) {
                Response::send(['message' => 'Only PDF, DOC, DOCX, and TXT files are allowed'], 400);
                return;
            }

            // Check file size (limit to 10MB)
            if ($_FILES['document']['size'] > 10 * 1024 * 1024) {
                Response::send(['message' => 'File size should not exceed 10MB'], 400);
                return;
            }

            // Move uploaded file
            if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadDir . $uploadFile)) {
                // Fetch the old document to delete it
                $stmt = $this->doc->read_id();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $old_document = $result[0]['document'];
                if (!empty($old_document) && file_exists($uploadDir . $old_document)) {
                    unlink($uploadDir . $old_document);
                }

                // Set the new document file name in the document object
                $this->doc->document = $uploadFile;
            } else {
                Response::send(['message' => 'Failed to upload file'], 500);
                return;
            }
        } else {
            // If no new document is uploaded, keep the existing document
            $stmt = $this->doc->read_id();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->doc->document = $result[0]['document'];
        }

        // Update document details in the database
        if ($this->doc->update()) {
            Response::send(['message' => 'Document updated successfully']);
        } else {
            Response::send(['message' => 'Failed to update document'], 500);
        }
    }

    public function deleteDocument()
    {
        if (!isset($_GET['id'])) {
            Response::send(['message' => 'Invalid input'], 400);
            return;
        }
        $this->doc->id = $_GET['id'];
        $uploadDir = '../uploads/';
        $stmt = $this->doc->read_id();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $old_document = $result[0]['document'];
        if (!empty($old_document) && file_exists($uploadDir . $old_document)) {
            unlink($uploadDir . $old_document);
        }

        if ($this->doc->delete()) {
            Response::send(['message' => 'Document deleted successfully']);
        } else {
            Response::send(['message' => 'Failed to delete document'], 500);
        }
    }
}
?>
