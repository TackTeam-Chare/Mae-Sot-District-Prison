<!-- Additional Content -->
<div class="container mt-5">
    <h2 style="color: aliceblue;">ยอดผู้ต้องขัง</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th>สัญชาติ</th>
                    <th>ชาย</th>
                    <th>หญิง</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <tr id="prisonerCounts">
                    <td>ไทย</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr id="prisonerCountsOther">
                    <td>ต่างประเทศ</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr id="totalCounts">
                    <td>ทั้งหมด</td>
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

        var thai_m = 0;
        var thai_f = 0;
        var other_m = 0;
        var other_f = 0;

        const token = localStorage.getItem('authToken');

        // Fetch Thai prisoner counts
        fetch('http://localhost:8000/countPrisonersEach', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                if (item.gender === 1) {
                    thai_m = item.countPris;
                } else if (item.gender === 0) {
                    thai_f = item.countPris;
                }
            });

            const totalCount = thai_m + thai_f;
            const row = document.getElementById('prisonerCounts');
            row.innerHTML = `
                <td>ไทย</td>
                <td>${thai_m}</td>
                <td>${thai_f}</td>
                <td>${totalCount}</td>
            `;

            updateTotalCounts();
        })
        .catch(error => {
            console.error('Error fetching Thai prisoner counts:', error);
            alert('Failed to fetch Thai prisoner counts');
        });

        // Fetch foreign prisoner counts
        fetch('http://localhost:8000/countPrisonersOtherEach', {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                if (item.gender === 1) {
                    other_m = item.countPris;
                } else if (item.gender === 0) {
                    other_f = item.countPris;
                }
            });

            const totalCount_ = other_m + other_f;
            const row = document.getElementById('prisonerCountsOther');
            row.innerHTML = `
                <td>ต่างประเทศ</td>
                <td>${other_m}</td>
                <td>${other_f}</td>
                <td>${totalCount_}</td>
            `;

            updateTotalCounts();
        })
        .catch(error => {
            console.error('Error fetching foreign prisoner counts:', error);
            alert('Failed to fetch foreign prisoner counts');
        });

        function updateTotalCounts() {
            const totalmale = thai_m + other_m;
            const totalfemale = thai_f + other_f;
            const allTotal = totalmale + totalfemale;

            const row = document.getElementById('totalCounts');
            row.innerHTML = `
                <td>ทั้งหมด</td>
                <td>${totalmale}</td>
                <td>${totalfemale}</td>
                <td>${allTotal}</td>
            `;
        }
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

        .custom-table th,
        .custom-table td {
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
