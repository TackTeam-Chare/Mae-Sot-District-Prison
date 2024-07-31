
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


<body>
    <div class="container my-5">
        <h2 class="text-white mb-4">ยอดผู้ต้องขัง</h2>
        <hr class="bg-white my-4" style="height: 3px;">
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
                    <tr>
                        <td>ผู้ต้องขังชาวไทย</td>
                        <td id="thaiMale">0</td>
                        <td id="thaiFemale">0</td>
                        <td id="thaiTotal">0</td>
                    </tr>
                    <tr>
                        <td>ผู้ต้องขังชาวต่างประเทศ</td>
                        <td id="foreignMale">0</td>
                        <td id="foreignFemale">0</td>
                        <td id="foreignTotal">0</td>
                    </tr>
                    <tr>
                        <td>รวม</td>
                        <td id="totalMale">0</td>
                        <td id="totalFemale">0</td>
                        <td id="grandTotal">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');

            fetch('http://localhost:8000/countPrisonersEach', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                let thaiMale = 0;
                let thaiFemale = 0;
                let foreignMale = 0;
                let foreignFemale = 0;

                data.forEach(item => {
                    if (item.nationality === 'Thai') {
                        if (item.gender === 1) {
                            thaiMale = item.countPris;
                        } else if (item.gender === 0) {
                            thaiFemale = item.countPris;
                        }
                    } else if (item.nationality === 'Foreign') {
                        if (item.gender === 1) {
                            foreignMale = item.countPris;
                        } else if (item.gender === 0) {
                            foreignFemale = item.countPris;
                        }
                    }
                });

                const thaiTotal = thaiMale + thaiFemale;
                const foreignTotal = foreignMale + foreignFemale;
                const totalMale = thaiMale + foreignMale;
                const totalFemale = thaiFemale + foreignFemale;
                const grandTotal = thaiTotal + foreignTotal;

                document.getElementById('thaiMale').innerText = thaiMale;
                document.getElementById('thaiFemale').innerText = thaiFemale;
                document.getElementById('thaiTotal').innerText = thaiTotal;
                document.getElementById('foreignMale').innerText = foreignMale;
                document.getElementById('foreignFemale').innerText = foreignFemale;
                document.getElementById('foreignTotal').innerText = foreignTotal;
                document.getElementById('totalMale').innerText = totalMale;
                document.getElementById('totalFemale').innerText = totalFemale;
                document.getElementById('grandTotal').innerText = grandTotal;
            })
            .catch(error => {
                console.error('Error fetching prisoner counts:', error);
                alert('Failed to fetch prisoner counts');
            });
        });
    </script>
</body>

</html>
