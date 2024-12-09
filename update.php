<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Include file koneksi, untuk koneksi ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama NIK
    if (isset($_GET['nik'])) {
        $nik = input($_GET["nik"]);

        $sql = "SELECT * FROM anggota WHERE nik='$nik'";
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nik = input($_POST["nik"]);
        $nama = input($_POST["nama"]);
        $alamat = input($_POST["alamat"]);
        $keterangan = input($_POST["keterangan"]);
        $nohp = input($_POST["nohp"]);
        $rt = input($_POST["rt"]);

        // Query update data pada tabel anggota
        $sql = "UPDATE anggota SET
            nama='$nama',
            alamat='$alamat',
            keterangan='$keterangan',
            nohp='$nohp',
            rt='$rt'
            WHERE nik='$nik'";

        // Mengeksekusi atau menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Ubah Data Anggota</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" name="nik" id="nik" class="form-control" value="<?php echo $data['nik']; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="nama">Nama Anggota:</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anggota" value="<?php echo $data['nama']; ?>" required/>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukan Alamat" required><?php echo $data['alamat']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan" value="<?php echo $data['keterangan']; ?>" required/>
        </div>
        <div class="form-group">
            <label for="nohp">No. Hp:</label>
            <input type="text" name="nohp" id="nohp" class="form-control" placeholder="Masukan No. Hp" value="<?php echo $data['nohp']; ?>" required/>
        </div>
        <div class="form-group">
            <label for="rt">RT:</label>
            <input type="text" name="rt" id="rt" class="form-control" placeholder="Masukan RT" value="<?php echo $data['rt']; ?>" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</body>
</html>
