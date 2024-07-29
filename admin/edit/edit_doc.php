<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเอกสาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>แก้ไขเอกสาร</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateDocumentForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
            <div class="mb-3">
                <label for="title" class="form-label">ชื่อเอกสาร</label>
                <input type="text" class="form-control" placeholder="หัวข้อเอกสาร" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">รายละเอียดเอกสาร</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่เนื้อหาของเอกสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="document" class="form-label">ไฟล์เอกสาร</label>
                <input type="file" class="form-control" name="document" accept=".pdf,.doc,.docx,.txt" onchange="previewDocument(event)">
                <iframe class="form-control mt-2" id="currentDocument" src="" style="display:none; width:100%; height:500px;"></iframe>
            </div>
            <div>
                <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
    const documentId = <?php echo $_GET['id']; ?>;
    const url = `http://localhost:8000/stuffview_docs?id=${documentId}`;
    const token = localStorage.getItem('authToken');

    fetch(url, {
        headers: {
            'Authorization': `Bearer ${token}`
        },
    })
    .then(response => response.json())
    .then(data => {
        // Populate form fields with existing data
        document.querySelector('input[name="title"]').value = data.title;
        document.querySelector('textarea[name="content"]').value = data.content;

        // Display current document if exists
        if (data.document) {
            const currentDocument = document.getElementById('currentDocument');
            currentDocument.src = `../../uploads/${data.document}`;
            currentDocument.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error fetching document:', error);
        alert('Failed to fetch document details');
    });
});

function previewDocument(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const fileURL = URL.createObjectURL(input.files[0]);
        const currentDocument = document.getElementById('currentDocument');
        currentDocument.src = fileURL;
        currentDocument.style.display = 'block';
    }
}

document.getElementById("updateDocumentForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData();

    formData.append('id', document.querySelector('input[name="id"]').value);
    formData.append('title', document.querySelector('input[name="title"]').value);
    formData.append('content', document.querySelector('textarea[name="content"]').value);

    const newDocumentFile = document.querySelector('input[name="document"]').files[0];
    if (newDocumentFile) {
        formData.append('document', newDocumentFile);
    }

    const token = localStorage.getItem('authToken');
    const url = 'http://localhost:8000/docs'; // API endpoint

    fetch(url, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        alert('Document updated successfully!');
        history.back(); // Go back to the previous page
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update document: ' + error.message);
    });
});

    </script>
</body>

</html>
