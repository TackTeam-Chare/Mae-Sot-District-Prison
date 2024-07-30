<!-- Additional Content -->
<div class="container mt-5">
    <h2 style="color: aliceblue;">ยอดผู้ต้องขัง</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th>ชาย</th>
                    <th>หญิง</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <tr id="prisonerCounts">
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('authToken');

        // Fetch prisoner counts
        fetch('http://localhost:8000/countPrisonersEach', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(data => {
            // Calculate counts based on gender
            let maleCount = 0;
            let femaleCount = 0;

            data.forEach(item => {
                if (item.gender === 1) {
                    maleCount = item.countPris;
                } else if (item.gender === 0) {
                    femaleCount = item.countPris;
                }
            });

            const totalCount = maleCount + femaleCount;

            const row = document.getElementById('prisonerCounts');
            row.innerHTML = `
                <td>${maleCount}</td>
                <td>${femaleCount}</td>
                <td>${totalCount}</td>
            `;
        })
        .catch(error => {
            console.error('Error fetching prisoner counts:', error);
            alert('Failed to fetch prisoner counts');
        });
    });

    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const currentImage = document.getElementById('currentImage');
                currentImage.src = e.target.result;
                currentImage.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById("updateProductForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const formData = new FormData(this); // Create FormData object
        const token = localStorage.getItem('authToken');

        // Include current image if it exists
        const currentImage = document.getElementById('currentImage');
        if (currentImage.src && currentImage.src.length > 0) {
            formData.append('current_image', currentImage.src);
        }

        const url = 'http://localhost:8000/employees'; // Replace with your API endpoint

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
            console.log('Success:', data);
            alert('Employee updated successfully!');
            history.back();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update employee: ' + error.message);
        });
    });
</script>
<style>
    .custom-table {
        max-width: 600px;
        margin: 0 auto;
        background-color: white;
    }

    .custom-table th, .custom-table td {
        text-align: center;
        vertical-align: middle;
    }

    .custom-table thead th {
        background-color: #d9534f;
        color: white;
    }

    .custom-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .custom-table tbody td {
        padding: 10px;
    }
</style>