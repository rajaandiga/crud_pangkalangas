<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Pangkalan Rubi Hartatik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .navbar-brand img {
            max-width: 80px;
            height: auto;
        }
        .navbar-text {
            margin-left: 10px;
        }
        body {
            background-color: white;
        }
        .navbar {
            background-color: #7ed957; 
        }
    </style>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>
    <!-- Menu Navigasi -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/logo-rh-pth.png" alt="Logo">
            </a>
            <span class="navbar-text">
                <h2>Pangkalan Rubi Hartatik</h2>
            </span>
            <form class="d-flex ml-auto" role="search">
                <input class="form-control me-2" type="search" id="searchInput" onkeyup="searchTable()" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark" type="button" onclick="searchTable()">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <br>
        <h1><center>DATA ANGGOTA</center></h1>  
        <div class="row">
            <div class="col-12">
                <?php
                    include "koneksi.php";

                    if (isset($_GET['nik'])) {
                        $nik = htmlspecialchars($_GET["nik"]);
                        $sql = "DELETE FROM anggota WHERE nik='$nik'";
                        $hasil = mysqli_query($kon, $sql);

                        if ($hasil) {
                            header("Location: index.php");
                        } else {
                            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                        }
                    }
                ?>
                <table class="my-5 table table-bordered" id="dataTable">
                    <thead>
                        <tr class="table-info">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Anggota</th>
                            <th>Alamat</th>
                            <th>Rt</th>
                            <th>Keterangan</th>
                            <th>No. Hp</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM anggota ORDER BY nik DESC";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            while ($data = mysqli_fetch_array($hasil)) {
                                $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo htmlspecialchars($data["nik"]); ?></td>
                            <td><?php echo htmlspecialchars($data["nama"]); ?></td>
                            <td><?php echo htmlspecialchars($data["alamat"]); ?></td>
                            <td><?php echo htmlspecialchars($data["rt"]); ?></td>
                            <td><?php echo htmlspecialchars($data["keterangan"]); ?></td>
                            <td><?php echo htmlspecialchars($data["nohp"]); ?></td>
                            <td>
                                <a href="update.php?nik=<?php echo htmlspecialchars($data['nik']); ?>" class="btn btn-outline-info" role="button">Update</a>
                                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?nik=<?php echo htmlspecialchars($data['nik']); ?>" class="btn btn-outline-danger" role="button">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-outline-success" role="button">Tambah Anggota</a>
            </div>
        </div>
    </div>
</body>
</html>
