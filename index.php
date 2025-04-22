<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Search Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        #loading { 
            display: none; 
            font-weight: bold; 
        }
    </style>
</head>

<body class="p-4">
    <div class="container">
    <h2 class="mb-4">Live Search Mahasiswa (AJAX + MySQL)</h2>
    <h4 >Berdasarkan nama, nim dan jurusan </h4>
    <input type="text" id="search" class="form-control mb-3" placeholder="Ketik nama atau NIM...">
    <div id="spinner" class="spinner-border d-none" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div id="loading">Mencari...</div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody id="result"></tbody>
        </table>
    </div>
    <script>
        const searchBox = document.getElementById("search");
        const result = document.getElementById("result");
        const loading = document.getElementById("loading");
        const spinner = document.getElementById("spinner");
        searchBox.addEventListener("keyup", function() {
        const keyword = searchBox.value.trim();
            
        spinner.classList.remove("d-none");
        setTimeout(() => {
            spinner.classList.add("d-none");
        }, 1000);

            if (keyword.length === 0) {
                result.innerHTML = "";

                return;
            }
            loading.style.display = "block";
            
            fetch("search.php?keyword=" + encodeURIComponent(keyword))
            .then(res => res.json())
            .then(data => {
                    loading.style.display = "none";
                   result.innerHTML = "";
                    
                    if (data.length === 0) {
                    result.innerHTML = "<tr><td colspan='3' class='text-center'>Data tidak ditemukan</td></tr>";
                } else {
                    data.forEach(row => {
                        result.innerHTML += `<tr>
                        <td>${row.nim}</td>
                        <td>${row.nama}</td>
                        <td>${row.jurusan}</td>
                        </tr>`;
                    });
                }
            });
        });
    </script>
</body>
</html>